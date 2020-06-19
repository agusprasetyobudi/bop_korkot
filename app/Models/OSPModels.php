<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OSPModels extends Model
{ 
    protected $table = 'master_osp';
    protected $fillabel = ['id','osp_name']; 
}
