<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    // protected $fillable = ['kd_produk', 'nama', 'size', 'harga_satuan', 'stock', 'img', 'video', 'point'];
    protected $guarded = ['id'];
     // Definisikan atribut dan metode sesuai kebutuhan Anda
     protected $fillable = ['cs_id','namaPelanggan', 'email','tanggalRegistrasi', 'hp', 'alamat', 'hp2', 'kabupaten', 'kecamatan', 'provinsi', 'kodepos'];
     protected $table = 'pelanggan';
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('namaPelanggan', 'like', '%' . $search . '%')
                ->orWhere('alamat', 'like', '%' . $search . '%');
        });
    }
}
