<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlide extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('slide', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',256)->nullable();
            $table->string('image_url',256)->nullable();
            $table->string('description',256)->nullable();
            $table->string('link',256)->nullable();
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
        //
        Schema::dropIfExists('slide');
    }
}
