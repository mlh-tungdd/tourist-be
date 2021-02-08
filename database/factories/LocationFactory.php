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
            'regions' => $this->faker->numberBetween($min = 1, $max = 7),
            'city' => $this->faker->city,
            'description' => $this->faker->text(200),
            'content' => $this->faker->text(200),
            'thumbnail' => 'https://fakeimg.pl/700x400/?text=' . $this->faker->word,
            'type' => $this->faker->numberBetween($min = 0, $max = 1),
            'is_departure' => $this->faker->numberBetween($min = 0, $max = 1),
        ];
    }
}
