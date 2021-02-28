<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categoriesNews = \App\Models\CategoryNews::get()->pluck('id')->toArray();
        return [
            'title' => $this->faker->sentence(6, true),
            'description' => $this->faker->text(200),
            'content' => $this->faker->text(200),
            'thumbnail' => 'https://fakeimg.pl/1920x1080/?text=' . $this->faker->word,
            'author' => $this->faker->name,
            'source' => $this->faker->url,
            'category_news_id' => $this->faker->randomElement($categoriesNews),
        ];
    }
}
