<?php

namespace Database\Factories;

use App\Models\CategoryNews;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryNewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CategoryNews::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(6, true),
            'parent_id' => null,
        ];
    }
}
