<?php

namespace App\Http\Controllers\Master;

use App\Facades\ErrorReport;
use App\Http\Controllers\Controller;
use App\Models\AmandemenModels;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class AmandemenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = AmandemenModels::latest()->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $btn = '';
                $btn .= '<a href="'.route('AmandemenUpdateView',['id'=>Crypt::encrypt($row->id)]).'" class="btn btn-warning">Update Data</a>  '; 
                $btn .= '<button type="button" class="btn btn-danger" id="delete-confirm" data-name="'.Crypt::encrypt($row->id).'" >Delete Data</button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('main.data_master.amandemen.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('main.data_master.amandemen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [];
        foreach ($request->post('kode_amandemen') as $key => $value) {
            $data[$key]['kode_amandemen'] = $value;
        }
        foreach ($request->post('nama_amandemen') as $key => $value) {
            $data[$key]['nama_amandemen'] = $value;
        }
        try {
            AmandemenModels::insert($data);
            Alert::success('Data Telah Ditambahkan');
            return redirect()->route('AmandemenView');
        } catch (QueryException $e) {
            ErrorReport::ErrorRecords(100,$e,$request->url(),Auth::user()->id); 
            Alert::error('Data Gagal Ditambahkan, Silahakn Hubungi Admin/SuperAdmin');
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
        // $data = AmandemenModels::get();
        $data = $request->post('q'); 
        preg_match('/\d+/', $data, $string); 
        if($string){ 
            $res = AmandemenModels::where('kode_amandemen','like','%'.$data.'%')->get();
        }else{
            $res = AmandemenModels::where('nama_amandemen','like','%'.$data.'%')->get();
        }
        $results=[];
        foreach ($res as $key => $value) {
            $results[$key]['id'] = $value->id;
            $results[$key]['kode_amandemen'] = $value->kode_amandemen;
            $results[$key]['nama_amandemen'] = $value->nama_amandemen;
        }
        return response()->json($results);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('main.data_master.amandemen.update');
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
        } catch (DecryptException $e) {
            ErrorReport::ErrorRecords(103,$e,$request->url(),Auth::user()->id);              
            Alert::error('Anda Tidak Mempunya Akses Ke Halaman Ini');            
            return redirect()->back();
        }
        try {
            AmandemenModels::destroy($decrypted);
            Alert::success('Data Berhasil Dihapus');
            return redirect()->route('AmandemenView');
        } catch (QueryException $e) {
            ErrorReport::ErrorRecords(102,$e,$request->url(),Auth::user()->id); 
            Alert::error('Data Gagal Dihapus','Harap Kontak Administrator/Superadmin');
            return redirect()->back();   
        }
    }
}
