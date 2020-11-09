<?php

namespace App\Http\Controllers\Master;

use App\Facades\ErrorReport;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\KantorModels;
use App\Models\OSPModels;
use App\Models\ProvinsiModels;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Illuminate\Support\Facades\Artisan;

class KantorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = KantorModels::get();
            // $data = Cache::remember('kantor', env('CACHE_LIFETIME'), function () {
            //     return KantorModels::get();
            // });
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('osp',function($row){ 
                return $row->osp->osp_name;
            })
            ->addColumn('provinsi',function($row){
                return $row->provinsi->provinsi_name;
            })
            ->addColumn('kabupaten',function($row){
                return $row->kabupaten->kabupaten_name;
            })
            ->addColumn('action',function($row){
                $btn = '';
                $btn .= '<a href="'.route('KantorEditView',['id'=>Crypt::encrypt($row->id)]).'" class="btn btn-warning">Update Data</a>  '; 
                $btn .= '<button type="button" class="btn btn-danger" id="delete-confirm" data-name="'.Crypt::encrypt($row->id).'" >Delete Data</button>';
                return $btn;
            })
            ->rawColumns(['osp','provinsi','kabupaten','action'])
            ->make(true);
        } 
        return view('main.data_master.kantor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $osp = OSPModels::all();
        $provinsi = ProvinsiModels::all();
        return view('main.data_master.kantor.create',['osp'=> $osp,'provinsi'=>$provinsi]);
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
        dd($request->all());
        $data = [];
        try {
            foreach ($request->post('kode_kantor') as $key => $value) {
                
                $data[$key]= ['kode_kantor'=>$value];

            }
            foreach ($request->post('osp_id') as $key => $value) {
                
                $data[$key]['id_osp']=$value;

            } 
            foreach ($request->post('provinsi_id') as $key => $value) {
                
                $data[$key]['id_provinsi'] = $value;

            }
            foreach ($request->post('kabupaten_id') as $key => $value) {
                
                $data[$key]['id_kabupaten'] = $value;

            }
            foreach ($request->post('nama_kantor') as $key => $value) {
                
                $data[$key]['nama_kantor'] = $value;

            }
            foreach ($request->post('kabupaten_name') as $key => $value) {
                
                $data[$key]['nama_kabupaten'] = $value;

            }
            // dd($data);
            KantorModels::insert($data);
            Alert::success('Data Telah Ditambahkan');
            return redirect()->route('KantorView');
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
    public function get(Request $request)
    { 
        DB::enableQueryLog();
        $data = $request->post('q'); 
        preg_match('/\d+/', $data, $string); 
       try {
            if($string){
                $res = KantorModels::where('id_osp',$request->post('id'))->where('kode_kantor','like','%'.$data.'%')->orWhere('nama_kabupaten','like','%'.$data.'%')->get();
            }else{
                $res = KantorModels::where('id_osp',$request->post('id'))->where('nama_kabupaten','like','%'.$data.'%')->get();
            } 
            // dd($res);
            // dd(DB::getQueryLog());
            foreach ($res as $key => $value) {
                $results[$key]['id'] = $value->id;
                $results[$key]['kode_kantor'] = $value->kode_kantor;
                $results[$key]['nama_kantor'] = $value->nama_kantor.' / '.$value->kabupaten->kabupaten_name; 
            }
            return response()->json($results);
       } catch (QueryException $e) {
           dd($e);
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
        try {
            $decrypted = Crypt::decrypt($id);
            $data = KantorModels::find($decrypted);
            $osp = OSPModels::all();
            $provinsi = ProvinsiModels::all();
            // $kabupaten = KabupatenModels::find($data->id_kabupaten)
            return view('main.data_master.kantor.update',['data'=>$data,'osp'=> $osp,'provinsi'=>$provinsi]);

        } catch (DecryptException $e) {
            
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
            $decrypted = Crypt::decrypt($request->post('urldata'));    
        } catch (DecryptException $e) {
            ErrorReport::ErrorRecords(103,$e,$request->url(),Auth::user()->id);
            Alert::error('Anda Tidak Mempunya Akses Ke Halaman Ini');    
            return redirect()->route('home'); 
        }
        try {
            $push = [
                'kode_kantor' => $request->post('kode_kantor'),
                'id_osp' => $request->post('osp'),
                'id_provinsi' => $request->post('provinsi'),
                'id_kabupaten' => $request->post('kabupaten'),
                'nama_kantor' => $request->post('nama_kantor')
            ];
            KantorModels::where('id',$decrypted)
            ->update($push);
            Artisan::call('cache:clear');
            Alert::success('Data Telah Diupdate');
            return redirect()->route('KantorView');
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
        // dd($id);
        try {
            $decrypted = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            ErrorReport::ErrorRecords(103,$e,$request->url(),Auth::user()->id);              
            Alert::error('Anda Tidak Mempunya Akses Ke Halaman Ini');            
            return redirect()->back();
        }

        try { 
            KantorModels::destroy($decrypted); 
            Alert::success('Data Berhasil Dihapus')->persistent('Confirm');
            return redirect()->route('KantorView'); 
        } catch (QueryException $e) { 
            ErrorReport::ErrorRecords(102,$e,$request->url(),Auth::user()->id); 
            Alert::error('Data Gagal Dihapus','Harap Kontak Administrator/Superadmin');
            return redirect()->back(); 
        } 
    } 
}
