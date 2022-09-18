<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(
            [
                AdminSedder::class,
                SpecialitiesSeeder::class,
            ]
        );

        Doctor::factory(10)->create();

    }
}
