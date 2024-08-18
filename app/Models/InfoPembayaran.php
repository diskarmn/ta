<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoPembayaran extends Model
{
    use HasFactory;
    protected $table = 'info_pembayaran';

    protected $fillable = [
        'order_id',
        'order_number',
        'jumlah_dana',
        'kelengkapan',
        'link',
        'payment_method',
        'gambar'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
