<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(User::class);
        $this->call(Services::class);
        $this->call(Slides::class);
        $this->call(FaqCategory::class);
        $this->call(CreateAdmin::class);

    }
}
