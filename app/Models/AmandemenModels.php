<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AmandemenModels extends Model
{
    //
    public $timestamp = false;
    protected $table = 'master_amandemen';
    protected $fillable = ['nama_amandemen'];
}
