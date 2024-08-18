<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resi extends Model
{
    use HasFactory;
    protected $table = 'resi';

    protected $fillable = [
        'id',
        'kurir',
        'ongkos',
        'total_paket',
        'tanggal_kirim',
        'no_resi',
        'order_number',
        'lainnya',
    ];
    public $incrementing = false;
    protected $keyType = 'uuid';
}
