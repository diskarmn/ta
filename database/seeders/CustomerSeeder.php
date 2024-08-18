<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

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
    }
}
