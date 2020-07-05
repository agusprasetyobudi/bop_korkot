<?php

namespace App\Http\Controllers\Master;

use App\Facades\ErrorReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AktifitasModels;
use App\Models\SubKomponenActivityModels;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class SubKomponenAktifitasController extends Controller
{  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id,$sub_id)
    {
        try {
            $decrypted = Crypt::decrypt($id); 
        } catch (DecryptException $e) {
            dd($e);
        }
        if($request->ajax()){ 
            $data = SubKomponenActivityModels::where('id_subkomponen',$decrypted)->latest()->get();
            // if(count($data)) $data['sub_id'] = $sub_id; 
            // dd($data);
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama_aktifitas',function($row){
                return $row->activity->nama_aktifitas;
            })
            ->addColumn('action',function($row){ 
                $btn = '';
                $btn .= '<button type="button" class="btn btn-danger" id="delete-confirm" data-name="'.Crypt::encrypt(['id'=>$row->id,'parent_id'=>$row->subkomponen->parent_id,'id_subkomponen'=>$row->subkomponen->id]).'" >Delete Data</button>';
                return $btn;
            })
            ->rawColumns(['action','nama_aktifitas'])
            ->make(true);
        }
        return view('main.data_master.aktifitas.sub_komponen.index',['id'=>$sub_id,'parent_id'=>$id]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$id,$sub_id)
    {
        // dd(['id'=>Crypt::decrypt($sub_id),'parent_id'=>Crypt::decrypt($id)]);
        $data = AktifitasModels::all();
        // dd($data);
        return view('main.data_master.aktifitas.sub_komponen.create',['id'=>$id,'parent_id'=>$sub_id,'data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());    
        // dd(['id'=>Crypt::decrypt($request->post('urldata')),'parent_id'=>Crypt::decrypt($request->post('sub_urldata'))]);
       try {
           $decrypted = Crypt::decrypt($request->post('urldata'));
           $data = [];
           foreach ($request->post('nama_aktifitas') as $key => $value) {
               $data[$key]['id_subkomponen'] = $decrypted;
               $data[$key]['id_aktifitas'] = $value;
           }
       } catch (DecryptException $e) {
            ErrorReport::ErrorRecords(103,$e,$request->url(),Auth::user()->id);
            Alert::error('Anda Tidak Mempunya Akses Ke Halaman Ini');            
            return redirect()->route('home');
       }
       try {
        SubKomponenActivityModels::insert($data);
        Alert::success('Data Aktifitas Telah Ditambahkan');
        return redirect()->route('AktifitasSubKomponen',['id'=>$request->post('urldata'),'sub_id'=>$request->post('sub_urldata')]);
       } catch (QueryException $e) {
            ErrorReport::ErrorRecords(101,$e,$request->url(),Auth::user()->id);
            Alert::error('Terjadi Kesalahan!!','Silahkan Hubungi Administrator/Superadministrator');
            return redirect()->back();
       }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        $results = []; 
        if($request->post('q')){
            // Declare Aktifitas get ID
            $varAct = AktifitasModels::where('nama_aktifitas','like','%'.$request->post('q').'%')->get();     
            $var = [];
            foreach ($varAct as $key => $value) {  
                $var[$key] = $value->id;
            } 
            // Declare sub komponen activity by id aktifitas
            $data=[];
            foreach ($var as $key => $value) {   
                $data[$key] = SubKomponenActivityModels::where('id_subkomponen',$request->post('id'))
                        ->where('id_aktifitas','like','%'.$value.'%')->get(); 
            }  
            // Double Foreach Processing
            $loops = [];  
            foreach ($data as $key => $value) {   
                $loops[$key] = $value[0];   
            } 
            foreach ($loops as $key => $values) {  
                $results[$key]['id'] = $values->id;
                $results[$key]['nama_aktifitas'] = $values->activity->nama_aktifitas;
            }
        }else{
            $data = SubKomponenActivityModels::where('id_subkomponen',$request->post('id'))->get();
            foreach ($data as $key => $values) {  
                $results[$key]['id'] = $values->id;
                $results[$key]['nama_aktifitas'] = $values->activity->nama_aktifitas;
            }
        }  
        return response()->json($results);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        //               
        Alert::success('Data Aktifitas Telah Ditambahkan');

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
        //
        dd($request);                
        Alert::success('Data Aktifitas Telah Ditambahkan');

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
            $ids = Crypt::decrypt($id);              

        } catch (DecryptException $e) {
            ErrorReport::ErrorRecords(103,$e,$request->url(),Auth::user()->id);
            Alert::error('Anda Tidak Mempunya Akses Ke Halaman Ini');            
            return redirect()->route('home');
            
        }
        try {
            SubKomponenActivityModels::destroy($ids['id']);
            Alert::success('Data Berhasil Dihapus');
            return redirect()->route('AktifitasSubKomponen',['id'=>Crypt::encrypt($ids['id_subkomponen']),'sub_id'=>Crypt::encrypt($ids['parent_id'])]);
        } catch (QueryException $e) {
            ErrorReport::ErrorRecords(102,$e,$request->url(),Auth::user()->id);
            Alert::error('Terjadi Kesalahan','Harap Hubungi Administrator/Superadministrator');            
            return redirect()->back();
        } 

    } 
}
