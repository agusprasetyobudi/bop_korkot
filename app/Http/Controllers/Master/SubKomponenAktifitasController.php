<?php

namespace App\Http\Controllers\Master;

use App\Facades\ErrorReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AktifitasModels;
use App\Models\KomponenBiaya;
use App\Models\KontrakModels;
use App\Models\SubKomponenActivityModels;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class SubKomponenAktifitasController extends Controller
{  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id,$sub_id)
    {
        try {
            $decrypted = Crypt::decrypt($id); 
        } catch (DecryptException $e) {
            dd($e);
        }
        if($request->ajax()){ 
            $data = SubKomponenActivityModels::where('id_subkomponen',$decrypted)->latest()->get();
            // if(count($data)) $data['sub_id'] = $sub_id; 
            // dd($data);
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama_aktifitas',function($row){
                return $row->activity->nama_aktifitas;
            })
            ->addColumn('action',function($row){ 
                $btn = '';
                $btn .= '<button type="button" class="btn btn-danger" id="delete-confirm" data-name="'.Crypt::encrypt(['id'=>$row->id,'parent_id'=>$row->subkomponen->parent_id,'id_subkomponen'=>$row->subkomponen->id]).'" >Delete Data</button>';
                return $btn;
            })
            ->rawColumns(['action','nama_aktifitas'])
            ->make(true);
        }
        return view('main.data_master.aktifitas.sub_komponen.index',['id'=>$sub_id,'parent_id'=>$id]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$id,$sub_id)
    {
        // dd(['id'=>Crypt::decrypt($sub_id),'parent_id'=>Crypt::decrypt($id)]);
        $data = AktifitasModels::all();
        // dd($data);
        return view('main.data_master.aktifitas.sub_komponen.create',['id'=>$id,'parent_id'=>$sub_id,'data'=>$data]);
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
        // dd(['id'=>Crypt::decrypt($request->post('urldata')),'parent_id'=>Crypt::decrypt($request->post('sub_urldata'))]);
       try {
           $decrypted = Crypt::decrypt($request->post('urldata'));
           $data = [];
           foreach ($request->post('nama_aktifitas') as $key => $value) {
               $data[$key]['id_subkomponen'] = $decrypted;
               $data[$key]['id_aktifitas'] = $value;
           }
       } catch (DecryptException $e) {
            ErrorReport::ErrorRecords(103,$e,$request->url(),Auth::user()->id);
            Alert::error('Anda Tidak Mempunya Akses Ke Halaman Ini');            
            return redirect()->route('home');
       }
       try {
        SubKomponenActivityModels::insert($data);
        Alert::success('Data Aktifitas Telah Ditambahkan');
        return redirect()->route('AktifitasSubKomponen',['id'=>$request->post('urldata'),'sub_id'=>$request->post('sub_urldata')]);
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
    public function get(Request $request)
    {
        $results = []; 
        if($request->post('q')){
            // Declare Aktifitas get ID
            $varAct = AktifitasModels::where('nama_aktifitas','like','%'.$request->post('q').'%')->get();     
            $var = [];
            foreach ($varAct as $key => $value) {  
                $var[$key] = $value->id;
            } 
            // Declare sub komponen activity by id aktifitas
            $data=[];
            foreach ($var as $key => $value) {   
                $data[$key] = SubKomponenActivityModels::where('id_subkomponen',$request->post('id'))
                        ->where('id_aktifitas','like','%'.$value.'%')->get(); 
            }  
            // Double Foreach Processing
            $loops = [];  
            foreach ($data as $key => $value) {   
                $loops[$key] = $value[0];   
            } 
            foreach ($loops as $key => $values) {  
                $results[$key]['id'] = $values->id;
                $results[$key]['nama_aktifitas'] = $values->activity->nama_aktifitas;
            } 
        }else if($request->post('kantor') && $request->post('sub_komponen') && $request->post('aktifitas')){
            $periode_date = $request->post('periode_date');
            // dd($periode_date);
            DB::enableQueryLog();
            $data = KontrakModels::join('master_aktifitas_subkomponen','kontrak.id_subkomponen_aktifitas','=','master_aktifitas_subkomponen.id')
            ->join('master_aktifitas','master_aktifitas_subkomponen.id_aktifitas','=','master_aktifitas.id')
            ->where(DB::raw('year(kontrak.start_periode)'), '<=', DB::raw("year('$periode_date')"))
            ->where(DB::raw('month(kontrak.start_periode)'), '<=', DB::raw("month('$periode_date')"))
            ->where(DB::raw('year(kontrak.end_periode)'), '>=', DB::raw("year('$periode_date')"))
            ->where(DB::raw('month(kontrak.end_periode)'), '>=', DB::raw("month('$periode_date')"))
            ->where('kontrak.id_kantor', $request->post('kantor'))
            ->where('master_aktifitas.id', $request->post('aktifitas'))
            ->where('master_aktifitas_subkomponen.id_subkomponen', $request->post('sub_komponen'))
            ->select(['kontrak.id as id_selected','kontrak.parent_id','master_aktifitas.nama_aktifitas','kontrak.nominal as nominal','kontrak.kabupaten_asal_value as kabupaten_asal','kontrak.kabupaten_tujuan_value as kabupaten_tujuan'])
            ->get();

            // dd(DB::getQueryLog());
            // dd($data);
            // return $data;
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                return '<button type="button" class="btn btn-danger" id="delete-confirm" data-name="'.Crypt::encrypt($row->id_selected).'" >Pilih</button>';
            })
            ->addColumn('kode_kontrak',function($row){
                return KontrakModels::find($row->parent_id)->kode_kontrak;
            })
            ->addColumn('aktifitas',function($row){
                return $row->nama_aktifitas;
            })
            ->addColumn('nominal',function($row){
                return  "Rp " . number_format($row->nominal,0,',','.');;
            })
            ->addColumn('asal',function($row){
                return $row->kabupaten_asal;
            })
            ->addColumn('tujuan',function($row){
                return $row->kabupaten_tujuan;
            })
            ->rawColumns(['action','kode_kontrak','aktifitas','nominal','asal','tujuan'])
            ->make(true);

        }else if($request->post('kontrak')){
            try {
                $decrypted = Crypt::decrypt($request->post('kontrak'));
                // dd($request->post('id'));
            } catch ( DecryptException $e) {
                ErrorReport::ErrorRecords(103,$e,$request->url(),Auth::user()->id);  
                Alert::error('Anda Tidak Mempunya Akses Ke Halaman Ini');    
                return redirect()->route('home');
            }
            // // $data = KontrakModels::join('master_aktifitas_subkomponen','kontrak.id_subkomponen_aktifitas','=','master_aktifitas_subkomponen.id')
            // // ->join('master_aktifitas','master_aktifitas_subkomponen.id_aktifitas','=','master_aktifitas.id')
            // // ->where(DB::raw('year(kontrak.start_periode)'), '<=', DB::raw("year('$periode_date')"))
            // // ->where(DB::raw('month(kontrak.start_periode)'), '<=', DB::raw("month('$periode_date')"))
            // // ->where(DB::raw('year(kontrak.end_periode)'), '>=', DB::raw("year('$periode_date')"))
            // // ->where(DB::raw('month(kontrak.end_periode)'), '>=', DB::raw("month('$periode_date')"))
            // // ->where('kontrak.id', $request->post('kantor'))
            // // ->where('master_aktifitas.id', $request->post('aktifitas'))
            // // ->where('master_aktifitas_subkomponen.id_subkomponen', $request->post('sub_komponen'))
            // // ->select(['kontrak.parent_id as id_selected','master_aktifitas.nama_aktifitas','kontrak.nominal as nominal','kontrak.kabupaten_asal_value as kabupaten_asal','kontrak.kabupaten_tujuan_value as kabupaten_tujuan'])
            // // ->get();

            // // dd($decrypted);
            // $data = SubKomponenActivityModels::join('master_komponen', 'master_aktifitas_subkomponen.id_subkomponen','=','master_komponen.id')
            // ->join('master_aktifitas', 'master_aktifitas_subkomponen.id_aktifitas','=','master_aktifitas.id')
            // ->join('kontrak','')
            // ->where('master_aktifitas_subkomponen.id',$decrypted)
            // ->where('master_komponen.is_parent','>=',0)
            // ->select(['master_komponen.parent_id','master_komponen.komponen_biaya',''])
            // ->get();
            DB::enableQueryLog();
            $data = KontrakModels::join('master_aktifitas_subkomponen','kontrak.id_subkomponen_aktifitas','=','master_aktifitas_subkomponen.id')
            ->join('master_aktifitas','master_aktifitas_subkomponen.id_aktifitas','=','master_aktifitas.id')
            ->join('master_komponen','kontrak.id_sub_komponen','=','master_komponen.id')
            ->where('kontrak.id',$decrypted)
            ->select(['kontrak.id','master_komponen.parent_id','master_komponen.komponen_biaya','master_aktifitas.nama_aktifitas','kontrak.nominal'])
            ->get();
            $results = [
                'id_kontrak' => $data[0]->id,
                'nama_komponen' => KomponenBiaya::find($data[0]->parent_id)->komponen_biaya,
                'sub_komponen' => $data[0]->komponen_biaya,
                'aktifitas' => $data[0]->nama_aktifitas,
                'nominalParse' =>  "Rp " . number_format($data[0]->nominal,0,',','.'),
                'nominal' => $data[0]->nominal
            ];
            // dd(DB::getQueryLog());

        }else{ 
            $data = SubKomponenActivityModels::where('id_subkomponen',$request->post('id'))->get();
            foreach ($data as $key => $values) {  
                $results[$key]['id'] = $values->id_aktifitas;
                $results[$key]['nama_aktifitas'] = $values->activity->nama_aktifitas;
            }
            // $results = ['ok 3'];
            // dd($results);
        }  
        return response()->json($results);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        //               
        Alert::success('Data Aktifitas Telah Ditambahkan');

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
        //
        dd($request);                
        Alert::success('Data Aktifitas Telah Ditambahkan');

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
            $ids = Crypt::decrypt($id);              

        } catch (DecryptException $e) {
            ErrorReport::ErrorRecords(103,$e,$request->url(),Auth::user()->id);
            Alert::error('Anda Tidak Mempunya Akses Ke Halaman Ini');            
            return redirect()->route('home');
            
        }
        try {
            SubKomponenActivityModels::destroy($ids['id']);
            Alert::success('Data Berhasil Dihapus');
            return redirect()->route('AktifitasSubKomponen',['id'=>Crypt::encrypt($ids['id_subkomponen']),'sub_id'=>Crypt::encrypt($ids['parent_id'])]);
        } catch (QueryException $e) {
            ErrorReport::ErrorRecords(102,$e,$request->url(),Auth::user()->id);
            Alert::error('Terjadi Kesalahan','Harap Hubungi Administrator/Superadministrator');            
            return redirect()->back();
        } 

    } 
}
