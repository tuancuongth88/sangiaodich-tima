<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('payment_transaction', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->bigInteger('amount')->nullable();
            $table->string('payment_type',256)->nullable();
            $table->string('bankname',256)->nullable();
            $table->string('bankcode',256)->nullable();
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
        Schema::dropIfExists('payment_transaction');
    }
}
