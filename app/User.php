<?php

namespace App;

use App\Models\JabatanModel;
use App\Models\KantorModels;
use App\Models\OSPModels;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'password','id_kantor', 'id_jabatan', 'id_group'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function osp()
    {
        return $this->hasOne(OSPModels::class,'id','id_osp');
    }
    public function kantor()
    {
        return $this->hasOne(KantorModels::class, 'id','id_kantor');
    }

    public function jabatan()
    {
        return $this->hasOne(JabatanModel::class, 'id','id_jabatan');
    }

    public function roles()
    {
        return $this->hasOne(Role::class, 'id','id_group');
    }
}
