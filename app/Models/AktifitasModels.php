<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AktifitasModels extends Model
{ 
    public $timestamp= false; 
    protected $table = 'master_aktifitas';
    protected $fillable = ['nama_aktifitas']; 
}
