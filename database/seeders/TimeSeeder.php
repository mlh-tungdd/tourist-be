<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('times')->insert([
            ['title' => '1 ngày 0 đêm', 'created_at' => '2021-02-08 04:54:14'],
            ['title' => '1 ngày 1 đêm', 'created_at' => '2021-02-08 04:54:14'],
            ['title' => '2 ngày 0 đêm', 'created_at' => '2021-02-08 04:54:14'],
            ['title' => '2 ngày 1 đêm', 'created_at' => '2021-02-08 04:54:14'],
            ['title' => '2 ngày 2 đêm', 'created_at' => '2021-02-08 04:54:14'],
            ['title' => '3 ngày 0 đêm', 'created_at' => '2021-02-08 04:54:14'],
            ['title' => '3 ngày 1 đêm', 'created_at' => '2021-02-08 04:54:14'],
            ['title' => '3 ngày 2 đêm', 'created_at' => '2021-02-08 04:54:14'],
            ['title' => '3 ngày 3 đêm', 'created_at' => '2021-02-08 04:54:14'],
        ]);
    }
}
