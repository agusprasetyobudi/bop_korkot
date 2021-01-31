<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengeluaranModels extends Model
{
    protected $table = 'pengeluaran';

    protected $fillable = ['id_item_transfer','id_parent_transfer','jumlah','created_by'];
}
