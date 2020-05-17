<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PmuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rekapInputView()
    {
        return view('main.pmu.rekap_input.index');
    }
    public function invoiceTerakhirView()
    {
        return view('main.pmu.invoice.index');
    }
    public function rekapKontrakView()
    {
        return view('main.pmu.rekap_kontrak.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rekapInputCreated()
    {
        return view('main.pmu.rekap_input.create');
    }
    public function invoiceTerakhirCreated()
    {
        return view('main.pmu.invoice.create');

    }
    public function rekapKontrakCreated()
    {
        return view('main.pmu.rekap_kontrak.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function rekapInputStore(Request $request)
    {
        //
    }
    public function invoiceTerakhirStore(Request $request)
    {
        //
    }
    public function rekapKontrakStore(Request $request)
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
