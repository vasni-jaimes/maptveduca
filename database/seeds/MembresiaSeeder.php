<?php

use Illuminate\Database\Seeder;
use App\Membresia;

class MembresiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	\DB::table('membresias')->truncate();

        Membresia::create([
        	"nombre" => "Membresía básica",
        	"slug" => "membresia-basica",
        	"precio" => 120.00,
        ]);

         Membresia::create([
        	"nombre" => "Membresía académica",
        	"slug" => "membresia-academica",
        	"precio" => 2000.00,
        ]);
    }
}
