<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToTransactionHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_history', function (Blueprint $table) {
            $table->string('car_brand')->after('status')->nullable();
            $table->string('car_name')->after('status')->nullable();
            $table->string('car_model')->after('status')->nullable();
            $table->string('car_country')->after('status')->nullable();

            $table->string('estate_name')->after('status')->nullable();

            $table->string('mortgage')->after('status')->nullable(); // tai san the chap
            $table->string('mortgage_brand')->after('status')->nullable(); // thuong hieu tai san the chap
            $table->string('mortgage_year')->after('status')->nullable(); // nam san xuat tai san the chap
            $table->string('mortgage_note')->after('status')->nullable(); // mo ta tai san the chap

            $table->string('electric_bill')->after('status')->nullable(); // tien dien thang gan nhat

            $table->string('moto_brand')->after('status')->nullable();
            $table->string('moto_name')->after('status')->nullable();
            $table->string('moto_model')->after('status')->nullable();

        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('income')->after('job')->nullable();
            $table->string('income_cource')->after('job')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_history', function (Blueprint $table) {
            $table->dropColumn([
                'car_brand',
                'car_name',
                'car_model',
                'car_country',
                'estate_name',
                'mortgage',
                'mortgage_brand',
                'mortgage_year',
                'mortgage_note',
                'electric_bill',
                'moto_brand',
                'moto_name',
                'moto_model',
            ]);
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['income', 'income_cource']);
        });
    }
}
