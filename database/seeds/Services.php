<?php

use Illuminate\Database\Seeder;

class Services extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('services')->insert([
                [
                    'service_name' => 'Vay trả góp theo ngày',
                    'status' => 1,
                ],
                [
                    'service_name' => 'Vay tín chấp theo lương',
                    'status' => 1,
                ],
                [
                    'service_name' => 'Vay theo sổ hộ khẩu',
                    'status' => 1,
                ],
                [
                    'service_name' => 'Vay theo hóa đơn điện nước',
                    'status' => 1,
                ],
                [
                    'service_name' => 'Vay theo đăng ký xe ô tô',
                    'status' => 1,
                ],
                [
                    'service_name' => 'Vay theo đăng ký xe máy',
                    'status' => 1,
                ],
                [
                    'service_name' => 'Vay mua ô tô trả góp',
                    'status' => 1,
                ],
                [
                    'service_name' => 'Vay mua nhà trả góp',
                    'status' => 1,
                ],
                [
                    'service_name' => 'Vay cầm cố tài sản',
                    'status' => 1,
                ]
            ]
        );
    }
}
