<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomponenBiaya extends Model
{
    protected $table = 'master_komponen';
    public $timestamp = false;
    protected $fillable = ['id','parent_id','komponen_biaya'];
}
