<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->insert([
            [
                'regions' => '1',
                'city' => 'Hà Nội',
                'description' => 'Labore fuga est qui id incidunt.',
                'content' => 'Labore fuga est qui id incidunt.',
                'thumbnail' => 'https://fakeimg.pl/700x400/?text=hello',
                'type' => 0,
                'is_departure' => 1,
                'created_at' => '2021-02-08 04:54:14'
            ],
            [
                'regions' => '1',
                'city' => 'Hải Phòng',
                'description' => 'Labore fuga est qui id incidunt.',
                'content' => 'Labore fuga est qui id incidunt.',
                'thumbnail' => 'https://fakeimg.pl/700x400/?text=hello',
                'type' => 0,
                'is_departure' => 0,
                'created_at' => '2021-02-08 04:54:14'
            ],
            [
                'regions' => '1',
                'city' => 'Ninh Bình',
                'description' => 'Labore fuga est qui id incidunt.',
                'content' => 'Labore fuga est qui id incidunt.',
                'thumbnail' => 'https://fakeimg.pl/700x400/?text=hello',
                'type' => 0,
                'is_departure' => 0,
                'created_at' => '2021-02-08 04:54:14'
            ],
            [
                'regions' => '2',
                'city' => 'Đà Nẵng',
                'description' => 'Labore fuga est qui id incidunt.',
                'content' => 'Labore fuga est qui id incidunt.',
                'thumbnail' => 'https://fakeimg.pl/700x400/?text=hello',
                'type' => 0,
                'is_departure' => 0,
                'created_at' => '2021-02-08 04:54:14'
            ],
            [
                'regions' => '4',
                'city' => 'Tokyo',
                'description' => 'Labore fuga est qui id incidunt.',
                'content' => 'Labore fuga est qui id incidunt.',
                'thumbnail' => 'https://fakeimg.pl/700x400/?text=hello',
                'type' => 1,
                'is_departure' => 0,
                'created_at' => '2021-02-08 04:54:14'
            ],
        ]);
    }
}
