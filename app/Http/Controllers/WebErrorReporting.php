<?php

namespace App\Http\Controllers;

use App\Models\ErrorReporting;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class WebErrorReporting extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Alert::error('Fungsi Error Reporting Masih Dalam Proses Pembuatan'); 
        // return redirect()->back();
        if($request->ajax()){
            $data = ErrorReporting::all();
           return DataTables::of($data)
           ->addIndexColumn()
           ->addcolumn('error_code', function($row){
               if($row->error_code == 100){
                   return '100 - Error Create';
               }else if($row->error_code == 101){
                    return '101 - Error Edit  ';
               }else if($row->error_code == 102){
                    return '102 - Error Delete  ';
               }else if($row->error_code == 103){
                    return '103 - Error Decrypt';
                }else if($row->error_code == 104){
                    return '104 - Error Another';
                }
           })
           ->addColumn('action',function($row){
               return '<a href="'.route('WebErrorReportingView',['id'=>Crypt::encrypt($row->id)]).'" class="btn btn-warning">Show Data</a>';
           }) 
           ->addColumn('on_user_error',function($row){
                return User::find($row->user_id)->name;
           })
           ->addColumn('error_solved',function($row){
                return $row->error_solved != 1 ? 'Unsolved': 'Solved';
           })
           ->rawColumns(['error_code','action','on_user_error','error_solved'])
           ->make(true);
        }
        return view('main.errors_reporting.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        try {
            $decrypted = Crypt::decrypt($id);
            $data = ErrorReporting::find($decrypted); 
            Alert::error('Fungsi ini sedang tahap perbaikan');
            return redirect()->back();
            // return view('main.error_reporting.show');
        } catch (Exception $e) {
            
        }
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
