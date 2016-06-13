<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeccionesEncsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecciones_encs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');             
            $table->string('usuario_documento',10)->index();
            $table->foreign('usuario_documento')->references('documento')->on('users');            
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
        Schema::drop('lecciones_encs');
    }
}
