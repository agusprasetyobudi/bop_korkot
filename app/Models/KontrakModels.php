<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontrakModels extends Model
{
    public  $timestamp = false;
    protected $table = 'kontrak';
    protected $fillable = ['parent_id','kode_kontrak','tanggal_kontrak','tanggal_kontrak_mulai','tanggal_kontrak_akhir','id_komponen','id_sub_komponen','id_subkomponen_aktifitas','kabupaten_asal','provinsi_asal','kabupaten_tujuan','kabupaten_asal_value','kabupaten_tujuan_value','provinsi_tujuan','start_periode','end_periode','id_amandemen','nominal','id_kantor','id_osp'];

    public function komponen()
    {
        return $this->belongsTo(KomponenBiaya::class,'id_komponen');
    }
    public function sub_komponen()
    {
        return $this->belongsTo(KomponenBiaya::class,'id_sub_komponen');
    }
    public function aktifitas()
    {
        return $this->hasOneThrough(AktifitasModels::class,SubKomponenActivityModels::class,'id','id','id_subkomponen_aktifitas','id_aktifitas'); 
    }
    public function osp()
    {
        return $this->belongsTo(OSPModels::class,'id_osp');
    }
    public function kantor()
    {
        return $this->belongsTo(KantorModels::class, 'id_kantor');
    }
    public function join_provinsi_asal()
    {
        return $this->belongsTo(ProvinsiModels::class,'provinsi_asal');
    }
    public function join_provinsi_tujuan()
    {
        return $this->belongsTo(ProvinsiModels::class,'provinsi_tujuan');
    }
    public function join_kabupaten_asal()
    {
        return $this->belongsTo(KabupatenModels::class,'kabupaten_asal');
    }
    public function join_kabupaten_tujuan()
    {
        return $this->belongsTo(KabupatenModels::class,'kabupaten_tujuan');
    } 
    public function join_amandemen()
    {
        return $this->belongsTo(AmandemenModels::class,'id_amandemen');

    }
}
