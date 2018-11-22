<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TaoGoiTin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goitin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('TieuDe','191');
            $table->string('TieuDeKhongDau','191');
            $table->text('TomTat');
            $table->longText('NoiDung');
            $table->string('Hinh','191');
            $table->integer('NoiBat')->default(0);
            $table->integer('SoLuotXem')->default(0);
            $table->integer('idTheloai')->unsigned();
            $table->foreign('idTheloai')->references('id')->on('theloai');
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
        Schema::drop('goitin');
    }
}
