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
        $time = \App\Models\Time::get()->pluck('id')->toArray();
        $vehicle = \App\Models\Vehicle::get()->pluck('id')->toArray();
        $departure = \App\Models\Location::where('is_departure', 1)->get()->pluck('id')->toArray();
        $destination = \App\Models\Location::where('is_departure', 0)->get()->pluck('id')->toArray();
        return [
            'roll_number' => $this->faker->unique()->name,
            'title' => $this->faker->sentence(6, true),
            'description' => $this->faker->text(200),
            'content' => $this->faker->text(200),
            'schedule' => $this->faker->text(200),
            'term' => $this->faker->text(200),
            'thumbnail' => '',
            'space' => $this->faker->numberBetween(0, 100),
            'time_id' => $this->faker->randomElement($time),
            'vehicle_id' => $this->faker->randomElement($vehicle),
            'departure_id' => $this->faker->randomElement($departure),
            'destination_id' => $this->faker->randomElement($destination),
        ];
    }
}