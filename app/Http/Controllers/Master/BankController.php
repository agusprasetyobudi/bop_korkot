<?php

namespace App\Http\Controllers\Master;

use App\Facades\ErrorReport;
use App\Http\Controllers\Controller;
use App\Models\MasterBank;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = MasterBank::get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $btn = '';
                $btn .= '<a href="'.route('BankEditView',['id'=>Crypt::encrypt($row->id)]).'" class="btn btn-warning">Update Data</a>  '; 
                $btn .= '<button type="button" class="btn btn-danger" id="delete-confirm" data-name="'.Crypt::encrypt($row->id).'" >Delete Data</button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('main.data_master.bank.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('main.data_master.bank.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        try {
            foreach ($request->post('nama_bank') as $key => $value) { 
                $data[] = [
                    'nama_bank'=> $value
                ];
            } 
            MasterBank::insert($data);
            Alert::success('Data Berhasil Ditambahkan');
            return redirect()->route('BankView');
        } catch (QueryException $e) { 
            ErrorReport::ErrorRecords(101,$e,$request->url(),Auth::user()->id);
            Alert::error('Terjadi Kesalahan!!','Silahkan Hubungi Administrator/Superadministrator');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = $request->post('q'); 
        preg_match('/\d+/', $data, $string);  
        $res = MasterBank::where('nama_bank','like','%'.$data.'%')->get(); 
        return response()->json($res);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        try {
            $decrypted = Crypt::decrypt($id); 
        } catch (DecryptException $e) {
            ErrorReport::ErrorRecords(103,$e,$request->url(),Auth::user()->id);
            Alert::error('Anda Tidak Mempunya Akses Ke Halaman Ini');    
            return redirect()->route('home'); 
        } 
            $data = MasterBank::find($decrypted);
            return view('main.data_master.bank.update',['data'=>$data]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $decrypted = Crypt::decrypt($request->post('urldata'));     
        } catch (DecryptException $e) {
            ErrorReport::ErrorRecords(103,$e,$request->url(),Auth::user()->id);
            Alert::error('Anda Tidak Mempunya Akses Ke Halaman Ini');    
            return redirect()->route('home'); 
        }
        try { 
            $pushData = [  
                "nama_bank" => $request->post('nama_bank'), 
            ];
            // dd($pushData);
            MasterBank::where('id',$decrypted)
                        ->update($pushData);
            Alert::success('Data Telah Diupdate');
            return redirect()->route('BankView');
        } catch (QueryException $e) {
            ErrorReport::ErrorRecords(101,$e,$request->url(),Auth::user()->id);
            Alert::error('Terjadi Kesalahan !!','Silahakn Hubungi Admin');
            return redirect()->back();
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            $decrypted = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            ErrorReport::ErrorRecords(103,$e,$request->url(),Auth::user()->id);              
            Alert::error('Anda Tidak Mempunya Akses Ke Halaman Ini');            
            return redirect()->back();
        }

        try { 
            $data = MasterBank::destroy($decrypted); 
            Alert::success('Data Berhasil Dihapus')->persistent('Confirm');
            return redirect()->route('BankView'); 
        } catch (QueryException $e) { 
            ErrorReport::ErrorRecords(102,$e,$request->url(),Auth::user()->id); 
            Alert::error('Data Gagal Dihapus','Harap Kontak Administrator/Superadmin');
            return redirect()->back(); 
        }  
    }
}
