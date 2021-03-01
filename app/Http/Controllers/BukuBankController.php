<?php

namespace App\Http\Controllers;

use App\Models\BukuBankModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class BukuBankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            if(Auth::user()->roles->id === 1 || Auth::user()->roles->id === 2){
                $data = BukuBankModels::join('firm','buku_bank.id_firm','=','firm.id')
                        ->join('transfer','buku_bank.id_item_transfer','=','transfer.id')
                        
                        ->get();
            }else{
                $data = BukuBankModels::all();
            }
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $btn = '';
                $btn .= '<a href="'.route('bukuBankEdit',['id'=>Crypt::encrypt($row->id)]).'" class="btn btn-sm btn-warning">Update</a>  ';
                return $btn;
            })
            ->rawColumns(['actions'])
            ->make(true);
        }
        return view('main.buku_bank.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('main.buku_bank.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax()){
            dd($request->all());
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

    /**
     * Report section on page reporting
     */
    public function report(Request $request)
    {
        //
        return view('main.report.buku_bank.index');
    }
}
