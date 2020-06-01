<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KabupatenModels;
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
        //
        if($request->ajax()){
            $data = KabupatenModels::latest()->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action')
            ->rawColumns([])
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
        return view('main.data_master.kabupaten_kota.create');
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
        //

        $data = [];
        foreach ($request->input('name_kabupate_kota') as $key => $values) {
            # code...
            $data[$key] = [
                'nama_kabupaten' => $values, 
            ]; 
        }
        foreach ($request->post('type_kabupate_kota') as $key=> $values) {
            # code...
            $data[$key]['type_kabupaten'] =  $values; 
        } 
        dd($data); 
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
