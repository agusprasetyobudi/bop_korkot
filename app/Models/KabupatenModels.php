<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KabupatenModels extends Model
{
    protected $timestamp = false;
    protected $table ='master_kabupaten';
    protected $fillable = ['provinsi_id','provinsi_name'];

    public function provinsi()
    {
        # code... 
        return $this->belongsTo(ProvinsiModels::class);
    }
}
