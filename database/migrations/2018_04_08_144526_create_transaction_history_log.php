<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionHistoryLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_history_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transaction_id')->nullable();
            $table->integer('service_code')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('receiver')->nullable();
            $table->string('city_id')->nullable();
            $table->string('district_id')->nullable();
            $table->string('ward_id')->nullable();
            $table->bigInteger('amount')->nullable();
            $table->integer('amount_day')->nullable();
            $table->dateTime('payment_day')->nullable();
            $table->integer('status')->nullable();
            $table->bigInteger('fee')->nullable();
            $table->integer('fee_type')->nullable();
            $table->bigInteger('percent_discount')->nullable();
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
    }
}
