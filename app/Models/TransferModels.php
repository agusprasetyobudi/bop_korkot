<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferModels extends Model
{
    public $timestamp = false;
    protected $table = 'transfer';
    protected $fillable = [
        'firm_id',
        'amount',
        'tanggal_terima',
        'parent_id',
        'item_kontrak_id',
        'amount_item',
        'created_by'
    ];

    public function contracts()
    {
        return $this->hasMany(KontrakModels::class,'id','item_kontrak_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function firm()
    {
        return $this->belongsTo(FirmModels::class, 'firm_id');
    }
}
