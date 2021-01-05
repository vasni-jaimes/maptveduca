<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->text("nombre");
            $table->integer("tipo_evento_id");
            $table->boolean("especial")->default(0);
            $table->text("slug")->nullable();
            $table->text("img_evento")->nullable();
            $table->text("video_bienvenida");
            $table->text("descripcion");
            $table->dateTime("fecha_lanzamiento");
            $table->text("video_evento")->nullable();
            $table->double('precio', 12, 2)->nullable();

            $table->boolean("status")->default(0);
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
        Schema::dropIfExists('eventos');
    }
}
