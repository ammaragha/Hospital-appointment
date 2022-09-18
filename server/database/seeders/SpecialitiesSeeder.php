<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SpecialitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $generalPractice = [
            "Pediatrics", "Radiology", "Ophthalmology", " Sports medicine ",
            "rehabilitation", "Oncology", "Dermatology", "Emergency Medicine"
        ];

        function inserts($arr): array
        {
            $res = [];
            foreach ($arr as $val) {
                $row = [
                    'name' => $val,
                    'description' => Str::random()
                ];
                array_push($res, $row);
            }
            return $res;
        }


        DB::table('specialities')->insert(inserts($generalPractice));
    }
}
