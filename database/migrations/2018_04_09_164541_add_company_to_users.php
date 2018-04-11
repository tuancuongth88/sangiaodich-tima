<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('job', 256)->after('gender')->nullable();
            $table->string('company_name', 256)->after('job')->nullable();
            $table->integer('company_phone')->after('company_name')->nullable();
            $table->string('company_address', 256)->after('company_phone')->nullable();
            $table->integer('card_number')->after('phone')->nullable();
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
