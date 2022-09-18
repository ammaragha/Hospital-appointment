<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    static $autoIncrement=0;


   

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'special_id' => ++self::$autoIncrement < 9 ? self::$autoIncrement:8,
        ];
    }

    public function autoIncrement()
    {
        for ($i = 0; $i < 1000; $i++) {
            yield $i;
        }
    }
}
