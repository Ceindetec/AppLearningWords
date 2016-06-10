<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerbosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verbos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('verbo')->unique();
            $table->string('presente')->unique();
            $table->string('pasado')->unique();
            $table->string('participio')->unique();
            $table->enum('tipo',['regular', 'irregular']);
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
        Schema::drop('verbos');
    }
}
