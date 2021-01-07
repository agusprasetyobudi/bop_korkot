<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KelompokPenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Role::all();
            return DataTables::of($data)
            ->addIndexColumn() 
            ->addColumn('opsi',function($row){
                return '<button type="button" class="btn btn-warning" id="change-password" data-name="'.Crypt::encrypt($row->id).'" >Change Password</button> <a href="'.route('PenggunaEditView',['id'=>Crypt::encrypt($row->id)]).'" class="btn  btn-primary">Update Pengguna</a> <button type="button" class="btn btn-danger" id="delete-confirm" data-name="'.Crypt::encrypt($row->id).'" >Delete Data</button>';
            })
            ->rawColumns(['opsi'])
            ->make(true);
        }
        return view('main.pengguna.kelompok_pengguna.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('main.pengguna.kelompok_pengguna.create');
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
