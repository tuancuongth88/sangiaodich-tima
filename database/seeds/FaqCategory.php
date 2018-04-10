<?php

use Illuminate\Database\Seeder;

class FaqCategory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('slides')->insert([
                [
                    'name'           => 'Hỗ trợ',
                    'slug'           => 'ho-tro'
                ],
                [
                    'name'            =>  'Hỏi đáp',
                    'slug'            =>  'hoi-dap',
                ]
            ]
        );
    }
}
