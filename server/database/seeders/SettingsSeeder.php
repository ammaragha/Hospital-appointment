<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'slg' => 'start_time',
                'value' => '12:00 PM',
            ],
            [
                'slg' => 'end_time',
                'value'=> '09:00 PM'
            ]
        ]);
    }
}
