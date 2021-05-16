<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGruposToAulasPublicacionCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aulas_publicacion_create', function (Blueprint $table) {
            $table->integer('grupo_id')->nullable()->after('instructor_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aulas_publicacion_create', function (Blueprint $table) {
            $table->dropColumn('grupo_id');
        });
    }
}
