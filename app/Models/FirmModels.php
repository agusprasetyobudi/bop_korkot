<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FirmModels extends Model
{
    //
    public $timestamp = false;
    protected $table = 'firm';
    protected $fillable = ['no_bukti','tanggal_tf','jabatan','osp','kantor','periode_month','periode_year','id_bank','nama_penerima','bank_account_number','amount_tf','description','created_by','updated_by'];

    public function OSP()
    {
        return $this->belongsTo(OSPModels::class,'osp');
    }
    public function Jabatan()
    {
        return $this->belongsTo(JabatanModel::class,'jabatan');
    }
    public function Kantor()
    {
        return $this->belongsTo(KantorModels::class,'kantor');
    }
    public function Bank()
    {
        return $this->belongsTo(MasterBank::class,'id_bank');
    }
}
