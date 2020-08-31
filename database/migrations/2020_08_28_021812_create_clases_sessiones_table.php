<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasesSessionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clases_sessiones', function (Blueprint $table) {
            $table->id();
            $table->integer('clas_id');
            $table->text('url_zoom');
            $table->string('id_reunion');
            $table->string('codigo_acceso');
            $table->dateTime('fecha_inicio');
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
        Schema::dropIfExists('clases_sessiones');
    }
}
