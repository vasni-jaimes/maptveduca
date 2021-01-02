<?php

use Illuminate\Database\Seeder;
use App\Rol;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rol::create([
        	"nombre" => "Administrador",
        ]);

        Rol::create([
        	"nombre" => "Maestro",
        ]);
    }
}
