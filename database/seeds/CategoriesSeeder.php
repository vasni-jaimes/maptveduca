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

    	$category = Category::create([
    		"nombre" => "Nuevo",
            "status" => 1
    	]);

    	$category = Category::create([
    		"nombre" => "Cursos base",
            "status" => 1
    	]);

    	$category = Category::create([
    		"nombre" => "Cursos extra",
            "status" => 1
    	]);

        $category = Category::create([
            "nombre" => "Principiante",
            "status" => 1
        ]);

        $category = Category::create([
            "nombre" => "Intermedio",
            "status" => 1
        ]);

        $category = Category::create([
            "nombre" => "Avanzado",
            "status" => 1
        ]);

        $category = Category::create([
            "nombre" => "Grabación",
            "status" => 1
        ]);

        $category = Category::create([
            "nombre" => "Mezcla",
            "status" => 1
        ]);

        $category = Category::create([
            "nombre" => "DAW’s",
            "status" => 1
        ]);

        $category = Category::create([
            "nombre" => "Teoría musical",
            "status" => 1
        ]);

        $category = Category::create([
            "nombre" => "Solfeo",
            "status" => 1
        ]);

        $category = Category::create([
            "nombre" => "Composición",
            "status" => 1
        ]);


        $category = Category::create([
            "nombre" => "Análisis",
            "status" => 1
        ]);

        $category = Category::create([
            "nombre" => "Ensamble",
            "status" => 1
        ]);

        $category = Category::create([
            "nombre" => "Canto",
            "status" => 1
        ]);

        $category = Category::create([
            "nombre" => "Piano",
            "status" => 1
        ]);

        $category = Category::create([
            "nombre" => "Guitarra",
            "status" => 1
        ]);

        $category = Category::create([
            "nombre" => "Bajo",
            "status" => 1
        ]);

        $category = Category::create([
            "nombre" => "Batería",
            "status" => 1
        ]);

        $category = Category::create([
            "nombre" => "Music Business",
            "status" => 1
        ]);

    	$category->save();
    }
}
