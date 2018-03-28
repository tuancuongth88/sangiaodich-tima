<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeeDiscountConfig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('fee_discount_config', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id')->nullable();
            $table->string('service_code',256)->nullable();
            $table->string('discount_percent',256)->nullable();
            $table->integer('validate_time')->nullable();
            $table->string('expried_time',256)->nullable();
            $table->string('created_by',256)->nullable();
            $table->string('created_time',256)->nullable();
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
        Schema::dropIfExists('fee_discount_config');
    }
}
