<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditSomeFieldOfUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar', 255)->nullable()->change();
            $table->string('address', 255)->nullable()->change();
            $table->string('card_number', 125)->nullable()->change();
            $table->string('company_phone', 125)->nullable()->change();
            $table->smallInteger('sex')->nullable()->change();
            $table->smallInteger('active')->nullable()->default(App\Models\Users\User::UN_ACTIVE)->change();
            $table->renameColumn('income_cource', 'income_source');
            $table->dropColumn(['gender']);
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
            $table->string('avatar')->nullable()->change();
            $table->string('address')->nullable()->change();
            // $table->integer('card_number')->nullable()->change();
            $table->integer('company_phone')->nullable()->change();
            $table->integer('sex')->nullable()->change();
            $table->integer('gender')->nullable();
            $table->integer('active')->nullable()->change();

            $table->renameColumn('income_source', 'income_cource');
        });
    }
}
