<?php

namespace App\Http\Controllers;

use App\Facades\ErrorReport;
use App\Facades\MonthnYear;
use App\Models\FirmModels;
use App\Models\LogFirm;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class FirmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = FirmModels::get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $btn = '';
                $btn .= '<a href="'.route('firmEditView',['id'=>Crypt::encrypt($row->id)]).'" class="btn btn-sm btn-warning">Update</a>  '; 
                $btn .= '<button type="button" class="btn btn-sm btn-danger" id="delete-confirm" data-name="'.Crypt::encrypt($row->id).'" >Delete</button>';
                return $btn;
            })
            ->addColumn('osp', function($row){
                return $row->OSP->osp_name;
            })
            ->addColumn('jabatan',function($row){
                return $row->Jabatan->nama_jabatan;
            })
            ->addColumn('kantor',function($row){
                return $row->Kantor->nama_kantor;
            })
            ->addColumn('periode',function($row){
                return $row->periode_month.' - '.$row->periode_year;
            })
            ->addColumn('bank',function($row){
                return $row->Bank->nama_bank;
            })
            ->addColumn('amount_tf',function($row){
                return  "Rp " . number_format($row->amount_tf,0,',','.');;
            })
            ->rawColumns(['action','osp','jabatan','kantor','amount_tf'])
            ->make(true);
        }
        return view('main.firm.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        return view('main.firm.create',['date'=> Carbon::now()->format('d/m/Y'),'month'=>MonthnYear::getList()->month,'year'=>MonthnYear::getList()->year]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        // dd($request->post());
        try {
            $data = array(
                'no_bukti'=> $request->post('no_bukti_trf'),
                'tanggal_tf'=> $request->post('tanggal_trf'),
                'jabatan'=> $request->post('jabatan'),
                'osp'=> $request->post('osp'),
                'kantor'=> $request->post('kantor'),
                'periode_month'=> $request->post('periode_month'),
                'periode_year'=> $request->post('periode_year'),
                'id_bank'=> $request->post('bank'),
                'nama_penerima'=> $request->post('penerima'),
                'bank_account_number'=> $request->post('no_rekening'),
                'amount_tf'=> $request->post('jumlah_transfer'),
                'description'=> $request->post('keterangan'),
                'created_by'=> Auth::user()->id
            ); 
            FirmModels::create($data);
            Alert::success('Data Berhasil Ditambahkan');
            return redirect()->route('firmView');
        } catch (QueryException $e) {
            ErrorReport::ErrorRecords(101,$e,$request->url(),Auth::user()->id);
            Alert::error('Terjadi Kesalahan!!','Silahkan Hubungi Administrator/Superadministrator');
            return redirect()->back();
        }
       
        // dd($data);
        
    }

    /**
     * Display the resource returned to json data.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function api(Request $request)
    {
        if($request->post('jabatan')){
            $data = FirmModels::where('jabatan','like','%'.$request->post('jabatan').'%');
        }else if($request->post('kantor')){
            $data = FirmModels::where('kantor','like','%'.$request->post('kantor').'%');
        }else if($request->post('user')){
            $data = FirmModels::where('user','like','%'.$request->post('user').'%');
        }else{
            $data = FirmModels::get();
        }
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        try {
            $decrypted = Crypt::decrypt($id);
            // dd($decrypted);
        } catch (DecryptException $e) {
            ErrorReport::ErrorRecords(103,$e,$request->url(),Auth::user()->id);  
            Alert::error('Anda Tidak Mempunya Akses Ke Halaman Ini');    
            return redirect()->route('home');
        }
        $data = FirmModels::find($decrypted);
        // return response()->json($data);
        $responses = [
            'data'=> $data,
            'jabatan'=>(object)[
                'id'=>$data->jabatan,
                'nama_data' => $data->Jabatan->nama_jabatan
            ],
            'osp'=>(object)[
                'id'=>$data->osp,
                'nama_data' => $data->OSP->osp_name
            ],
            'kantor'=>(object)[
                'id'=>$data->kantor,
                'nama_data' => $data->Kantor->nama_kantor
            ],
            'bank'=>(object)[
                'id'=>$data->id_bank,
                'nama_data' => $data->Bank->nama_bank
            ],
        ];  
        return view('main.firm.update',$responses);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $decrypted = Crypt::decrypt($request->post('urldata'));     
        } catch (DecryptException $e) {
            ErrorReport::ErrorRecords(103,$e,$request->url(),Auth::user()->id);
            Alert::error('Anda Tidak Mempunya Akses Ke Halaman Ini');    
            return redirect()->route('home'); 
        }
        try { 
            $pushData = [   
                'no_bukti'=> $request->post('no_bukti_trf'),
                'tanggal_tf'=> $request->post('tanggal_trf'),
                'jabatan'=> $request->post('jabatan'),
                'osp'=> $request->post('osp'),
                'kantor'=> $request->post('kantor'),
                'periode_month'=> $request->post('periode_month'),
                'periode_year'=> $request->post('periode_year'),
                'id_bank'=> $request->post('bank'),
                'nama_penerima'=> $request->post('penerima'),
                'bank_account_number'=> $request->post('no_rekening'),
                'amount_tf'=> $request->post('jumlah_transfer'),
                'description'=> $request->post('keterangan'),
                'updated_by'=> Auth::user()->id
            ];
            LogFirm::create(array('id_firm'=>$decrypted,'updated_by'=>Auth::user()->id,'type_log'=>'UPDATED DATA'));
            FirmModels::where('id',$decrypted)
                        ->update($pushData);
            Alert::success('Data Telah Diupdate');
            return redirect()->route('firmView');
        } catch (QueryException $e) {
            ErrorReport::ErrorRecords(101,$e,$request->url(),Auth::user()->id);
            Alert::error('Terjadi Kesalahan !!','Silahakn Hubungi Admin');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        try {
            $decrypted = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            ErrorReport::ErrorRecords(103,$e,$request->url(),Auth::user()->id);              
            Alert::error('Anda Tidak Mempunya Akses Ke Halaman Ini');            
            return redirect()->back();
        }

        try { 
            // LogFirm::create(array('id_firm'=>$decrypted,'updated_by'=>Auth::user()->id,'type_log'=>'DELETED DATA'));
            FirmModels::destroy($decrypted); 
            Alert::success('Data Berhasil Dihapus')->persistent('Confirm');
            return redirect()->route('firmView'); 
        } catch (QueryException $e) { 
            ErrorReport::ErrorRecords(102,$e,$request->url(),Auth::user()->id); 
            Alert::error('Data Gagal Dihapus','Harap Kontak Administrator/Superadmin');
            return redirect()->back(); 
        }  
    }

    /**
     * Report Section on page reporting
     */
    public function report(Request $request)
    {
        return view('main.report.firm_transfer.index');
    }
}

