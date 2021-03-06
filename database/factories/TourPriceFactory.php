<?php

namespace Database\Factories;

use App\Models\TourPrice;
use Illuminate\Database\Eloquent\Factories\Factory;

class TourPriceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TourPrice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tours = \App\Models\Tour::get()->pluck('id')->toArray();
        return [
            'type_customer' => $this->faker->sentence(3, true),
            'original_price' => $this->faker->numberBetween(4000000, 5000000),
            'price' => $this->faker->numberBetween(1000000, 5000000),
            'tour_id' => $this->faker->randomElement($tours),
        ];
    }
}
