<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateControlAvancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_avances', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('estado',['Not started','In progress','Completed']);
            $table->string('usuario_documento')->index();
            $table->foreign('usuario_documento')->references('documento')->on('users');
            $table->integer('actividad_id')->unsigned();
            $table->foreign('actividad_id')->references('id')->on('actividades');
            $table->integer('leccion_id')->unsigned();
            $table->foreign('leccion_id')->references('id')->on('lecciones_encs')->onDelete('cascade');
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
        Schema::drop('control_avances');
    }
}
