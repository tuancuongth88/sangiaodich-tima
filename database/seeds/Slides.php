<?php

use Illuminate\Database\Seeder;

class Slides extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('slides')->insert([
            ['name'      => 'Sàn kết nối tài chính lớn nhất việt nam',
            'image_url'         => 'http://tima.vn/Template1/images/main-slider/slider-1.jpg',
            'description'      => 'Hàng nghin giao dịch mỗi ngày được thực hiện ngay lập tức',
            ],
            [
                'name'      =>  'Cơ hội hợp tác',
                'image_url'      =>  'http://tima.vn/Template1/images/main-slider/slider3.png',
                'description' =>  'dễ dàng tiện lợi.'
            ]
            ]
        );
    }
}
