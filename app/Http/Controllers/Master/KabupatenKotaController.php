<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KabupatenModels;
use App\Models\ProvinsiModels;
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
                $btn = '<a href="'.route('KabupatenKotaEditView').'" class="btn btn-warning">Update Date</a>';
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
            return redirect()->route('KabupatenKotaView');
        }else{
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
    public function destroy($id)
    {
        //
    }
}
