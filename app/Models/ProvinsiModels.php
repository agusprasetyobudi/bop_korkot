<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProvinsiModels extends Model
{
    //
    public $timestamp= false;
    protected $table = 'master_provinsi'; 
    protected $fillabel = ['id','provinsi_name'];

    public function kabupaten()
    {
        return $this->belongsTo('App\Models\KabupatenModels');
    }
}
