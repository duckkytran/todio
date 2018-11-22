<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TaoSlide extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Slide', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Ten','191');
            $table->string('Hinh','191');
            $table->string('NoiDung','191');
            $table->string('link','191');
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
        Schema::drop('Slide');
    }
}
