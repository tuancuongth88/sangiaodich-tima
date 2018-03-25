<?php

use Illuminate\Database\Seeder;

class User extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->insert([
            'username'      => 'admin',
            'email'         => 'admin',
            'fullname'      => 'Admin',
            // 'birthday'      => '01/01/2016',
            'password'      => \Hash::make(123456),
            'active'        => 1,
        ]);
    }
}
