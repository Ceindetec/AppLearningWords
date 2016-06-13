<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTraduccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traducciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('palabra_id')->unsigned();
            $table->foreign('palabra_id')->references('id')->on('palabras_esp');
            $table->integer('idiomas_id')->unsigned();
            $table->foreign('idiomas_id')->references('id')->on('idiomas');
            $table->string('traduccion');
            $table->integer('tipo_id')->unsigned();
            $table->foreign('tipo_id')->references('id')->on('tipos_palabra');
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
        Schema::drop('traducciones');
    }
}
