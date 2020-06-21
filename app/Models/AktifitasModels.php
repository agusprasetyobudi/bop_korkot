<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AktifitasModels extends Model
{
    //
    protected $table = 'master_aktifitas';
    public $timestamp= false; 
    protected $fillable = ['nama_aktifitas'];

    // public function subactivity()
    // {
    //     return $this->hasMany(SubKomponenActivityModels::class,'id');
    // }
}
