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
        \App\Models\User::factory(1)->create();
        // \App\Models\Vehicle::factory(5)->create();
        // \App\Models\Time::factory(5)->create();
        // \App\Models\Location::factory(5)->create();
        // \App\Models\Tour::factory(5)->create();
    }
}