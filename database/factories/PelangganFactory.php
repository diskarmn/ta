<?php

namespace Database\Factories;

use App\Models\Pelanggan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PelangganFactory extends Factory
{
    protected $model = Pelanggan::class;

    public function definition()
    {
        return [
            'cs_id' => \App\Models\Cs::factory(), // Assuming Cs model exists
            'namaPelanggan' => $this->faker->name,
            'tanggalRegistrasi' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'hp' => $this->faker->phoneNumber,
            'hp2' => $this->faker->optional()->phoneNumber,
            'alamat' => $this->faker->address,
            'provinsi' => $this->faker->state,
            'kabupaten' => $this->faker->city,
            'kecamatan' => $this->faker->citySuffix,
            'kodepos' => $this->faker->randomNumber(5),
            'email' => $this->faker->unique()->safeEmail,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
