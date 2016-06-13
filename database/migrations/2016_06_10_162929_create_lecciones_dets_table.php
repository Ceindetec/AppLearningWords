<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeccionesDetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecciones_dets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('leccion_id')->unsigned();
            $table->foreign('leccion_id')->references('id')->on('lecciones_encs');
            $table->integer('palabra_id')->unsigned();
            $table->foreign('palabra_id')->references('id')->on('palabras_esp');
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
        Schema::drop('lecciones_dets');
    }
}
