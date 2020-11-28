<?php

namespace App\Http\Controllers\Rekapitulasi;

use App\Facades\ErrorReport;
use App\Http\Controllers\Controller;
use App\Models\TransferModels;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = TransferModels::all();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $btn = '';
                $btn .= '<a href="'.route('KantorEditView',['id'=>Crypt::encrypt($row->id)]).'" class="btn btn-warning">Edit</a>  '; 
                $btn .= '<button type="button" class="btn btn-danger" id="delete-confirm" data-name="'.Crypt::encrypt($row->id).'" >Delete</button>';
                return $btn;
            })
            ->rawColumns([])
            ->make(true);
        }
        return view('main.transfer.rekapitulasi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('main.transfer.rekapitulasi.create');
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
        try {
            $decrypted = Crypt::decrypt($request->post('firm'));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            
        }
        // dd();
        try {
            //  Untuk Rekap Transfer Parent
        // id
        // firm_id
        // amount
        // Tanggal Terima 
        $parent = TransferModels::create([
            'firm_id' => $decrypted,
            'amount' => preg_replace('/,/','',$request->post('total_dana')),
            'tanggal_terima' =>  Carbon::parse(str_replace("/", "-", $request->post('tanggal_terima')))->format('Y/m/d'),
            'created_by'=> Auth::user()->id
        ]);
       

        //  Untuk Rekap Transfer Child
        // id
        // Parent_id
        //item_kontrak_id
        // amount_item
         $data = [];
        foreach ($request->post('item_kontrak') as $key => $value) {
            $data[$key]["parent_id"]= $parent->id;
            $data[$key]["item_kontrak_id"] = $value;                
        }
        foreach ($request->post('alokasi_dana') as $key => $value) {
            $data[$key]["amount_item"]= preg_replace('/,/','',$value);
            $data[$key]["created_by"]=  Auth::user()->id;
        }
        TransferModels::insert($data);
        Alert::success('Data Telah Ditambahkan');
        return redirect()->route('buktiTransferView');
        } catch (QueryException $e) {
            ErrorReport::ErrorRecords(100,$e,$request->url(),Auth::user()->id); 
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
     * API Services Controller
     */

    public function api(Request $request)
    {
        
    }
}
