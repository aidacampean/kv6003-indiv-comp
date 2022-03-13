<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'trip_id' => \App\Models\Trip::pluck('id')->random(),
            'name' => $this->faker->randomElement(['flight', 'hotel', 'excursion', 'other']),
            'description' => $this->faker->word(),
            'date' => $this->faker->date()
        ]; 
    }
}
