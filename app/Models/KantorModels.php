<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KantorModels extends Model
{
    public $timestamp= false;
    protected $table = 'master_kantor';
    protected $fillable = ['kode_kantor','id_osp','id_provinsi','id_kabupaten','nama_kantor'];
    
    public function provinsi()
    {
        return $this->belongsTo(ProvinsiModels::class,'id_provinsi');
    }
    public function kabupaten()
    {
        return $this->belongsTo(KabupatenModels::class,'id_kabupaten');
    }
    public function osp()
    {
        return $this->belongsTo(OSPModels::class,'id_osp');
    }
    
}
