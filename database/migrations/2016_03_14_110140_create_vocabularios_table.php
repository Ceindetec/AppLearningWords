<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVocabulariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vocabularios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 25)->unique();
            $table->string('descripcion', 25)->nullable();
            $table->enum('tipo', ['palabra', 'verbo']);
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
        Schema::drop('vocabularios');
    }
}
