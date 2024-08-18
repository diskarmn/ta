<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

class DataBarang
{
    // use HasFactory;
    private static $data_barang =  [
        [
            "kd_produk1" => "BK-01",
            "nama1" => "Blazer",
            "size1" => "L",
            "hrg_satuan1" => "200.000",
            "stok1" => 20,
            "gambar1" => "https://drive.google.com",
            "video1" => "https://drive.google.com",
            "poin_produk1" => 20,
        ],
        [
            "kd_produk2" => "CK-02",
            "nama2" => "Jas",
            "size2" => "M",
            "hrg_satuan2" => "200.000",
            "stok2" => 20,
            "gambar2" => "https://drive.google.com",
            "video2" => "https://drive.google.com",
            "poin_produk2" => 20,
        ],
        [
            "kd_produk3" => "CK-04",
            "nama3" => "Jaket Denim",
            "size3" => "XL",
            "hrg_satuan3" => "200.000",
            "stok3" => 20,
            "gambar3" => "https://drive.google.com",
            "video3" => "https://drive.google.com",
            "poin_produk3" => 20,
        ],
        [
            "kd_produk4" => "LK-05",
            "nama4" => "Korean Blazer",
            "size4" => "L",
            "hrg_satuan4" => "200.000",
            "stok4" => 20,
            "gambar4" => "https://drive.google.com",
            "video4" => "https://drive.google.com",
            "poin_produk4" => 20,
        ]
    ];

    public static function all()
    {
        return self::$data_barang;
    }
}
