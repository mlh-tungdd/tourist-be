<?php

namespace Database\Factories;

use App\Models\AlbumImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlbumImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AlbumImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $albums = \App\Models\Album::get()->pluck('id')->toArray();
        return [
            'thumbnail' => 'https://fakeimg.pl/700x400/?text=' . $this->faker->word,
            'album_id' => $this->faker->randomElement($albums),
        ];
    }
}
