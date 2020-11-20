<?php

use Illuminate\Database\Seeder;

class MembresiasCarrerasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('membresias_carreras')->truncate();

        \DB::table('membresias_carreras')->insert([
        	"membresia_id" => 2,
        	"carrera_id" => 1,
        ]);


        \DB::table('membresias_carreras')->insert([
        	"membresia_id" => 2,
        	"carrera_id" => 2,
        ]);
    }
}
