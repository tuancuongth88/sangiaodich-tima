<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataTaxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_tax', function (Blueprint $table) {
            $table->increments('id');
            $table->string('masothue', 255)->nullable();
            $table->timestamp('ngaycap')->nullable();
            $table->string('tenchinhthuc', 255)->nullable();
            $table->string('tengiaodich', 255)->nullable();
            $table->string('noidangkyquanly', 255)->nullable();
            $table->string('diachitruso', 255)->nullable();
            $table->string('noidangkynopthue', 255)->nullable();
            $table->string('diachinhanthongbaothe', 255)->nullable();
            $table->string('qdtlngaycap', 255)->nullable();
            $table->string('coquanraquyetdinh', 255)->nullable();
            $table->string('gpkdngaycap', 255)->nullable();
            $table->string('coquancap', 255)->nullable();
            $table->timestamp('ngaynhantokhai')->nullable();
            $table->timestamp('ngaybatdautaichinh')->nullable();
            $table->timestamp('ngayketthuctaichinh')->nullable();
            $table->string('masohientai', 255)->nullable();
            $table->string('chuong', 255)->nullable();
            $table->string('hinhthuchtoan', 255)->nullable();
            $table->string('pptinhthuegtgt', 255)->nullable();
            $table->string('chusohuu_nguoidaidien', 255)->nullable();
            $table->string('diachi_chusohuu_nguoidaidien', 255)->nullable();
            $table->string('tengiamdoc', 255)->nullable();
            $table->string('sodienthoaigiamdoc', 255)->nullable();
            $table->string('diachigiamdoc', 255)->nullable();
            $table->string('ketoantruong', 255)->nullable();
            $table->string('sodienthoaiketoantruong', 255)->nullable();
            $table->string('diachiketoantruong', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('phone_company', 255)->nullable();
            $table->bigInteger('x1')->nullable();
            $table->bigInteger('x2')->nullable();
            $table->bigInteger('x3')->nullable();
            $table->bigInteger('x4')->nullable();
            $table->bigInteger('x5')->nullable();
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
        Schema::dropIfExists('data_tax');
    }
}
