<?php

namespace App\Http\Controllers\Master;

use App\Facades\ErrorReport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AktifitasModels;
use App\Models\SubKomponenActivityModels;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class AktifitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->ajax()){
            $data = AktifitasModels::latest()->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $btn = '';
                $btn .= '<a href="'.route('AktifitasEditView',['id'=>Crypt::encrypt($row->id)]).'" class="btn btn-warning">Update Data</a>  '; 
                $btn .= '<button type="button" class="btn btn-danger" id="delete-confirm" data-name="'.Crypt::encrypt($row->id).'" >Delete Data</button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('main.data_master.aktifitas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('main.data_master.aktifitas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        try {
            foreach ($request->post('nama_aktifitas') as $key => $value) {
                $data[] = [
                    'nama_aktifitas'=> $value
                ];
            }
            AktifitasModels::insert($data);
            Alert::success('Data Berhasil Ditambahkan');
            return redirect()->route('AktifitasView');
        } catch (QueryException $e) {
            ErrorReport::ErrorRecords(101,$e,$request->url(),Auth::user()->id);
            Alert::error('Terjadi Kesalahan!!','Silahkan Hubungi Administrator/Superadministrator');
            return redirect()->back();
        }
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
            $data = AktifitasModels::find($decrypted); 
            return view('main.data_master.aktifitas.update',['data'=>$data]);
        } catch (DecryptException $e) {
            Alert::error('Data Terjadi Error','Silahkan Hubungi Ke Administrator/Superadministrator');
            return redirect()->back();
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
        // dd($request->all());
        try {
            $decrypted = Crypt::decrypt($request->post('urldata')); 
            try { 
                AktifitasModels::where('id',$decrypted)
                            ->update(['nama_aktifitas'=>$request->post('nama_aktifitas')]);
                Alert::success('Data Telah Diupdate');
                return redirect()->route('AktifitasView');
            } catch (QueryException $e) { 
                ErrorReport::ErrorRecords(101,$e,$request->url(),Auth::user()->id);
                Alert::error('Terjadi Kesalahan!!','Silahkan Hubungi Administrator/Superadministrator');
                return redirect()->back();
            }

        } catch (DecryptException $e) {
            ErrorReport::ErrorRecords(103,$e,$request->url(),Auth::user()->id);
            Alert::error('Anda Tidak Mempunya Akses Ke Halaman Ini');            
            return redirect()->route('home');
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
            // dd('hello');
            $decrypted = Crypt::decrypt($id);
            try {
                AktifitasModels::destroy($decrypted);
                Alert::success('Data Berhasil Dihapus');
                return redirect()->route('AktifitasView');
            } catch (QueryException $e) {
                //throw $th;
                ErrorReport::ErrorRecords(102,$e,$request->url(),Auth::user()->id);
                Alert::error('Terjadi Kesalahan','Harap Hubungi Administrator/Superadministrator');
                return redirect()->back();
            }
        } catch (DecryptException $e) { 
            ErrorReport::ErrorRecords(103,$e,$request->url(),Auth::user()->id);
            Alert::error('Anda Tidak Mempunya Akses Ke Halaman Ini');            
            return redirect()->route('home');
        }
    } 
}
