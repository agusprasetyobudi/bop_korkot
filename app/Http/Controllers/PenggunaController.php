<?php

namespace App\Http\Controllers;

use App\Facades\ErrorReport;
use App\Models\RolesUserModels;
use App\User;
use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class PenggunaController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = User::all();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('osp',function($row){
                return $row->osp->osp_name;
            })
            ->addColumn('kantor',function($row){
                return $row->kantor->kode_kantor.' - '.$row->kantor->nama_kantor.' '.$row->kantor->nama_kabupaten;
            })
            ->addColumn('jabatan',function($row){
                return $row->jabatan->nama_jabatan;
            })
            ->addColumn('groups', function($row){
                return $row->roles->name;
            })
            ->addColumn('opsi',function($row){
                return '<button type="button" class="btn btn-warning" id="change-password" data-name="'.Crypt::encrypt($row->id).'" >Change Password</button> <button type="button" class="btn btn-danger" id="delete-confirm" data-name="'.Crypt::encrypt($row->id).'" >Delete Data</button>';
            })
            ->rawColumns(['osp','kantor','jabatan','groups','opsi'])
            ->make(true);
        }
        return view('main.pengguna.pengguna.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('main.pengguna.pengguna.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->post());
        try {
            $useriD = User::create([
                'name'=> $request->post('name'),
                'username' => $request->post('username'),
                'password' => Hash::make($request->post('password')),
                'id_osp' => $request->post('osp'),
                'id_kantor'=> $request->post('kantor'),
                'id_jabatan'=> $request->post('jabatan'),
                'id_group'=> $request->post('pengguna'),
                ]);
            RolesUserModels::create([
                'role_id'=>$request->post('pengguna'),
                'user_id'=> $useriD->id,
                'user_type' => 'App\User'
            ]);
            Alert::success('Pengguna Telah Ditambahkan');
            return redirect()->route('PenggunaView');
        } catch (Exception $e) {
            ErrorReport::ErrorRecords(100,$e,$request->url(),Auth::user()->id); 
            Alert::error('Pengguna Gagal Ditambahkan'); 
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
    public function destroy(Request $request,$id)
    {
        try {
            $decrypted = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            ErrorReport::ErrorRecords(103,$e,$request->url(),Auth::user()->id);              
            Alert::error('Anda Tidak Mempunya Akses Ke Halaman Ini');            
            return redirect()->back();
        }

        try { 
           User::where('id', $decrypted)->delete(); 
           RolesUserModels::where('user_id',$decrypted)->delete();
            Alert::success('Pengguna Berhasil Dihapus')->persistent('Confirm');
            return redirect()->route('PenggunaView'); 
        } catch (Exception $e) { 
            ErrorReport::ErrorRecords(102,$e,$request->url(),Auth::user()->id); 
            Alert::error('Pengguna Gagal Dihapus','Harap Kontak Administrator/Superadmin');
            return redirect()->back(); 
        }  
    }
}
