<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDistricCityToUserAndServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('district_id', 125)->after('address')->nullable();
            $table->string('ward_id', 125)->after('address')->nullable();
            $table->string('city_id', 125)->after('address')->nullable();
        });
        Schema::table('transaction_history', function (Blueprint $table) {
            $table->dropColumn('provice_id');
            $table->string('district_id', 125)->nullable()->change();
            $table->string('ward_id', 125)->after('user_id')->nullable();
            $table->string('city_id', 125)->after('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['district_id', 'ward_id', 'city_id']);
        });
        Schema::table('transaction_history', function (Blueprint $table) {
            $table->dropColumn(['district_id', 'ward_id', 'city_id']);
        });
    }
}
