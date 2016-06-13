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
            $table->enum('estado',['No iniciada','En progreso','Finalizada']);
            $table->string('usuario_documento')->index();
            $table->foreign('usuario_documento')->references('documento')->on('users');
            $table->integer('actividad_id')->unsigned();
            $table->foreign('actividad_id')->references('id')->on('actividades');
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
