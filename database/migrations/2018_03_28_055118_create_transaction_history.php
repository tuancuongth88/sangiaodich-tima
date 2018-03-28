<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('transaction_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id')->nullable();
            $table->string('customer_name', 256)->nullable();
            $table->integer('customer_mobile')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('province_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->bigInteger('amount')->nullable();
            $table->integer('amount_day')->nullable();
            $table->dateTime('payment_day')->nullable();
            $table->string('status', 256)->nullable();
            $table->string('created_time', 256)->nullable();
            $table->integer('telesales_id')->nullable();
            $table->dateTime('telesales_time')->nullable();
            $table->integer('sales_id')->nullable();
            $table->dateTime('sales_time')->nullable();
            $table->string('fee', 256)->nullable();
            $table->string('fee_type', 256)->nullable();
            $table->string('percent_discount', 256)->nullable();
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
        Schema::dropIfExists('transaction_history');
    }
}
