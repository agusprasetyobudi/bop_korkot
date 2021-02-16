<?php

namespace App\Http\Controllers;

use App\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
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
                return '<a href="'.route('KelompokPenggunaEditView',['id'=>Crypt::encrypt($row->id)]).'" class="btn  btn-warning">Update Data</a> <button type="button" class="btn btn-danger" id="delete-confirm" data-name="'.Crypt::encrypt($row->id).'" >Delete Data</button>';
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
    public function edit(Request $request, $id)
    {
        Alert::error('Fungsi Masih Dalam Proses Pembuatan'); 
        return redirect()->back();
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
        // try {
        //     $decrypted = Crypt::decrypt($id);
        //     dd($decrypted);
        // } catch (Exception $th) {
        //     //throw $th;
        // }

        Alert::error('Fungsi Masih Dalam Proses Pembuatan'); 
        return redirect()->back();
    }
}
