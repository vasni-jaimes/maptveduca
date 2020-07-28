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
    	]);

    	$category = Category::create([
    		"nombre" => "Música",
    	]);

    	$category = Category::create([
    		"nombre" => "Nuevo",
    	]);

    	$category = Category::create([
    		"nombre" => "Cursos base",
    	]);

    	$category = Category::create([
    		"nombre" => "Cursos extra",
    	]);

        $category = Category::create([
            "nombre" => "Principiante",
        ]);

        $category = Category::create([
            "nombre" => "Intermedio",
        ]);

        $category = Category::create([
            "nombre" => "Avanzado",
        ]);

        $category = Category::create([
            "nombre" => "Grabación",
        ]);

        $category = Category::create([
            "nombre" => "Mezcla",
        ]);

        $category = Category::create([
            "nombre" => "DAW’s",
        ]);

        $category = Category::create([
            "nombre" => "Teoría musical",
        ]);

        $category = Category::create([
            "nombre" => "Solfeo",
        ]);

        $category = Category::create([
            "nombre" => "Composición",
        ]);


        $category = Category::create([
            "nombre" => "Análisis",
        ]);

        $category = Category::create([
            "nombre" => "Ensamble",
        ]);

        $category = Category::create([
            "nombre" => "Canto",
        ]);

        $category = Category::create([
            "nombre" => "Piano",
        ]);

        $category = Category::create([
            "nombre" => "Guitarra",
        ]);

        $category = Category::create([
            "nombre" => "Bajo",
        ]);

        $category = Category::create([
            "nombre" => "Batería",
        ]);

        $category = Category::create([
            "nombre" => "Music Business",
        ]);

    	$category->save();
    }
}
