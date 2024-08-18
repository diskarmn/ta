<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Barang::create([
            "kd_produk" => "BK-01",
            "nama" => "Blazer",
            "size" => "L",
            "harga_satuan" => "200000",
            "stock" => 20,
            "img" => "https://drive.google.com",
            "video" => "https://drive.google.com",
            "point" => 20,
        ]);
        Barang::create([
            "kd_produk" => "BK-02",
            "nama" => "Jas",
            "size" => "XL",
            "harga_satuan" => "100000",
            "stock" => 20,
            "img" => "https://drive.google.com",
            "video" => "https://drive.google.com",
            "point" => 10,
        ]);
        Barang::create([
            "kd_produk" => "BK-03",
            "nama" => "Kaos Polo",
            "size" => "L",
            "harga_satuan" => "250000",
            "stock" => 20,
            "img" => "https://drive.google.com",
            "video" => "https://drive.google.com",
            "point" => 90,
        ]);
        Barang::create([
            "kd_produk" => "BK-04",
            "nama" => "Kaos",
            "size" => "XXL",
            "harga_satuan" => "300000",
            "stock" => 20,
            "img" => "https://drive.google.com",
            "video" => "https://drive.google.com",
            "point" => 20,
        ]);
        Barang::create([
            "kd_produk" => "BK-05",
            "nama" => "Celana",
            "size" => "L",
            "harga_satuan" => "500000",
            "stock" => 20,
            "img" => "https://drive.google.com",
            "video" => "https://drive.google.com",
            "point" => 79,
        ]);
    }
}
