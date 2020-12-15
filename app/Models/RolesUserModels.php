<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolesUserModels extends Model
{
    protected $table = 'role_user';
    protected $fillable = ['role_id','user_id','user_type'];
    public $timestamps = false;
}
