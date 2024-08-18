<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusProsesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('status_proses')->insert([
            ['nama_status' => 'Pesanan Ditambahkan'],
            ['nama_status' => 'Dibayar Lunas'],
            ['nama_status' => 'Data Orderan Lengkap'],
            ['nama_status' => 'Sudah Dipacking'],
            ['nama_status' => 'Diantar'],
        ]);
    }
}
