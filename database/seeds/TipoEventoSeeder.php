<?php

use Illuminate\Database\Seeder;
use App\TipoEventos;

class TipoEventoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tipo_eventos')->truncate();

        $tipoEventos = TipoEventos::create([
    		"nombre" => "Clínicas",
    	]);


    	$tipoEventos = TipoEventos::create([
    		"nombre" => "Conciertos / Masterclass",
    	]);


    	$tipoEventos->save();

    }
}
