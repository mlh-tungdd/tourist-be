<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            TimeSeeder::class,
            SettingSeeder::class,
            LocationSeeder::class,
        ]);
        \App\Models\User::factory(10)->create();
        \App\Models\Tour::factory(10)->create();
        \App\Models\TourDeparture::factory(10)->create();
        \App\Models\TourPrice::factory(10)->create();
        \App\Models\TourSchedule::factory(10)->create();
        \App\Models\TourImage::factory(10)->create();
        \App\Models\Album::factory(10)->create();
        \App\Models\AlbumImage::factory(10)->create();
        \App\Models\Banner::factory(10)->create();
        \App\Models\Partner::factory(10)->create();
        \App\Models\CategoryNews::factory(10)->create();
        \App\Models\News::factory(10)->create();
    }
}
