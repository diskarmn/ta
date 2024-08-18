<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EditRequest extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $casts = ['id' => 'string'];

    protected $table = 'requests';// Menyesuaikan dengan nama tabel yang Anda berikan

    protected $fillable = [
        'id_order', // Menyesuaikan dengan nama kolom yang digunakan dalam tabel 'request'
        'order_number',
        'detail',
        'selesai'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order', 'id');
    }
}
