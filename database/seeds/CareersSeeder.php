<?php

use Illuminate\Database\Seeder;
use App\Career;

class CareersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('careers')->truncate();

        $career = Career::create([
    		"nombre" => "Tecnico en produccion musical",
    		"precio" => "1250",
            "status" => 1
    	]);

    	 $career = Career::create([
    		"nombre" => "Tecnico profesional en musical",
    		"precio" => "1250",
            "status" => 1
    	]);

    	$career->save();
    }
}
