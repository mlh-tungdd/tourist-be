<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $hotels = \App\Models\Hotel::get()->pluck('id')->toArray();
        return [
            'thumbnail' => 'https://fakeimg.pl/1920x1080/?text=' . $this->faker->word,
            'name' => $this->faker->sentence(6, true),
            'area' => $this->faker->numberBetween($min = 10, $max = 100),
            'space' => $this->faker->numberBetween($min = 10, $max = 100),
            'position' => $this->faker->sentence(6, true),
            'options' => '[ "1", "2", "3", "4" ]',
            'price' => $this->faker->numberBetween(1000000, 5000000),
            'qty' => $this->faker->numberBetween($min = 10, $max = 100),
            'note' => $this->faker->text(200),
            'convenients' => '[ "1", "2", "3", "4" ]',
            'hotel_id' => $this->faker->randomElement($hotels),
        ];
    }
}
