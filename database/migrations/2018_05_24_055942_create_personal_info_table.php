<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone', 255)->nullable();
            $table->string('card_id', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('gender', 255)->nullable();
            $table->string('birth', 255)->nullable();
            $table->string('home_address', 255)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_info');
    }
}
