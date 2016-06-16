<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalabrasEspCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('palabras_esp_categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_palabraEsp')->unsigned();
            $table->integer('id_Categoria')->unsigned();
            $table->foreign('id_palabraEsp')->references('id')->on('palabras_esp');
            $table->foreign('id_Categoria')->references('id')->on('categorias');
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
        Schema::drop('palabras_esp_categorias');
    }
}
