<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Employee::create([
            'name' => 'Admin Seven Inc',
            'email' => 'adminseveninc@gmail.com',
            'password' => Hash::make('SevenInc#0812'),
            'profile_image' => 'default.png',
            'gender' => 'female',
            'phone_number' => '08132007563',
            'role' => 'admin',

        ]);


    }
}
