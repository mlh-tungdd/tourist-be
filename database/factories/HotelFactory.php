<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

class HotelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hotel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $locations = \App\Models\Location::get()->pluck('id')->toArray();
        return [
            'name' => $this->faker->sentence(6, true),
            'address' => $this->faker->address,
            'description' => $this->faker->text(200),
            'content' => $this->faker->text(200),
            'star' => $this->faker->numberBetween($min = 1, $max = 5),
            'active' => $this->faker->numberBetween($min = 0, $max = 1),
            'from_price' => $this->faker->numberBetween(1000000, 5000000),
            'thumbnail' => 'https://fakeimg.pl/1920x1080/?text=' . $this->faker->word,
            'location_id' => $this->faker->randomElement($locations),
        ];
    }
}
