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
                    'image_url' => '/frontend/images/1.png',
                    'slug' => 'vay-tra-gop-theo-ngay'
                ],
                [
                    'service_name' => 'Vay tín chấp theo lương',
                    'status' => 1,
                    'image_url' => '/frontend/images/2.png',
                    'slug' => 'vay-tin-chap-theo-luong'
                ],
                [
                    'service_name' => 'Vay theo sổ hộ khẩu',
                    'status' => 1,
                    'image_url' => '/frontend/images/3.png',
                    'slug' => 'vay-theo-so-ho-khau'
                ],
                [
                    'service_name' => 'Vay theo hóa đơn điện nước',
                    'status' => 1,
                    'image_url' => '/frontend/images/4.png',
                    'slug' => 'vay-theo-hoa-don-dien-nuoc'
                ],
                [
                    'service_name' => 'Vay theo đăng ký xe ô tô',
                    'status' => 1,
                    'image_url' => '/frontend/images/5.png',
                    'slug' => 'vay-theo-dang-ky-xe-o-to'
                ],
                [
                    'service_name' => 'Vay theo đăng ký xe máy',
                    'status' => 1,
                    'image_url' => '/frontend/images/6.png',
                    'slug' => 'vay-theo-dang-ky-xe-may'
                ],
                [
                    'service_name' => 'Vay mua ô tô trả góp',
                    'status' => 1,
                    'image_url' => '/frontend/images/7.png',
                    'slug' => 'vay-mua-o-to-tra-gop'
                ],
                [
                    'service_name' => 'Vay mua nhà trả góp',
                    'status' => 1,
                    'image_url' => '/frontend/images/8.png',
                    'slug' => 'vay-mua-nha-tra-gop'
                ],
                [
                    'service_name' => 'Vay cầm cố tài sản',
                    'status' => 1,
                    'image_url' => '/frontend/images/9.png',
                    'slug' => 'vay-cam-co-tai-san'
                ]
            ]
        );
    }
}
