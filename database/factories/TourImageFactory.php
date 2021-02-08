<?php

namespace Database\Factories;

use App\Models\TourImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class TourImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TourImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tours = \App\Models\Tour::get()->pluck('id')->toArray();
        return [
            'type' => $this->faker->numberBetween(1, 3),
            'thumbnail' => 'https://fakeimg.pl/700x400/?text=' . $this->faker->word,
            'tour_id' => $this->faker->randomElement($tours),
        ];
    }
}
