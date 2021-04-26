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
            'company' => 'CÔNG TY LỮ HÀNH TOURIST',
            'content' => 'Lorem ipsum dolor',
            'favicon' => '',
            'website' => 'http://tourist-cl-app.herokuapp.com',
            'logo' => '',
            'address' => '18 Lý Thường Kiệt, Ph.Phan Chu Trinh, Q.Hoàn Kiếm, Hà Nội',
            'hotline' => '0973793xxx',
            'email' => 'tourist@gmail.com',
            'facebook' => 'https://www.facebook.com/tunggdd',
            'youtube' => 'https://www.facebook.com/tunggdd',
            'google' => 'https://www.facebook.com/tunggdd',
            'instagram' => 'https://www.facebook.com/tunggdd',
        ]);
    }
}
