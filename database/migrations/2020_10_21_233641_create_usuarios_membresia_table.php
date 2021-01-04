<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosMembresiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_membresia', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('membresia_id')->nullable();
            $table->integer('carrera_id')->nullable();
            $table->integer('evento_id')->nullable();
            $table->integer('clase_id')->nullable();
            $table->date('fehca_inicio');
            $table->date('fecha_fin')->nullable();
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
        Schema::dropIfExists('usuarios_membresia');
    }
}
