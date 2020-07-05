<?php

namespace App\Http\Controllers\Master;

use App\Facades\ErrorReport;
use App\Models\OSPModels;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use ErrorReports;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Auth;

class OSPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $getData = OSPModels::latest()->get();
            return DataTables::of($getData)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $btn = '';
                $btn .= '<a href="'.route('OSPEditView',['id'=>Crypt::encrypt($row->id)]).'" class="btn btn-warning">Update Data</a>  '; 
                $btn .= '<button type="button" class="btn btn-danger" id="delete-confirm" data-name="'.Crypt::encrypt($row->id).'" >Delete Data</button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }   
        return view('main.data_master.osp.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('main.data_master.osp.create');
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
            foreach ($request->post('osp_name') as $key) {
                # code...
                $data[] = [
                    'osp_name'=>$key
                ];
            } 
                $resData = OSPModels::insert($data); 
                Alert::success('Data Berhasil Ditambahkan');
                return redirect()->route('OSPView');
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
        $data = OSPModels::where('osp_name','like','%'.$request->post('q').'%')->get();
        // dd($data);
        $result = [];
        foreach ($data as $key => $value) { 
            $result[$key]['id'] = $value->id;
            $result[$key]['nama_osp'] = $value->osp_name;            
        }
        // dd($result);
        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd($id);
        try {
            $decrypted = Crypt::decrypt($id);
            $data = OSPModels::find($decrypted); 
            return view('main.data_master.osp.update',['data'=>$data]);
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
        //
        // dd($request->all());
        try {
            $decrypted = Crypt::decrypt($request->post('urlData')); 
            try {
                $pushdata = [
                    'osp_name' => $request->post('nama-osp')
                ];
                OSPModels::where('id',$decrypted)
                            ->update($pushdata);
                Alert::success('Data Telah Diupdate');
                return redirect()->route('OSPView');
            } catch (QueryException $e) { 
                ErrorReport::ErrorRecords(101,$e,$request->url(),Auth::user()->id);
                Alert::error('Terjadi Kesalahan!!','Silahkan Hubungi Administrator/Superadministrator');
                return redirect()->back();
            }

        } catch (DecryptException $e) {
            ErrorReport::ErrorRecords(103,$e,$request->url(),Auth::user()->id);
            Alert::error('Anda Tidak Mempunya Akses Ke Halaman Ini');            
            return redirect()->route('OSPView');
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
                OSPModels::destroy($decrypted);
                Alert::success('Data Berhasil Dihapus');
                return redirect()->route('OSPView');
            } catch (QueryException $e) {
                //throw $th;
                Alert::error('Terjadi Kesalahan','Harap Hubungi Administrator/Superadministrator');
                return redirect()->back();
            }
        } catch (DecryptException $e) { 
            ErrorReport::ErrorRecords(103,$e,$request->url(),Auth::user()->id);
            Alert::error('Anda Tidak Mempunya Akses Ke Halaman Ini');            
            return redirect()->route('OSPView');
        }
    }
}
