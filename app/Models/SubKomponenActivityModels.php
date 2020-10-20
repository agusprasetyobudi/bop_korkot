<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubKomponenActivityModels extends Model
{
    public $timestamp = false;
    protected $table = 'master_aktifitas_subkomponen';
    // protected $fillable = ['id_aktifitas','id_subkomponen'];

     public function activity()
     {
         return $this->belongsTo(AktifitasModels::class,'id_aktifitas');
     }
     public function subkomponen()
     {
         return $this->belongsTo(KomponenBiaya::class,'id_subkomponen');
     } 
    public function GetKantor()
    {
        return $this->hasOneThrough(KantorModels::class,AktifitasModels::class,'id','id');
    }
}
