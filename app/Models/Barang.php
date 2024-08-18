<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $casts = ['id' => 'string'];
    protected $fillable = ['kd_produk', 'nama', 'size', 'harga_satuan', 'stock', 'img', 'video'];
        // protected $with = ['kd_produk'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('nama', 'like', '%' . $search . '%')
                ->orWhere('kd_produk', 'like', '%' . $search . '%');
        });
    }


    public function barangOrders()
    {
        return $this->hasMany(BarangOrder::class, 'id_produk');
    }
}
