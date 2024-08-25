<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangOrder extends Model
{
    use HasFactory;
    protected $table = 'barang_order';

    protected $fillable = [
        'id_order',
        'order_number',
        'id_produk',
        'size',
        'quantity',
        'subtotal',

    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order');
    }

    public function produk()
    {
        return $this->belongsTo(Barang::class, 'id_produk');
    }
}
