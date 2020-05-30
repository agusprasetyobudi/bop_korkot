<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function penerimaTF(Request $request)
    {
        //
        return view('main.report.transfer.penerimaan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pengeluaranTF(Request $request)
    {
        //
        return view('main.report.transfer.pengeluaran.index');
    }

    /**
     * Export Excel
     */

     public function ExcelExport(Request $request)
     {
         # code...
     }
 
}
