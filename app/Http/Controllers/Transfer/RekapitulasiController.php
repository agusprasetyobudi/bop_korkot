<?php

namespace App\Http\Controllers\Transfer;


use App\Facades\ErrorReport;
use App\Http\Controllers\Controller;
use App\Models\FirmModels;
use App\Models\KontrakModels;
use App\Models\MasterBank;
use App\Models\TransferModels;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;


class RekapitulasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        if($request->ajax()){ 
            if(Auth::user()->roles->id == 1 || Auth::user()->roles->id == 2){
                $data = TransferModels::where('parent_id',0) 
                ->get();
            }else{
                $data = TransferModels::join('users','transfer.created_by','=','users.id')
                ->where('parent_id',0)
                ->where('users.id_kantor', Auth::user()->id_kantor)
                ->select(['transfer.id as id','transfer.firm_id','transfer.amount as amount','transfer.amount_item as amount_item','transfer.tanggal_terima as tanggal_terima','transfer.created_by as created_by','transfer.has_inserted as has_inserted'])
                ->get();
            } 
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('no_bukti',function($row){
                return $row->firm->no_bukti;
            })
            ->addColumn('nama_penerima',function($row){
                return $row->firm->nama_penerima;
            })
            ->addColumn('bank_penerima',function($row){
                $data = MasterBank::where('id',$row->firm->id_bank)->get();
                return $data[0]->nama_bank;
            })
            ->addColumn('no_rekening',function($row){ 
                return $row->firm->bank_account_number;
            })
            ->addColumn('nilai_kontrak',function($row){ 
                $data = TransferModels::where('parent_id', $row->id)
                ->select('item_kontrak_id')
                ->get();
                foreach ($data as $key => $value) {
                    return  "Rp " . number_format(KontrakModels::where('id',$value->item_kontrak_id)->get()->sum('nominal'),0,',','.');
                }
            })
            ->addColumn('jumlah_diterima', function($row){
                 return  "Rp " . number_format($row->amount,0,',','.');
            })
            ->addColumn('selisih', function($row){
                $data = TransferModels::where('parent_id', $row->id)
                ->select('amount_item')
                ->get();
                 return  "Rp " . number_format($data->sum('amount_item')-(int)$row->amount,0,',','.');
            })
            ->addColumn('periode', function($row){
                return Carbon::parse($row->firm->periode_year.'-'.$row->firm->periode_month)->isoFormat('MMMM / Y');
            })
            ->addColumn('approval', function($row){
                if($row->has_inserted){
                    return 1;
                }
                return 0;
            })
            ->addColumn('action',function($row){
               if($row->has_inserted !=0){
                    return 'Data Has Approved';
               }else{
                    $btn = '';
                    $btn .= '<a href="'.route('buktiTransferEdit',['id'=>Crypt::encrypt($row->id)]).'" class="btn btn-warning">Edit</a>  '; 
                    $btn .= '<button type="button" class="btn btn-danger" id="delete-confirm" data-name="'.Crypt::encrypt($row->id).'" >Delete</button>';
                    return $btn;
               }
            })
            ->rawColumns(['no_bukti','nama_penerima','bank_penerima','no_rekening','nilai_kontrak','jumlah_diterima','periode','action','approval'])
            ->make(true);
        }
        return view('main.transfer.rekapitulasi.index');  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('main.transfer.rekapitulasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        DB::beginTransaction();
        try {
            $decrypted = Crypt::decrypt($request->post('firm'));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            
        }



        // dd($request->post());
        try {
           
            $id = [];
             foreach ($request->post('item_kontrak') as $key => $value) {
                $id[$key]["item_kontrak_id"] = $value;
             }
             $data = KontrakModels::find($id);
             $total_dana = preg_replace('/,/','',$request->post('total_dana')); 

            if((int)$total_dana > $data->sum('nominal')){
                Alert::error('Data Gagal Ditambahkan, Jumlah Nominal Tidak Relevan Dengan Jumlah Nominal Kontrak');
                return redirect()->back();
            }else{
                /** Untuk Rekap Transfer Parent
                 * 
                 * - id
                 * - firm_id
                 * - amount
                 * - Tanggal Terima   
                 * 
                 */ 
                $parent = TransferModels::create([
                    'firm_id' => $decrypted,
                    'amount' => preg_replace('/,/','',$request->post('total_dana')),
                    'amount_terima' => preg_replace('/,/','',$request->post('amount_terima')),
                    'tanggal_terima' =>  Carbon::parse(str_replace("/", "-", $request->post('tanggal_terima')))->format('Y/m/d'),
                    'created_by'=> Auth::user()->id,
                    'has_inserted' => 0
                ]);
        
                /** Untuk Rekap Transfer Child
                 * - id
                 * - Parent_id
                 * - item_kontrak_id
                 * - amount_item
                 */ 

                $data = [];
                foreach ($request->post('item_kontrak') as $key => $value) {
                    $data[$key]["parent_id"]= $parent->id;
                    $data[$key]["item_kontrak_id"] = $value;                
                }
                foreach ($request->post('alokasi_dana') as $key => $value) {
                    $data[$key]["amount_item"]= preg_replace('/,/','',$value);
                    $data[$key]["created_by"]=  Auth::user()->id;
                }
                TransferModels::insert($data);
                FirmModels::where('no_bukti',$request->post('no_bukti'))->update(['has_inserted'=>1]);
                DB::commit();
                Alert::success('Data Telah Ditambahkan');
                return redirect()->route('buktiTransferView');
            } 
        } catch (QueryException $e) {
            DB::rollBack();
            ErrorReport::ErrorRecords(100,$e,$request->url(),Auth::user()->id); 
            Alert::error('Data Gagal Ditambahkan');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      try {
          $decrypted = Crypt::decrypt($id);
          $data = TransferModels::find($decrypted);
          Alert::error('Fungsi ini sedang tahap perbaikan');
          return redirect()->back();
      } catch (Exception $e) {
          
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        try {
            $decrypted = Crypt::decrypt($id);
            TransferModels::destroy($decrypted);
            TransferModels::where('parent_id',$decrypted)->delete();
            Alert::success('Data Berhasil Dihapus');
            return redirect()->route('buktiTransferView');  
        } catch (Exception $e) {
            ErrorReport::ErrorRecords(102,$e,$request->url(),Auth::user()->id); 
            Alert::error('Data Gagal Dihapus','Harap Kontak Administrator/Superadmin');
            return redirect()->back(); 
        }
    }

    /**
     * API Services Controller
     */

    public function api(Request $request)
    {
        
    }
}
