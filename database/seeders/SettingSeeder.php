<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'title' => 'Tourist',
            'description' => 'Lorem ipsum dolor',
            'content' => 'Lorem ipsum dolor',
            'favicon' => '',
            'logo' => '',
            'address' => '',
            'hotline' => '0973793xxx',
            'email' => 'tourist@gmail.com',
        ]);
    }
}
