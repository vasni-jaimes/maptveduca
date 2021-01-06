<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAulasPublicacionCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aulas_publicacion_create', function (Blueprint $table) {
            $table->id();
            $table->integer('curso_id');
            $table->integer('session_id');
            $table->integer('instructor_id');
            $table->text('publicacion');
            $table->text('archivo')->nullable();
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
        Schema::dropIfExists('aulas_publicacion_create');
    }
}
