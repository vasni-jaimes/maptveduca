<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCanceledToUsuariosMembresiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuarios_membresia', function (Blueprint $table) {
            $table->boolean('canceled_sub')->default(0)->after('clase_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarios_membresia', function (Blueprint $table) {
            $table->dropColumn('canceled_sub');
        });
    }
}
