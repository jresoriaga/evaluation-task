<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Iso;

class IsoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Iso::create([
            'business_name'  => 'Alpha ISO',
            'contact_name'   => 'John Doe',
            'contact_number' => '(123) 456-7890',
            'emails'         => json_encode([['email' => 'alpha@example.com']])
        ]);

        Iso::create([
            'business_name'  => 'Beta ISO',
            'contact_name'   => 'Jane Smith',
            'contact_number' => '(234) 567-8901',
            'emails'         => json_encode([['email' => 'beta@example.com']])
        ]);

        Iso::create([
            'business_name'  => 'Gamma ISO',
            'contact_name'   => 'Mike Johnson',
            'contact_number' => '(345) 678-9012',
            'emails'         => json_encode([['email' => 'gamma@example.com']])
        ]);
    }
}