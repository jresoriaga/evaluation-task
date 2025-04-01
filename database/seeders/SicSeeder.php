<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sic;

class SicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sic::create([
            'code'        => 0111,
            'description' => 'Agricultural Production – Crops',
        ]);

        Sic::create([
            'code'        => 2752,
            'description' => 'Printed Packaging',
        ]);

        Sic::create([
            'code'        => 3571,
            'description' => 'Electronic Computers',
        ]);
    }
}