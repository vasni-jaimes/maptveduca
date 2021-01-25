<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAulasRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aulas_respuestas', function (Blueprint $table) {
            $table->id();
            $table->integer('instructor_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('publicacion_id');
            $table->text('respuesta');
            $table->text('archivos')->nullable();
            $table->boolean('pendiente')->default(1);
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
        Schema::dropIfExists('aulas_respuestas');
    }
}
