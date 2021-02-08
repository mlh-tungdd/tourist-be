<?php

namespace Database\Factories;

use App\Models\TourSchedule;
use Illuminate\Database\Eloquent\Factories\Factory;

class TourScheduleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TourSchedule::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tours = \App\Models\Tour::get()->pluck('id')->toArray();
        return [
            'title' => $this->faker->sentence(6, true),
            'content' => $this->faker->text(100),
            'day_number' => $this->faker->numberBetween(1, 7),
            'tour_id' => $this->faker->randomElement($tours),
        ];
    }
}
