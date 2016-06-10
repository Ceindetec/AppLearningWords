<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalabrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('palabras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_vocabulario')->unsigned();
            $table->string('palabra_esp', 25)->unique();
            $table->string('palabra_ing', 25);
//            $table->string('pasado', 25)->nullable();
//            $table->string('participio', 25)->nullable();

            $table->foreign('id_vocabulario')
                ->references('id')
                ->on('vocabularios')
                ->onDelete('cascade');

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
        Schema::drop('palabras');
    }
}
