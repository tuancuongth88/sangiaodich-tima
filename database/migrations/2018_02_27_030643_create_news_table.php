<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->longText('description')->nullable();
            $table->longText('content')->nullable();
            $table->integer('is_comment')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('is_approve')->nullable();
            $table->string('image_url')->nullable();
            $table->string('title_meta')->nullable();
            $table->string('description_meta')->nullable();
            $table->string('keyword_meta')->nullable();
            $table->timestamp('send_at')->nullable();
            $table->timestamp('approve_time')->nullable();
            $table->integer('author')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('news');
    }
}
