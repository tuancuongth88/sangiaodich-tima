<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeeAndDiscountToServicesTableAndRemoveTheirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('fee_discount_config');
        Schema::table('fee_service', function (Blueprint $table) {
            $table->integer('discount')->after('fee')->default(0);
        });
        Schema::table('services', function (Blueprint $table) {
            $table->integer('discount')->after('amount_detail')->default(0);
            $table->integer('fee')->after('amount_detail')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('fee_discount_config', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id')->nullable();
            $table->string('discount_percent', 256)->nullable();
            $table->dateTime('validate_time')->nullable();
            $table->dateTime('expire_time')->nullable();
            $table->string('created_by', 256)->nullable();
            $table->string('status', 256)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('fee_service', function (Blueprint $table) {
            $table->dropColumn('discount');
        });
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['discount', 'fee']);
        });
    }
}
