<?php

namespace App\Http\Controllers;

use App\Facades\ErrorReport;
use App\Models\AktifitasModels;
use App\Models\KomponenBiaya;
use App\Models\KontrakModels; 
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class KontrakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = KontrakModels::where('parent_id',0)->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('kode_kontrak', function($row){
                $btn = '';
                if($row->parent_id == 0){
                    $btn .= '<a href="'.route('KontrakViewDetail',['id'=>Crypt::encrypt($row->id)]).'">'.$row->kode_kontrak.'</a>';
                }else{
                    $btn .= $row->kode_kontrak;
                }
                return $btn;
            })
            ->addColumn('action', function($row){
                $btn = '';
                // $btn .= '<a href="" class="btn btn-warning">Update Data</a>  '; 
                $btn .= '<button type="button" class="btn btn-warning" id="delete-confirm" data-name="'.Crypt::encrypt($row->id).'" >Change Password</button><button type="button" class="btn btn-danger" id="delete-confirm" data-name="'.Crypt::encrypt($row->id).'" >Delete Data</button><button type="button" class="btn btn-danger" id="delete-confirm" data-name="'.Crypt::encrypt($row->id).'" >Delete Data</button>';
                return $btn;
            })
            ->rawColumns(['kode_kontrak','action'])
            ->make(true);
        }
        return view('main.kontrak.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $date = Carbon::now()->format('d/m/Y'); 
        return view('main.kontrak.create',['date_now'=>$date]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        try {
            $push_first = [
                'parent_id' => 0,
                'kode_kontrak' =>$request->post('kode_kontrak'),
                'tanggal_kontrak' => Carbon::now()->format('d/m/Y'),
                'tanggal_kontrak_mulai' => $request->post('kontrak_mulai'),
                'tanggal_kontrak_akhir' => $request->post('kontrak_akhir')
    
    
            ];
            $resDB = KontrakModels::create($push_first);
            $res = [];
            foreach ($request->post('komponen') as $key => $value) { 
                $res[$key]['parent_id'] = $resDB->id;
                $res[$key]['id_komponen'] = $value;
            }
            foreach ($request->post('sub_komponen') as $key => $value) {
                $res[$key]['id_sub_komponen'] = $value; 
            }
            foreach ($request->post('sub_aktifitas') as $key => $value) {
                $res[$key]['id_subkomponen_aktifitas'] = $value; 
                
            }
            foreach ($request->post('kabupaten_dari') as $key => $value) {
                $res[$key]['kabupaten_asal'] = $value;
            }
            foreach ($request->post('provinsi_dari') as $key => $value) {
                $res[$key]['provinsi_asal'] = $value;
            }
            foreach ($request->post('kabupaten_ke') as $key => $value) {
                $res[$key]['kabupaten_tujuan']= $value;
            }
            foreach ($request->post('provinsi_ke') as $key => $value) {
                $res[$key]['provinsi_tujuan']= $value;
            }
            foreach ($request->post('kabupaten_dari_value') as $key => $value) {
                $res[$key]['kabupaten_asal_value']= $value;
            }
            foreach ($request->post('kabupaten_ke_value') as $key => $value) {
                $res[$key]['kabupaten_tujuan_value']= $value;
            }
            foreach ($request->post('periode_start') as $key => $value) {
                $res[$key]['start_periode'] = Carbon::parse($value)->format('Y/m/d');
            }
            foreach ($request->post('preiode_end') as $key => $value) {
                $res[$key]['end_periode'] = Carbon::parse($value)->format('Y/m/d');
            }
            foreach ($request->post('id_amandemen') as $key => $value) {
                $res[$key]['id_amandemen'] = $value;
            }
            foreach ($request->post('nominal') as $key => $value) {
                $res[$key]['nominal'] = $value;
            }
            foreach ($request->post('kantor') as $key => $value) {
                $res[$key]['id_kantor'] = $value;
            }
            foreach ($request->post('osp') as $key => $value) {
                $res[$key]['id_osp'] = $value;
            } 
            // dd($res);
            KontrakModels::insert($res);
            Alert::success('Data Telah Ditambahkan');
            return redirect()->route('KontrakHome');
        } catch (QueryException $e) {
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
    public function show(Request $request,$id)
    {
        //
        // dd($id);
        try {
            $decrypted = Crypt::decrypt($id);            
        } catch (DecryptException $e) {
            dd($e);
        } 
        try {
            if($request->ajax()){
                $data = KontrakModels::where('parent_id',$decrypted)->get();
                return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('komponen',function($row){
                    return $row->komponen->komponen_biaya;
                })
                ->addColumn('sub_komponen',function($row){
                    return $row->sub_komponen->komponen_biaya;
                })
                ->addColumn('aktifitas',function($row){
                    // return $row;
                    // $data = AktifitasModels::find($row);
                    // return $data[0]->nama_aktifitas;
                    return $row->aktifitas->nama_aktifitas;
                })
                ->addColumn('osp',function($row){
                    return $row->osp->osp_name;
                })
                ->addColumn('kantor',function($row){
                    return $row->kantor->kode_kantor.'-'.$row->kantor->nama_kantor;
                })
                ->addColumn('provinsi_asal',function($row){
                    return $row->join_provinsi_asal->provinsi_name;
                })
                ->addColumn('nominal', function($row){
                    return "Rp " . number_format($row->nominal,0,',','.');
                })
                ->addColumn('kabupaten_asal',function($row){
                    return $row->join_kabupaten_asal->kabupaten_name;
                })
                ->addColumn('provinsi_tujuan',function($row){
                    return $row->join_provinsi_tujuan->provinsi_name;
                })
                ->addColumn('kabupaten_tujuan',function($row){
                    return $row->join_kabupaten_tujuan->kabupaten_name;
                })
                ->addColumn('amandemen',function($row){
                    return $row->join_amandemen->nama_amandemen;
                })
                ->addColumn('action',function($row){
                    $btn = '';
                    // $btn .= '<a href="" class="btn btn-warning">Update Data</a>  '; 
                    $btn .= '<button type="button" class="btn btn-danger" id="delete-confirm" data-name="'.Crypt::encrypt($row->id).'" >Delete Data</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            } 
            return view('main.kontrak.show');
        } catch (QueryException $th) {
            dd($th);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        // dd($id);
        return view('main.kontrak.detail');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function post_detail(Request $request, $id)
    {
        try {
            $decrypted = Crypt::decrypt($request->post('urldata'));
        } catch (DecryptException $e) {
            
        }
        try { 
            // dd($request->post());
            foreach ($request->post('komponen') as $key => $value) { 
                $res[$key]['parent_id'] = $decrypted;
                $res[$key]['id_komponen'] = $value;
            }
            foreach ($request->post('sub_komponen') as $key => $value) {
                $res[$key]['id_sub_komponen'] = $value; 
            }
            foreach ($request->post('sub_aktifitas') as $key => $value) {
                $res[$key]['id_subkomponen_aktifitas'] = $value; 
                
            }
            foreach ($request->post('kabupaten_dari') as $key => $value) {
                $res[$key]['kabupaten_asal'] = $value;
            }
            foreach ($request->post('provinsi_dari') as $key => $value) {
                $res[$key]['provinsi_asal'] = $value;
            }
            foreach ($request->post('kabupaten_ke') as $key => $value) {
                $res[$key]['kabupaten_tujuan']= $value;
            }
            foreach ($request->post('provinsi_ke') as $key => $value) {
                $res[$key]['provinsi_tujuan']= $value;
            }
            foreach ($request->post('periode_start') as $key => $value) {
                $res[$key]['start_periode'] = $value;
            }
            foreach ($request->post('preiode_end') as $key => $value) {
                $res[$key]['end_periode'] = $value;
            }
            foreach ($request->post('id_amandemen') as $key => $value) {
                $res[$key]['id_amandemen'] = $value;
            }
            foreach ($request->post('nominal') as $key => $value) {
                $res[$key]['nominal'] = $value;
            }
            foreach ($request->post('kantor') as $key => $value) {
                $res[$key]['id_kantor'] = $value;
            }
            foreach ($request->post('osp') as $key => $value) {
                $res[$key]['id_osp'] = $value;
            } 
            // dd($res);
            KontrakModels::insert($res);
            Alert::success('Data Telah Ditambahkan');
            return redirect()->route('KontrakViewDetail',['id'=> $request->post('urldata')]);
        } catch (QueryException $e) {
            ErrorReport::ErrorRecords(100,$e,$request->url(),Auth::user()->id); 
            Alert::error('Data Gagal Ditambahkan');
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
        try {
            $master = Crypt::decrypt($id); 
        } catch (DecryptException $e) {
            
        }
        try {
        KontrakModels::destroy($master);
        KontrakModels::where('parent_id',$master)->delete();
        Alert::success('Data Berhasil Dihapus');
        return redirect()->route('KontrakHome');
        } catch (QueryException $e) {
            ErrorReport::ErrorRecords(102,$e,$request->url(),Auth::user()->id); 
            Alert::error('Data Gagal Dihapus','Harap Kontak Administrator/Superadmin');
            return redirect()->back(); 
        }
    }
    public function destroy_detail(Request $request,$id)
    {
        try {
            $master = Crypt::decrypt($id); 
        } catch (DecryptException $e) {
            
        }
        try {
        $kontrak_id = KontrakModels::find($master); 
        KontrakModels::destroy($master);
        Alert::success('Data Berhasil Dihapus');
        return redirect()->route('KontrakViewDetail',['id'=>Crypt::encrypt($kontrak_id->parent_id)]);
        } catch (QueryException $e) {
            ErrorReport::ErrorRecords(102,$e,$request->url(),Auth::user()->id); 
            Alert::error('Data Gagal Dihapus','Harap Kontak Administrator/Superadmin');
            return redirect()->back(); 
        }
    }
}
