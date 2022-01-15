<?php

use Illuminate\Database\Seeder;
use App\Administrator;

class AdminRootSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('administrators')->truncate();

    	$admin1 = Administrator::create([
    		"nombre" => "Vasni",
            "apaterno" => "Jaimes",
    		"amaterno" => "Lopez",
            "fecha_nacimiento" => "1992-07-18",
    		"email" => "baster07mi@gmail.com",
    		"password" => bcrypt("slaner506"),
    	]);

    	$admin1->save();

        $admin1->roles()->attach([1]);


        $admin2 = Administrator::create([
            "nombre" => "Jimena",
            "apaterno" => "Jimena",
            "amaterno" => "Jimena",
            "fecha_nacimiento" => "1992-07-18",
            "email" => "jimena@pruebas.com",
            "password" => bcrypt("slaner506"),
        ]);

        $admin2->save();

        $admin2->roles()->attach([1]);
    }
}
