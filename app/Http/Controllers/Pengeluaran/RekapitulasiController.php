<?php

namespace App\Http\Controllers\Pengeluaran;

use App\Http\Controllers\Controller;
use App\Models\FirmModels;
use App\Models\JabatanModel;
use App\Models\KantorModels;
use App\Models\KomponenBiaya;
use App\Models\KontrakModels;
use App\Models\MasterBank;
use App\Models\OSPModels;
use App\Models\PengeluaranModels;
use App\Models\TransferModels;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
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
        DB::enableQueryLog();
        if ($request->ajax()) {
            if (Auth::user()->roles->id == 1 || Auth::user()->roles->id == 2) {
                $data = TransferModels::where('transfer.parent_id', '=', 0)
                    ->whereIn('transfer.id', function ($query) {
                        $query->select('id_parent_transfer')->from('pengeluaran');
                    })
                    ->get();
            } else {
                $data = TransferModels::join('users', 'transfer.created_by', '=', 'users.id')
                    ->where('transfer.parent_id', '=', 0)
                    ->where('users.id_kantor', Auth::user()->id_kantor)
                    ->whereIn('transfer.id', function ($query) {
                        $query->select('id_parent_transfer')->from('pengeluaran');
                    })
                    ->select(['transfer.id as id', 'transfer.firm_id', 'transfer.amount as amount', 'transfer.amount_item as amount_item', 'transfer.tanggal_terima as tanggal_terima', 'transfer.created_by as created_by', 'transfer.has_inserted as has_inserted'])
                    ->get();
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('bukti_transfer', function ($row) {
                    return $row->firm->no_bukti;
                })
                ->addColumn('tanggal_transfer', function ($row) {
                    return $row->firm->tanggal_tf;
                })
                ->addColumn('nama_penerima', function ($row) {
                    return $row->firm->nama_penerima;
                })
                ->addColumn('bank_penerima', function ($row) {
                    return $row->firm->Bank->nama_bank;
                })
                ->addColumn('no_rekening', function ($row) {
                    return $row->firm->bank_account_number;
                })
                ->addColumn('nilai_kontrak', function ($row) {
                    $transfer = TransferModels::where('parent_id', $row->id)
                        ->select(['item_kontrak_id'])
                        ->get();
                    $data = KontrakModels::join('transfer', 'kontrak.id', '=', 'transfer.item_kontrak_id')
                        ->where('transfer.parent_id', $row->id)
                        ->get(); 
                    return number_format($data->sum('nominal'), 0, ',', '.');
                })
                ->addColumn('jumlah_terima', function ($row) {
                    return number_format($row->amount, 0, ',', '.');
                })
                ->addColumn('selisih', function ($row) {
                    $data = TransferModels::where('parent_id', $row->id)
                        ->get();
                    return number_format($data->sum('amount_item') - $row->amount, 0, ',', '.');
                })
                ->addColumn('tanggal_terima', function ($row) { 
                    return Carbon::parse($row->tanggal_terima)->format('d-m-Y');
                    return $row->tanggal_terima;
                })
                ->addColumn('periode', function ($row) { 
                    $firm = FirmModels::find($row->firm_id);
                    return Carbon::parse((int)$firm->periode_month)->format('F') . '/' . (int)$firm->periode_year;
                })
                ->addColumn('implementasi', function ($row) { 
                    $data = KontrakModels::join('pengeluaran', 'kontrak.id', '=', 'pengeluaran.id_item_transfer')
                        ->where('pengeluaran.id_parent_transfer', $row->id)
                        ->select(['pengeluaran.jumlah'])
                        ->get();
                    return number_format($data->sum('jumlah'), 0, ',', '.');
                })
                ->addColumn('selisihb', function ($row) {
                    $data = KontrakModels::join('transfer', 'kontrak.id', '=', 'transfer.item_kontrak_id')
                        ->join('pengeluaran', 'transfer.id', '=', 'pengeluaran.id_item_transfer', 'left')
                        ->where('transfer.parent_id', $row->id)
                        ->get();
                    return number_format($data->sum('jumlah') - $data->sum('amount_item'), 0, ',', '.'); 
                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    $btn .= '<a href="' . route('buktiPengeluaranEdit', ['id' => Crypt::encrypt((object)['firm' => $row->firm_id, 'id' => $row->id])]) . '" class="btn btn-warning">Edit</a>  '; 
                    return $btn;
                })
                ->rawColumns(['bukti_transfer', 'tanggal_transfer', 'nama_penerima', 'bank_penerima', 'no_rekening', 'nilai_kontrak', 'jumlah_terima', 'selisih', 'tanggal_terima', 'periode', 'implementasi', 'selisih', 'selisihb', 'action',])
                ->make(true);
        }
        return view('main.bukti_pengeluaran.rekapitulasi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        try {
            $decrypted = Crypt::decrypt($id);
            $TransferModel = TransferModels::find($decrypted->id);
            $firm = FirmModels::find($decrypted->firm);
            $kantor = KantorModels::find($firm->kantor);
            $data = (object)[
                'id' => $decrypted->id,
                'no_bukti' => $firm->no_bukti,
                'tanggal_transfer' => $firm->tanggal_tf,
                'jabatan' => JabatanModel::find($firm->jabatan)->nama_jabatan,
                'osp' => OSPModels::find($firm->osp)->osp_name,
                'kantor' => $kantor->nama_kantor . ' - ' . $kantor->nama_kabupaten,
                'periode' => Carbon::parse((int)$firm->periode_month)->format('F') . ' / ' . (int)$firm->periode_year,
                'bank' => MasterBank::find($firm->id_bank)->nama_bank,
                'nama_penerima' => $firm->nama_penerima,
                'no_rekening' => $firm->bank_account_number,
                'tanggal_terima' => $TransferModel->tanggal_terima,
                'jumlah_terima' => $TransferModel->amount
            ];
            $kontrak = (object)[
                'id' => $decrypted->id,
            ];
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
        }
        return view('main.bukti_pengeluaran.rekapitulasi.create', ['data' => $data, 'kontrak' => $kontrak]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $stored = [];
        foreach ($request->post('data_set') as $key => $value) {
            try {
                $id_items = Crypt::decrypt($value);
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            }
            $stored[$key]['id_item_transfer'] = $id_items;
            $stored[$key]['id_parent_transfer'] = $request->post('something_like_this');
        }
        foreach ($request->post('data_value') as $key => $value) {
            $stored[$key]['jumlah'] = preg_replace('/\D/', '', $value);
            $stored[$key]['created_by'] = Auth::user()->id;
        }
        try {
            PengeluaranModels::insert($stored);
            TransferModels::find($request->post('something_like_this'))->update(['has_inserted' => 1]);
            DB::commit();
            Alert::success('Data Telah Ditambahkan');
            return redirect()->route('buktiPengeluaranView');
        } catch (Exception $th) {
            DB::rollback();
            dd($th);
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
    public function edit(Request $request, $id)
    {
        try {
            $decrypted = Crypt::decrypt($id);
            $TransferModel = TransferModels::find($decrypted->id);
            $firm = FirmModels::find($decrypted->firm);
            $kantor = KantorModels::find($firm->kantor);
            $data = (object)[
                'id' => $decrypted->id,
                'no_bukti' => $firm->no_bukti,
                'tanggal_transfer' => $firm->tanggal_tf,
                'jabatan' => JabatanModel::find($firm->jabatan)->nama_jabatan,
                'osp' => OSPModels::find($firm->osp)->osp_name,
                'kantor' => $kantor->nama_kantor . ' - ' . $kantor->nama_kabupaten,
                'periode' => Carbon::parse((int)$firm->periode_month)->format('F') . ' / ' . (int)$firm->periode_year,
                'bank' => MasterBank::find($firm->id_bank)->nama_bank,
                'nama_penerima' => $firm->nama_penerima,
                'no_rekening' => $firm->bank_account_number,
                'tanggal_terima' => $TransferModel->tanggal_terima,
                'jumlah_terima' => $TransferModel->amount
            ];
            $total_pengeluaran = TransferModels::join('pengeluaran', 'transfer.id', '=', 'pengeluaran.id_parent_transfer')
                ->where('transfer.id', $decrypted->id)
                ->get();
            $kontrak = (object)[
                'id' => $decrypted->id,
                'total_kontrak' => number_format($total_pengeluaran->sum('jumlah'), 0, ',', ',')
            ];
            if ($request->ajax()) { 
                $data = TransferModels::join('pengeluaran', 'transfer.id', '=', 'pengeluaran.id_item_transfer')
                    ->where('parent_id', $request->post('id'))
                    ->whereIn('transfer.id', function ($query) {
                        $query->select('id_item_transfer')->from('pengeluaran');
                    })
                    ->select(['pengeluaran.id as id_pengeluaran', 'transfer.item_kontrak_id', 'transfer.amount_item', 'pengeluaran.jumlah'])
                    ->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('komponen', function ($row) {
                        $kontrak = KontrakModels::find($row->item_kontrak_id);
                        $komponen = KomponenBiaya::find($kontrak->id_komponen);
                        $btn = '';
                        $btn .= '<input type="hidden" name="data_set[]" value="' . Crypt::encrypt($row->id_pengeluaran) . '">';
                        $btn .= $komponen->komponen_biaya;
                        return $btn;
                    })
                    ->addColumn('sub_komponen', function ($row) {
                        $data = KontrakModels::join('master_aktifitas_subkomponen', 'kontrak.id_subkomponen_aktifitas', '=', 'master_aktifitas_subkomponen.id')
                            ->join('master_aktifitas', 'master_aktifitas_subkomponen.id_aktifitas', '=', 'master_aktifitas.id')
                            ->join('master_komponen', 'kontrak.id_sub_komponen', '=', 'master_komponen.id')
                            ->where('kontrak.id', $row->item_kontrak_id)
                            ->select(['master_komponen.komponen_biaya as sub_komponen', 'master_aktifitas.nama_aktifitas as nama_aktifitas'])
                            ->get();
                        return $data[0]->sub_komponen . ' / ' . $data[0]->nama_aktifitas;
                    })
                    ->addColumn('nilai_kontrak', function ($row) {
                        $kontrak = KontrakModels::find($row->item_kontrak_id);
                        return "Rp " . number_format($kontrak->nominal, 0, ',', '.');
                    })
                    ->addColumn('alokasi', function ($row) {
                        $kontrak = KontrakModels::find($row->item_kontrak_id);
                        return "Rp " . number_format($kontrak->nominal, 0, ',', '.');
                    })
                    ->addColumn('total_alokasi', function ($row) {
                        return "Rp " . number_format($row->sum('amount_item'), 0, ',', '.');
                    })
                    ->addColumn('implementasi', function ($row) {
                        // return $row;
                        return '<div class="form-group"><input type="text" name="data_value[]" class="form-control nominal-kontrak" value="' . number_format($row->jumlah, 0, ',', ',') . '"></div>';
                    })
                    ->rawColumns(['total_alokasi', 'komponen', 'sub_komponen', 'nilai_kontrak', 'alokasi', 'implementasi'])
                    ->make(true);
            }
            return view('main.bukti_pengeluaran.rekapitulasi.update', ['data' => $data, 'kontrak' => $kontrak]);
            // dd($data);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
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
        DB::beginTransaction();
        $stored = [];
        foreach ($request->post('data_set') as $key => $value) {
            try {
                $id_items = Crypt::decrypt($value);
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            }
            $stored[$key]['id'] = $id_items;
        }
        foreach ($request->post('data_value') as $key => $value) {
            $stored[$key]['jumlah'] = preg_replace('/\D/', '', $value);
            $stored[$key]['created_by'] = Auth::user()->id;
        }
        try {
            foreach ($stored as $key => $value) {
                DB::enableQueryLog();
                PengeluaranModels::where('id', $value['id'])->update(['jumlah' => $value['jumlah']]);
            }
            DB::commit();
            Alert::success('Data Telah Diupdate');
            return redirect()->route('buktiPengeluaranView');
        } catch (Exception $th) {
            DB::rollback();
            dd($th);
        }
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

    public function api_get(Request $request)
    {
        # code...
    }

    public function api_bukti_transfer_get(Request $request)
    { 
        if ($request->has('id')) {
            $data = TransferModels::where('parent_id', $request->post('id'))
                ->whereNotIn('id', function ($query) {
                    $query->select('id_item_transfer')->from('pengeluaran');
                }) 
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('komponen', function ($row) {
                    $kontrak = KontrakModels::find($row->item_kontrak_id);
                    $komponen = KomponenBiaya::find($kontrak->id_komponen);
                    $btn = '';
                    $btn .= '<input type="hidden" name="data_set[]" value="' . Crypt::encrypt($row->id) . '">';
                    $btn .= $komponen->komponen_biaya;
                    return $btn;
                })
                ->addColumn('sub_komponen', function ($row) {
                    $data = KontrakModels::join('master_aktifitas_subkomponen', 'kontrak.id_subkomponen_aktifitas', '=', 'master_aktifitas_subkomponen.id')
                        ->join('master_aktifitas', 'master_aktifitas_subkomponen.id_aktifitas', '=', 'master_aktifitas.id')
                        ->join('master_komponen', 'kontrak.id_sub_komponen', '=', 'master_komponen.id')
                        ->where('kontrak.id', $row->item_kontrak_id)
                        ->select(['master_komponen.komponen_biaya as sub_komponen', 'master_aktifitas.nama_aktifitas as nama_aktifitas'])
                        ->get();
                    return $data[0]->sub_komponen . ' / ' . $data[0]->nama_aktifitas;
                })
                ->addColumn('nilai_kontrak', function ($row) {
                    $kontrak = KontrakModels::find($row->item_kontrak_id);
                    return "Rp " . number_format($kontrak->nominal, 0, ',', '.');
                })
                ->addColumn('alokasi', function ($row) {
                    $kontrak = KontrakModels::find($row->item_kontrak_id);
                    return "Rp " . number_format($kontrak->nominal, 0, ',', '.');
                })
                ->addColumn('total_alokasi', function ($row) {
                    return "Rp " . number_format($row->sum('amount_item'), 0, ',', '.');
                })
                ->addColumn('implementasi', function ($row) {
                    return '<div class="form-group"><input type="text" name="data_value[]" class="form-control nominal-kontrak" value="0"></div>';
                })
                ->rawColumns(['total_alokasi', 'komponen', 'sub_komponen', 'nilai_kontrak', 'alokasi', 'implementasi'])
                ->make(true);
        } else {  
            $data = TransferModels:: join('users', 'transfer.created_by', '=', 'users.id')
            ->where('users.id_kantor', Auth::user()->id_kantor) 
            ->where('parent_id', '=', 0)
            ->whereNotIn('transfer.id', function ($query) {
                $query->select('id_parent_transfer')->from('pengeluaran');
            })
            ->select(['transfer.id as id', 
            'transfer.firm_id as firm_id', 
            'transfer.item_kontrak_id as item_kontrak_id', 
            'transfer.amount as amount', 
            'transfer.amount_item as amount_item', 
            'transfer.tanggal_terima as tanggal_terima', 
            ])
            ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('no_bukti', function ($row) {
                    $firm = FirmModels::find($row->firm_id);
                    return $firm->no_bukti;
                })
                ->addColumn('tanggal_transfer', function ($row) {
                    $firm = FirmModels::find($row->firm_id);
                    return $firm->tanggal_tf;
                })
                ->addColumn('nama_penerima', function ($row) {
                    $firm = FirmModels::find($row->firm_id);
                    return $firm->nama_penerima;
                })
                ->addColumn('bank_penerima', function ($row) {
                    $firm = FirmModels::find($row->firm_id);
                    return $firm->Bank->nama_bank;
                })
                ->addColumn('no_rekening', function ($row) {
                    $firm = FirmModels::find($row->firm_id);
                    return $firm->bank_account_number;
                })
                ->addColumn('nilai_kontrak', function ($row) {
                    $data = TransferModels::where('parent_id', $row->id)
                        ->select('item_kontrak_id')
                        ->get();
                    foreach ($data as $key => $value) {
                        return  "Rp " . number_format(KontrakModels::where('id', $value->item_kontrak_id)->get()->sum('nominal'), 0, ',', '.');
                    }
                })
                ->addColumn('jumlah_terima', function ($row) {
                    return number_format($row->amount, 0, ',', '.');
                })
                ->addColumn('selisih', function ($row) {
                    $data = TransferModels::where('parent_id', $row->id)
                        ->get();
                    return number_format($data->sum('amount_item') - $row->amount, 0, ',', '.');
                })
                ->addColumn('tanggal_terima', function ($row) {
                    return $row->tanggal_terima;
                })
                ->addColumn('periode', function ($row) {
                    $firm = FirmModels::find($row->firm_id);
                    return Carbon::parse((int)$firm->periode_month)->format('F') . '/' . (int)$firm->periode_year;
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('buktiPengeluaranCreate', ['id' => Crypt::encrypt((object)['firm' => $row->firm_id, 'id' => $row->id])]) . '" class="btn btn-primary">Pilih</a>  ';
                })
                ->rawColumns(['no_bukti', 'tanggal_transfer', 'nama_penerima', 'bank_penerima', 'no_rekening', 'nilai_kontrak', 'jumlah_terima', 'selisih', 'tanggal_terima', 'periode', 'action',])
                ->make(true);
        } 
    }
}
