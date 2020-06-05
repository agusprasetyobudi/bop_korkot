<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProvinsiModels;
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
        foreach ( $request->post('provinsi_name') as $key) {
            // dd($key);
            $data_push[] = [
                'provinsi_name'=> $key
            ];
        } 
        $data = ProvinsiModels::insert($data_push);
        // dd($data);

        if($data){
            Alert::success('Data Telah Ditambahkan');
            return redirect()->route('provinsiView');
        }else{
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
        //
        $decrypt = Crypt::decrypt($id);
        $getData = ProvinsiModels::find($decrypt); 
        return view('main.data_master.provinsi.update',['data'=>$getData]);
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
        $decrypt = Crypt::decrypt($request->post('url_data'));
        $pushData = ['provinsi_name'=>$request->post('provinsi_name')];
        $resData = ProvinsiModels::where('id',$decrypt)
                                ->update($pushData);
        if($resData){
            Alert::success('Data Telah Diupdate');
            return redirect()->route('provinsiView');
        }else{
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
    public function destroy($id)
    { 
        $decrypt = Crypt::decrypt($id); 
        $data = ProvinsiModels::destroy($decrypt); 
        if($data){
            Alert::success('Data Berhasil Dihapus');
            return redirect()->route('provinsiView'); 
        }else{
            Alert::error('Data Gagal Dihapus','Harap Kontak Superadmin');
            return redirect()->back(); 
        }
    }
}
