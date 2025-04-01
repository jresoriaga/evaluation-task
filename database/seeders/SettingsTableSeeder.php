<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SettingsTableSeeder extends Seeder
{
        /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Grab the table name from config, or default to 'settings'
        $table = config('backpack.settings.table_name', 'settings');
        $now = Carbon::now();

        $settings = [
            [
                'key'         => 'menu_title',
                'name'        => 'Menu Title',
                'description' => 'The title displayed in the admin sidebar and for demo purpose only.',
                'value'       => 'Demo Entities',
                'field'       => '{"name": "value", "value": "value", "type": "text"}',
                'active'      => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'key'         => 'contact_email',
                'name'        => 'Contact Email',
                'description' => 'The email address for contact form submissions',
                'value'       => 'admin@updivision.com',
                'field'       => '{"name": "value", "value": "value", "type": "email"}',
                'active'      => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ];

        foreach ($settings as $setting) {
            DB::table($table)->updateOrInsert(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
