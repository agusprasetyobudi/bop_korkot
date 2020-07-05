<?php

namespace App\Http\Controllers\Master;

use App\Facades\ErrorReport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProvinsiModels;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = ProvinsiModels::latest()->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '';
                $btn .= '<a href="'.route('provinsiEditView',['id'=> Crypt::encrypt($row->id)]).'" class="btn btn-warning">Update Data</a> '; 
                $btn .= '<button type="button" class="btn btn-danger" id="delete-confirm" data-name="'.Crypt::encrypt($row->id).'" >Delete Data</button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('main.data_master.provinsi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('main.data_master.provinsi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            foreach ( $request->post('provinsi_name') as $key) { 
                $data_push[] = [
                    'provinsi_name'=> $key
                ];
            } 
            ProvinsiModels::insert($data_push); 
            Alert::success('Data Telah Ditambahkan');
            return redirect()->route('provinsiView');
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
    public function get(Request $request)
    {
        // $data = ProvinsiModels::all();
        $data = ProvinsiModels::where('provinsi_name','like','%'.$request->post('q').'%')->get();
        $results = [];
        foreach ($data as $key => $value) {
            $results[$key]['id'] = $value->id;
            $results[$key]['provinsi'] = $value->provinsi_name;
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
        try {
            $decrypted = Crypt::decrypt($id);
            $getData = ProvinsiModels::find($decrypted); 
            return view('main.data_master.provinsi.update',['data'=>$getData]);
        } catch (DecryptException $e) {
            ErrorReport::ErrorRecords(100,$e,$request->url(),Auth::user()->id);
            Alert::error('Anda Tidak Mempunya Akses Ke Halaman Ini');    
            return redirect()->route('home');
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
            $decrypt = Crypt::decrypt($request->post('url_data')); 
        } catch (DecryptException $e) { 
            ErrorReport::ErrorRecords(103,$e,$request->url(),Auth::user()->id);
            Alert::error('Anda Tidak Mempunya Akses Ke Halaman Ini');    
            return redirect()->route('home'); 
        }

        try {
            $pushData = ['provinsi_name'=>$request->post('provinsi_name')];
            $resData = ProvinsiModels::where('id',$decrypt)
                                    ->update($pushData);
            Alert::success('Data Telah Diupdate');
            return redirect()->route('provinsiView');
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
            return redirect()->route('home'); 
        } 
        
        try {
            ProvinsiModels::destroy($decrypted); 
            Alert::success('Data Berhasil Dihapus');
            return redirect()->route('provinsiView'); 
        } catch (QueryException $e) {
            ErrorReport::ErrorRecords(102,$e,$request->url(),Auth::user()->id);
            Alert::error('Data Gagal Dihapus','Harap Kontak Superadmin');
            return redirect()->back(); 
        }
    }
}
