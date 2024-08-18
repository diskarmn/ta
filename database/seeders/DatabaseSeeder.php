<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Barang;
use App\Models\Juragan;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Employee::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'username' => 'johndoe',
            'password' => Hash::make('#JohnDoe12345'), // Replace 'password' with a secure password
            'gender' => 'male',
            'phone_number' => '086789726876',
            'role' => 'superAdmin'
        ]);
        Employee::create([
            'name' => 'John Cena',
            'email' => 'Cena@example.com',
            'username' => 'johncena',
            'password' => Hash::make('#JohnDoe12345'), // Replace 'password' with a secure password
            'gender' => 'male',
            'phone_number' => '086789726876',
            'role' => 'admin'
        ]);
        Employee::create([
            'name' => 'John Smith',
            'email' => 'smith@example.com',
            'username' => 'johnsmith',
            'password' => Hash::make('#JohnDoe12345'), // Replace 'password' with a secure password
            'gender' => 'male',
            'phone_number' => '086789726876',
            'role' => 'cs'
        ]);
        
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
            "point" => 10,
        ]);
        Barang::create([
            "kd_produk" => "BK-06",
            "nama" => "Jacket",
            "size" => "L",
            "harga_satuan" => "1000000",
            "stock" => 20,
            "img" => "https://drive.google.com",
            "video" => "https://drive.google.com",
            "point" => 1,
        ]);  
        
        
        Customer::create([
            'name' => 'Kiko',
            'email' => 'kiko@gmail.com',
            'phone' => '12345678901',
            'address' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id arcu vulputate, consectetur odio ut, efficitur est. In eu posuere.',
            'provinsi' => 'Semarang',
            'kabupaten' => 'Kota Semarang',
            'Kecamatan' => 'Ngaliyan',
            'kodepos' => '68125',
        ]);
        Customer::create([
            'name' => 'Koko',
            'email' => 'Koko@gmail.com',
            'phone' => '12345678901',
            'address' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id arcu vulputate, consectetur odio ut, efficitur est. In eu posuere.',
            'provinsi' => 'Semarang',
            'kabupaten' => 'Kota Semarang',
            'Kecamatan' => 'Ngaliyan',
            'kodepos' => '68125',
        ]);
        Customer::create([
            'name' => 'Kiki',
            'email' => 'Kiki@gmail.com',
            'phone' => '12345678901',
            'address' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id arcu vulputate, consectetur odio ut, efficitur est. In eu posuere.',
            'provinsi' => 'Semarang',
            'kabupaten' => 'Kota Semarang',
            'Kecamatan' => 'Ngaliyan',
            'kodepos' => '68125',
        ]);

        Juragan::create([
            'name_juragan' => 'Limited Shoping',
            'alamat' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id arcu vulputate, consectetur odio ut, efficitur est. In eu posuere.'
        ]);
        Juragan::create([
            'name_juragan' => 'Korean Hunter',
            'alamat' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id arcu vulputate, consectetur odio ut, efficitur est. In eu posuere.'
        ]);
        Juragan::create([
            'name_juragan' => 'RA',
            'alamat' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id arcu vulputate, consectetur odio ut, efficitur est. In eu posuere.'
        ]);
        
        DB::table('status_proses')->insert([
            ['nama_status' => 'Pesanan Ditambahkan'],
            ['nama_status' => 'Dibayar Lunas'],
            ['nama_status' => 'Data Orderan Lengkap'],
            ['nama_status' => 'Bahan Lengkap'],
            ['nama_status' => 'Sablon Lengkap'],
            ['nama_status' => 'Bordir Lengkap'],
            ['nama_status' => 'Penjahit Lengkap'],
            ['nama_status' => 'QC Lengkap'],
            ['nama_status' => 'Sudah Dipacking'],
            ['nama_status' => 'Diantar'],
        ]);
    }
}
