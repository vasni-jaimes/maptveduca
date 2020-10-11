<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->truncate();


        $category = Category::create([
    		"nombre" => "Produccion musical",
            "status" => 1
    	]);

    	$category = Category::create([
    		"nombre" => "Música",
            "status" => 1
    	]);

    	// $category = Category::create([
    	// 	"nombre" => "Nuevo",
     //        "status" => 1
    	// ]);


    	$category->save();
    }
}
