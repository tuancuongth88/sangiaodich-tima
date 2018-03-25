<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('fullname')->nullable();
            $table->timestamp('birthday')->nullable();
            $table->string('avatar')->nullable();
            $table->string('address')->nullable();
            $table->string('identity')->nullable();
            $table->string('phone')->nullable();
            $table->integer('type')->default(0);
            $table->integer('active')->default(0);
            $table->integer('gender')->default(0);
            $table->integer('last_login')->default(0);
            $table->string('active_code', 20)->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('created_by')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }
}
