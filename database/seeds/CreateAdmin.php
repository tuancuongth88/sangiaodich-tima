<?php

use Illuminate\Database\Seeder;

class CreateAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'username'      => 'admin',
            'email'         => 'admin',
            'fullname'      => 'Admin',
            'password'      => \Hash::make(123456),
            'active'        => 1,
            'role' 			=> 1,
        ]);
    }
}
