<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceDayDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('service_day_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('day_name',256)->nullable();
            $table->string('day',256)->nullable();
            $table->integer('service_id')->nullable();
            $table->string('day_type',256)->nullable();
            $table->string('status',256)->nullable();
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
        Schema::dropIfExists('service_day_detail');
    }
}
