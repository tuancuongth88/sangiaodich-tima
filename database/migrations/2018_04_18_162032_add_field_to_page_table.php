<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('pages', function (Blueprint $table) {
            $table->longText('summary')->nullable();
            $table->integer('author')->nullable();
            $table->string('machine_name')->nullable()->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['machine_name', 'summary', 'author']);
        });
    }
}
