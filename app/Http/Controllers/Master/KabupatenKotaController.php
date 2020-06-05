<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KabupatenModels;
use App\Models\ProvinsiModels;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class KabupatenKotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        if($request->ajax()){
            $data = KabupatenModels::latest()->get(); 
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('provinsi_name',function($row){
                $res = $row->provinsi->provinsi_name;
                return $res;
            })
            ->addColumn('action',function($row){                 
                $btn = '';
                $btn .= '<a href="'.route('KabupatenKotaEditView',['id'=>Crypt::encrypt($row->id)]).'" class="btn btn-warning">Update Data</a>  '; 
                $btn .= '<button type="button" class="btn btn-danger" id="delete-confirm" data-name="'.Crypt::encrypt($row->id).'" >Delete Data</button>';
                return $btn;
            })
            ->rawColumns(['action','provinsi_name'])
            ->make(true);
        }
        return view('main.data_master.kabupaten_kota.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinsi = ProvinsiModels::all(); 
        return view('main.data_master.kabupaten_kota.create',['province'=>$provinsi]);
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
        foreach ($request->input('name_kabupate_kota') as $key => $values) {
            # code...
            $data[$key] = [
                'kabupaten_name' => $values, 
            ]; 
        }
        foreach ($request->post('provinsi_id') as $key=> $values) {
            # code...
            $data[$key]['provinsi_id'] =  $values; 
        }   
        $status = KabupatenModels::insert($data);
        if($status){
            Alert::success('Data Telah Diupdate'); 
            return redirect()->route('KabupatenKotaView');
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
         try {
            $decrypted = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            dd($e);
        }
        $kabupaten = KabupatenModels::find($decrypted);
        $provinsi = ProvinsiModels::all();
        return view('main.data_master.kabupaten_kota.update',['province'=>$provinsi,'kabupaten'=>$kabupaten]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        
        try {
            $decrypted = Crypt::decrypt($request->post('urlData'));
        } catch (DecryptException $e) {
            dd($e);
        }
        $pushData = [
            'kabupaten_name'=> $request->post('nama-kota-kabupaten'),
            'provinsi_id' => $request->post('nama-provinsi')
        ];
        $ResData = KabupatenModels::where('id',$decrypted)
                                    ->update($pushData);
        if($ResData){
            Alert::success('Data Telah Diupdate');
            return redirect()->route('KabupatenKotaView');
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
        $data = KabupatenModels::destroy($decrypt); 
        if($data){
            Alert::success('Data Berhasil Dihapus')->persistent('Confirm');
            return redirect()->route('KabupatenKotaView'); 
        }else{
            Alert::error('Data Gagal Dihapus','Harap Kontak Superadmin');
            return redirect()->back(); 
        }
    }
}
