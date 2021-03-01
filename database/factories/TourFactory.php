<?php

namespace Database\Factories;

use App\Models\Tour;
use Illuminate\Database\Eloquent\Factories\Factory;

class TourFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tour::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $times = \App\Models\Time::get()->pluck('id')->toArray();
        $departures = \App\Models\Location::where('is_departure', 1)->get()->pluck('id')->toArray();
        $destinations = \App\Models\Location::where('is_departure', 0)->get()->pluck('id')->toArray();
        return [
            'roll_number' => $this->faker->unique()->tld,
            'title' => $this->faker->sentence(6, true),
            'description' => $this->faker->text(200),
            'content' => $this->faker->text(200),
            'schedule' => $this->faker->text(200),
            'term' => $this->faker->text(200),
            'thumbnail' => 'https://fakeimg.pl/1920x1080/?text=' . $this->faker->word,
            'space' => $this->faker->numberBetween(0, 20),
            'vehicle' => $this->faker->sentence(3, true),
            'views' => $this->faker->numberBetween(0, 100),
            'time_id' => $this->faker->randomElement($times),
            'departure_id' => $this->faker->randomElement($departures),
            'destination_id' => $this->faker->randomElement($destinations),
        ];
    }
}
