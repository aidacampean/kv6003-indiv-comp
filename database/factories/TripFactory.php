<?php

namespace Database\Factories;

use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trips>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'city_id' => \App\Models\City::pluck('id')->random(),
            'user_id' => \App\Models\User::pluck('id')->random(),
            'name' => $this->faker->name(),
            'date_from' => $this->faker->date(),
            'date_to' => $this->faker->date(),
            'budget' => $this->faker->randomFloat(2, 100, 10000),
            'created_at' => $this->faker->date(),
            'updated_at' => now()
        ];
    }
}
