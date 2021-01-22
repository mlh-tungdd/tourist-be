<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Location::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'regions' => $this->faker->biasedNumberBetween($min = 1, $max = 7),
            'city' => $this->faker->city,
            'type' => $this->faker->biasedNumberBetween($min = 1, $max = 1),
            'is_departure' => $this->faker->biasedNumberBetween($min = 0, $max = 1),
        ];
    }
}