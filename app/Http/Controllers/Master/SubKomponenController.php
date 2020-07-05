<?php

namespace App\Http\Controllers\Master;

use App\Facades\ErrorReport;
use App\Http\Controllers\Controller;
use App\Models\KomponenBiaya;
use App\Models\SubKomponenActivityModels;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class SubKomponenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        // 
        try {
            $decrypted = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            ErrorReport::ErrorRecords(100,$e,$request->url(),Auth::user()->id); 
            Alert::error('Data Gagal Ditambahkan');
            return redirect()->back();
        }
        if($request->ajax()){
            $data = KomponenBiaya::where('parent_id',$decrypted)->latest()->get();
            // dd($data);
            return DataTables::of($data)
            ->addIndexColumn()  
            ->addColumn('nama_komponen',function($row){
                return $row->komponen_biaya;
            })
            ->addColumn('action',function($row){
                $btn = '';
                $btn .= '<a href="'.route('AktifitasSubKomponen',['id'=>Crypt::encrypt($row->id),'sub_id'=>Crypt::encrypt($row->parent_id)]).'" class="btn btn-info">Aktifitas</a>  '; 
                $btn .= '<a href="'.route('SubKomponenUpdateView',['id'=>Crypt::encrypt($row->parent_id),'sub_id'=>Crypt::encrypt($row->id)]).'" class="btn btn-warning">Update Data</a>  '; 
                $btn .= '<button type="button" class="btn btn-danger" id="delete-confirm" data-name="'.Crypt::encrypt($row->parent_id).'" data-id="'.Crypt::encrypt($row->id).'" >Delete Data</button>';
                return $btn;
            })
            ->rawColumns(['action','nama_komponen'])
            ->make(true);
        }
        return view('main.data_master.sub_komponen.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        return view('main.data_master.sub_komponen.create');
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
        try {
        $decrypted = Crypt::decrypt($request->post('urldata'));
        } catch (DecryptException $e) {
            ErrorReport::ErrorRecords(103,$e,$request->url(),Auth::user()->id);
            Alert::error('Anda Tidak Mempunya Akses Ke Halaman Ini');    
            return redirect()->route('home');
        }
        $data = [];
        foreach ($request->post('sub_komponen') as $key => $value) {
            $data[$key]['komponen_biaya'] = $value;
            $data[$key]['parent_id'] = $decrypted;
            $data[$key]['read_only'] = 0;
        }
        foreach ($request->post('p') as $key => $value) {
         if($value){
            $data[$key]['allow_provinsi'] = 1;
         }else{
         $data[$key]['allow_provinsi'] = 0; 
         }
        }
        foreach ($request->post('a') as $key => $value) {
         if($value){
            $data[$key]['allow_assisten'] = 1;
         }else{
         $data[$key]['allow_assisten'] = 0;
         }
        }
        foreach ($request->post('k') as $key => $value) {
         if($value){
            $data[$key]['allow_korkot'] = 1;
         }else{
         $data[$key]['allow_korkot'] = 0;
         }

        } 
        // dd($decrypted);
        try {
            KomponenBiaya::insert($data);
            KomponenBiaya::where('id',$decrypted)
            ->update(['is_parent'=>1]);
            Alert::success('Data Telah Ditambahkan');
            return redirect()->route('SubKomponenView',['id'=>$request->post('urldata')]);
        } catch (QueryException $e) { 
            ErrorReport::ErrorRecords(100,$e,$request->url(),Auth::user()->id); 
            // dd($e);
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
    public function get(Request $request)
    {
        // dd(KomponenBiaya::where('parent_id',$request->post('id'))->get());
        $data = KomponenBiaya::where('parent_id',$request->post('id'))->where('komponen_biaya','like','%'.$request->post('q').'%')->get(); 
        $results = [];
        foreach ($data as $key => $value) {
            $results[$key]['id'] = $value->id;
            $results[$key]['nama_komponen'] = $value->komponen_biaya;
        }
        return response()->json($results);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $sub_id)
    {
        try { 
            $sub_ids = Crypt::decrypt($sub_id);  
            $data = KomponenBiaya::find($sub_ids); 
            return view('main.data_master.sub_komponen.update',['id'=> $id,'sub_id'=>$sub_id, 'data'=>$data]);
        } catch (DecryptException $e) {
            
        }
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
            $parent_id = Crypt::decrypt($request->post('urldata')); 
            $id = Crypt::decrypt($request->post('sub_urldata')); 
            try { 
                KomponenBiaya::where('id',$id)
                            ->where('parent_id',$parent_id)
                            ->update(['komponen_biaya'=>$request->post('sub_komponen'),
                                    'allow_provinsi'=>$request->post('p'),
                                    'allow_assisten'=>$request->post('a'),
                                    'allow_korkot'=>$request->post('k')]);
                Alert::success('Data Telah Diupdate');
                return redirect()->route('SubKomponenView',['id'=>$request->post('urldata')]);
            } catch (QueryException $e) { 
                ErrorReport::ErrorRecords(101,$e,$request->url(),Auth::user()->id);
                Alert::error('Terjadi Kesalahan!!','Silahkan Hubungi Administrator/Superadministrator');
                return redirect()->back();
                // dd($e);
            }

        } catch (DecryptException $e) {
            ErrorReport::ErrorRecords(103,$e,$request->url(),Auth::user()->id);
            Alert::error('Anda Tidak Mempunya Akses Ke Halaman Ini');            
            return redirect()->route('home');
        }
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id,$sub_id)
    { 
        try {
            $id = Crypt::decrypt($id); 
        } catch (DecryptException $e) {
            ErrorReport::ErrorRecords(102,$e,$request->url(),Auth::user()->id); 
            Alert::error('Data Gagal Dihapus','Harap Kontak Administrator/Superadmin');
            return redirect()->back(); 
        }
 
        try { 
            KomponenBiaya::destroy($id);
            SubKomponenActivityModels::where('id_subkomponen',$id)->delete();
            Alert::success('Data Berhasil Dihapus')->persistent('Confirm');
            return redirect()->route('SubKomponenView',['id'=>$sub_id]);
        } catch (QueryException $e) { 
            ErrorReport::ErrorRecords(102,$e,$request->url(),Auth::user()->id); 
            Alert::error('Data Gagal Dihapus','Harap Kontak Administrator/Superadmin');
            return redirect()->back(); 
        }
    }
}
