<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdateStatusProses extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_status',
        'order_number',
        'kelengkapan',
        'keterangan'

    ];
}
