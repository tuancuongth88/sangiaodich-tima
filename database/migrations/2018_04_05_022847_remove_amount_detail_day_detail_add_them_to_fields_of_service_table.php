<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveAmountDetailDayDetailAddThemToFieldsOfServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('service_amount_detail');
        Schema::dropIfExists('service_day_detail');
        Schema::table('services', function (Blueprint $table) {
            $table->longText('amount_detail')->after('service_name')->nullable();
            $table->longText('day_detail')->after('service_name')->nullable();
            $table->string('icon_url', 256)->after('image_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['amount_detail', 'day_detail', 'icon_url']);
        });
        Schema::create('service_amount_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('amount_name',256)->nullable();
            $table->string('amount',256)->nullable();
            $table->integer('service_id')->nullable();
            $table->string('amount_type',256)->nullable();
            $table->string('status',256)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
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
}
