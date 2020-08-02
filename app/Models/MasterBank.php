<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterBank extends Model
{
    public $timestamp = false;
    protected $table = 'master_bank';
    protected $fillable = ['nama_bank'];
}
