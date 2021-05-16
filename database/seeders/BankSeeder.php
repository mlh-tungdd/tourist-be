<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banks')->insert([
            [
                'name' => 'Ngân hàng TMCP Ngoại Thương Việt Nam (Vietcombank)',
                'address' => 'Sở Giao dịch - 31-33 Ngô Quyền - Hoàn Kiếm - Hà Nội',
                'number_account' => '0011000277243',
                'name_account' => 'CÔNG TY LỮ HÀNH TOURIST - TỔNG CÔNG TY DU LỊCH HÀ NỘI',
                'thumbnail' => 'https://phanmemquanly.hanoitourist.online/web/image/1233',
                'created_at' => '2021-02-08 04:54:14'
            ],
            [
                'name' => 'Ngân hàng Việt Nam Thương Tín ( Vietbank)',
                'address' => 'Chi nhánh Hoàn kiếm - 70-72 Bà Triệu, Phường Hàng Bài, Quận Hoàn Kiếm, Hà Nội.',
                'number_account' => '86.86.86',
                'name_account' => 'CÔNG TY LỮ HÀNH TOURIST - TỔNG CÔNG TY DU LỊCH HÀ NỘI',
                'thumbnail' => 'https://phanmemquanly.hanoitourist.online/web/image/96113',
                'created_at' => '2021-02-08 04:54:14'
            ],
            [
                'name' => 'Ngân hàng TMCP Đầu Tư Và Phát Triển Việt Nam (BIDV)',
                'address' => 'Chi nhánh Hoàn Kiếm - Số 194 Trần Quang Khải,P. Lý Thái Tổ,Q. Hoàn Kiếm, TP. Hà Nội',
                'number_account' => '124.10.00.147.5630',
                'name_account' => 'CÔNG TY LỮ HÀNH TOURIST - TỔNG CÔNG TY DU LỊCH HÀ NỘI',
                'thumbnail' => 'https://phanmemquanly.hanoitourist.online/web/image/1237',
                'created_at' => '2021-02-08 04:54:14'
            ],
        ]);
    }
}
