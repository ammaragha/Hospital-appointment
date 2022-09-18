<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'admin',
            'password'=> Hash::make('admin'),
            'email'=> 'admin@admin.com',
            'role'=>'admin',
            'gender'=>'male',
            'phone'=>"01111111111",
            'birthday'=>Carbon::now(),
        ]);
    }
}
