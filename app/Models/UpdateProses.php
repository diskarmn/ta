<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdateProses extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_status',
        'order_number',
        'id_order',
        'nama_proses',
        'kelengkapan',
        'keterangan'

    ];
}
