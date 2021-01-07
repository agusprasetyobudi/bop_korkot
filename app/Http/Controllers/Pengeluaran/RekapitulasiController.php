<?php

namespace App\Http\Controllers\Pengeluaran;

use App\Http\Controllers\Controller;
use App\Models\PengeluaranModels;
use App\Models\TransferModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class RekapitulasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = PengeluaranModels::all();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('bukti_transfer',function($row){
                return '19823190912';
            })
            ->addColumn('nama_penerima',function($row){
                return 'test';
            })
            ->addColumn('bank_penerima',function($row){
                return 'Bank Test';
            })
            ->addColumn('no_rekening',function($row){
                return '12982391098';
            })
            ->addColumn('nilai_kontrak',function($row){
                return 'Rp. 102.901.001';
            })
            ->addColumn('jumlah_terima',function($row){
                return 'Rp. 102.901.001';

            })
            ->addColumn('selisih',function($row){
                return '0';
            })
            ->addColumn('tanggal_terima',function($row){
                return '19-12-2020';
            })
            ->addColumn('periode',function($row){
                return 'Januari';
            })
            ->addColumn('implementasi',function($row){
                return 'Rp. 102.901.001';
            })
            ->addColumn('selisih',function($row){
                return '0';
            })
            ->addColumn('action',function($row){
                $btn = '';
                $btn .= '<a href="'.route('KantorEditView',['id'=>Crypt::encrypt($row->id)]).'" class="btn btn-warning">Edit</a>  '; 
                $btn .= '<button type="button" class="btn btn-danger" id="delete-confirm" data-name="'.Crypt::encrypt($row->id).'" >Delete</button>';
                return $btn;
            })
            ->rawColumns(['bukti_transfer','nama_penerima','bank_penerima','no_rekening','nilai_kontrak','jumlah_terima','selisih','tanggal_terima','periode','implementasi','selisih','action',])
            ->make(true);
        }
        return view('main.bukti_pengeluaran.rekapitulasi.index');
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

    public function datatable_api_get(Request $request)
    {
        # code...
    }

    public function api_bukti_transfer_get(Request $request)
    {
        \DB::enableQueryLog();
        $data = TransferModels::join('firm','transfer.id','=','firm.id')
        ->join('users','transfer.created_by','=','users.id')
        ->join('pengeluaran','transfer.id','=','pengeluaran.id_item_transfer')
        ->where('transfer.id','=','pengeluaran.id_item_transfer')
        ->select(['firm.no_bukti as no_bukti',
        'firm.tanggal_tf as tanggal_transfer',
        'firm.nama_penerima as nama_penerima',
        'firm.id_bank as id_bank',
        'firm.bank_account_number as no_rekening',
        ])
        ->get();
        dd(\DB::getQueryLog());
        dd($data);
    }
}
