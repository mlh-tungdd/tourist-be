<?php

namespace Database\Factories;

use App\Models\TourDeparture;
use Illuminate\Database\Eloquent\Factories\Factory;

class TourDepartureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TourDeparture::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tours = \App\Models\Tour::get()->pluck('id')->toArray();
        return [
            'start_day' => $this->faker->dateTimeBetween('now', '+3 years'),
            'tour_id' => $this->faker->randomElement($tours),
        ];
    }
}
