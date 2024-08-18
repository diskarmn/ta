<?php

namespace Database\Seeders;

use App\Models\Juragan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JuraganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Juragan::create([
            'name_juragan' => 'Limited Shoping',
            'address' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id arcu vulputate, consectetur odio ut, efficitur est. In eu posuere.'
        ]);
        Juragan::create([
            'name_juragan' => 'Korean Hunter',
            'address' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id arcu vulputate, consectetur odio ut, efficitur est. In eu posuere.'
        ]);
        Juragan::create([
            'name_juragan' => 'RA',
            'address' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id arcu vulputate, consectetur odio ut, efficitur est. In eu posuere.'
        ]);
    }
}
