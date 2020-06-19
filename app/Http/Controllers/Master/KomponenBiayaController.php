<?php

namespace App\Http\Controllers\Master;

use App\Facades\ErrorReport;
use App\Http\Controllers\Controller;
use App\Models\KomponenBiaya;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class KomponenBiayaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = KomponenBiaya::latest()->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama_komponen', function($row){
                $btn = '';
                if($row->parent_id == $row->id){
                    $btn .= '<a href="'.route('SubKomponenView',['id'=>Crypt::encrypt($row->id)]).'">'.$row->komponen_biaya.'</a>';
                }else{
                    $btn .= $row->komponen_biaya;
                }
                return $btn;
            })
            ->addColumn('read_only',function($row){
                $btn = '';
                if($row->read_only == 0){
                    $btn .= '<a href="'.route('KomponenBiayaReadonly',['id'=>Crypt::encrypt($row->id)]).'" class="btn btn-warning">Read Only</a>  ';
                }else{
                    $btn .= '<a href="'.route('KomponenBiayaUnReadonly',['id'=>Crypt::encrypt($row->id)]).'" class="btn btn-success">Visible</a>  ';
                }
                return $btn;
            })
            ->addColumn('action',function($row){
                $btn = '';
                if($row->parent_id != $row->id){ $btn .= '<a href="'.route('SubKomponenCreateView',['id'=>Crypt::encrypt($row->id)]).'" class="btn btn-info">Tambah Sub Komponen</a>  ';}
                $btn .= '<a href="'.route('KomponenBiayaEditView',['id'=>Crypt::encrypt($row->id)]).'" class="btn btn-warning">Update Data</a>  '; 
                $btn .= '<button type="button" class="btn btn-danger" id="delete-confirm" data-name="'.Crypt::encrypt($row->id).'" >Delete Data</button>';
                return $btn;
            })
            ->rawColumns(['action','read_only','nama_komponen'])
            ->make(true);
        }
        return view('main.data_master.komponen_biaya.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $user = \App\User::find(Auth::user()->id); 
        return view('main.data_master.komponen_biaya.create');
        
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
            $data = [];
            foreach ($request->post('komponen_biaya') as $key => $value) {
                $data[$key] = [
                    'komponen_biaya'=>$value,
                    'read_only' =>0,
                    'allow_provinsi'=> 0,
                    'allow_korkot'=> 0,
                    'allow_assisten'=> 0,
                ];
            } 
            KomponenBiaya::insert($data);
            Alert::success('Data Telah Ditambahkan');
            return redirect()->route('KomponenBiayaView');
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
    public function edit(Request $request,$id)
    {
        try {
            $decrypted = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            ErrorReport::ErrorRecords(103,$e,$request->url(),Auth::user()->id);
            Alert::error('Anda Tidak Mempunya Akses Ke Halaman Ini');    
            return redirect()->route('home');
        }
        return view('main.data_master.komponen_biaya.update');
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
        try {
            $decrypted = Crypt::decrypt($request->post('urldata'));     
        } catch (DecryptException $e) {
            ErrorReport::ErrorRecords(103,$e,$request->url(),Auth::user()->id);
            Alert::error('Anda Tidak Mempunya Akses Ke Halaman Ini');    
            return redirect()->route('home'); 
        }
        try { 
            $pushData = [  
            ];
            // dd($pushData);
            KomponenBiaya::where('id',$decrypted)
                        ->update($pushData);
            Alert::success('Data Telah Diupdate');
            return redirect()->route('KomponenBiayaView');
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
        try {
            $decrypted = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            ErrorReport::ErrorRecords(103,$e,$request->url(),Auth::user()->id);              
            Alert::error('Anda Tidak Mempunya Akses Ke Halaman Ini');            
            return redirect()->back();
        }

        try { 
            KomponenBiaya::destroy($decrypted); 
            Alert::success('Data Berhasil Dihapus')->persistent('Confirm');
            return redirect()->route('KomponenBiayaView'); 
        } catch (QueryException $e) { 
            ErrorReport::ErrorRecords(102,$e,$request->url(),Auth::user()->id); 
            Alert::error('Data Gagal Dihapus','Harap Kontak Administrator/Superadmin');
            return redirect()->back(); 
        }  
    }
    public function readonly(Request $request,$id)
    {
        try {
            $decrypted = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            ErrorReport::ErrorRecords(102,$e,$request->url(),Auth::user()->id); 
            Alert::error('Data Gagal Dihapus','Harap Kontak Administrator/Superadmin');
            return redirect()->back(); 
        }
        try {
            KomponenBiaya::where('id', $decrypted)
            ->update(['read_only'=>1]);
            Alert::success('Data Berhasil DiRead Only');
            return redirect()->route('KomponenBiayaView');
        } catch (QueryException $e) {
            ErrorReport::ErrorRecords(101,$e,$request->url(),Auth::user()->id);
            Alert::error('Terjadi Kesalahan !!','Silahakn Hubungi Admin');
            return redirect()->back();
        }
    }
    public function unreadonly(Request $request,$id)
    {
        try {
            $decrypted = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            ErrorReport::ErrorRecords(102,$e,$request->url(),Auth::user()->id); 
            Alert::error('Data Gagal Dihapus','Harap Kontak Administrator/Superadmin');
            return redirect()->back(); 
        }
        try {
            KomponenBiaya::where('id', $decrypted)
            ->update(['read_only'=>0]);
            Alert::success('Data Berhasil DiVisible');
            return redirect()->route('KomponenBiayaView');
        } catch (QueryException $e) {
            ErrorReport::ErrorRecords(101,$e,$request->url(),Auth::user()->id);
            Alert::error('Terjadi Kesalahan !!','Silahakn Hubungi Admin');
            return redirect()->back();
        }
    }
}
