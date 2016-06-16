<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('leccion_id')->unsigned();
            $table->foreign('leccion_id')->references('id')->on('lecciones_encs')->onDelete('cascade');
            $table->string('usuario_documento',10)->index();
            $table->foreign('usuario_documento')->references('documento')->on('users');   
            $table->integer('cant_aciertos');
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
        Schema::drop('evaluaciones');
    }
}
