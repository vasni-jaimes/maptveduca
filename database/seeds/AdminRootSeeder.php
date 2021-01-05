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

    	$admin = Administrator::create([
    		"nombre" => "Vasni",
            "apaterno" => "Jaimes",
    		"amaterno" => "Lopez",
            "fecha_nacimiento" => "1992-07-18",
    		"email" => "baster07mi@gmail.com",
            "rol_id" => 1,
    		"password" => bcrypt("slaner506"),
    	]);

    	$admin->save();
    }
}
