<?php

namespace App\Http\Controllers;

use App\Facades\ErrorReport;
use App\Models\KabupatenModels;
use App\Models\RolesUserModels;
use App\User;
use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
            if(Auth::user()->roles->id == 1){
                $data = User::all();
            }else{
                $data = User::whereIn('id_group',[2,3,4,5,6,7,])->get();
            }
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
                return '<button type="button" class="btn btn-warning" id="change-password" data-name="'.Crypt::encrypt($row->id).'" >Change Password</button> <a href="'.route('PenggunaEditView',['id'=>Crypt::encrypt($row->id)]).'" class="btn  btn-primary">Update Pengguna</a> <button type="button" class="btn btn-danger" id="delete-confirm" data-name="'.Crypt::encrypt($row->id).'" >Delete Data</button>';
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
            $validate = Validator::make($request->all(),[
                'name'       => 'required',
                'username'   => 'required',
                'password'   => 'required',
                'osp'     => 'required',
                'kantor'  => 'required',
                'jabatan' => 'required',
                'pengguna'   => 'required',
            ]);
            if(!$validate->fails()){
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
            }else{
                Alert::error($this->_parseError($validate->errors()->getMessages())); 
                return redirect()->back()->withInput();
            }
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try { 
            $decrypted = Crypt::decrypt($id); 
            $data = User::find($decrypted); 
            $roles = RolesUserModels::join('roles','role_user.role_id','=','roles.id')
            ->join('users','role_user.user_id','=','users.id')
            ->where('role_user.user_id', $decrypted)
            ->select('roles.name as role_name','role_user.role_id as role_id')
            ->first(); 
            return view('main.pengguna.pengguna.edit',['data'=>$data,'roles'=>$roles,'kab_name' => KabupatenModels::find($data->kantor->id_kabupaten)->kabupaten_name]);  
        } catch (Exception $e) {
            dd($e);
            
        }
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
            $validate = Validator::make($request->all(),[
                'name'      => 'required',
                'username'  => 'required', 
                'osp'       => 'required',
                'kantor'    => 'required',
                'jabatan'   => 'required',
                'pengguna'  => 'required',
            ]);
            if(!$validate->fails()){
                 $id = Crypt::decrypt($request->post('something_like_this')); 
                $data = [
                    "name"       => $request->post('name'),
                    "username"   => $request->post('username'),
                    "id_kantor"  => $request->post('kantor'),
                    "id_jabatan" => $request->post('jabatan'),
                    "id_osp"     => $request->post('osp'),
                    "id_group"   => $request->post('pengguna'),
                ];
                User::find($id)->update($data);
                RolesUserModels::where('user_id',$id)->update([
                    'role_id'=>$request->post('pengguna'),
                    'user_id'=> $id,
                    'user_type' => 'App\User'
                ]);
                Alert::success('Pengguna Telah Diupdate');
                return redirect()->route('PenggunaView');

            }else{
                Alert::error($this->_parseError($validate->errors()->getMessages())); 
                return redirect()->back()->withInput();
            }
            
        } catch (Exception $e) {
            ErrorReport::ErrorRecords(101,$e,$request->url(),Auth::user()->id); 
            Alert::error('Data Gagal Diupdate');
            return redirect()->back();
        }
        
    }

    /**
     * Edit Password the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function PasswordReset(Request $request)
    {
        try {
            // dd($request->post()); 
                $validate = Validator::make($request->all(),[
                    'data' => 'required',
                    'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
                    ''=> 'min:6'
                ]);
                if(!$validate->fails()){
                    $id = Crypt::decrypt($request->post('data'));  
                    $password = $request->post('password_confirmation'); 
                    User::find($id)->update(['password'=> Hash::make($password)]);
                    return response()->json([
                        'error'=> false,
                        'message' => 'Password Berhasil Di Ubah',
                        'data' => null
                    ], 200);
                }else{
                    return response()->json([
                        'error' => true,
                        'message' => $this->_parseError($validate->errors()->getMessages())
                    ], 400);
                }

        } catch (\Exception $e) {
            ErrorReport::ErrorRecords(103,$e,$request->url(),Auth::user()->id);
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong, contact to Superadministrator / Administrator'
            ], 400);
        }
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
    private function _parseError($input) {
        $error = null;
        foreach($input as $validationErrors):
            if (is_array($validationErrors)) {
                foreach($validationErrors as $validationError):
                    $error[] = $validationError;
                endforeach;
            } else {
                $error[] = $validationErrors;
            }
        endforeach;

        return $error;
    }
}
