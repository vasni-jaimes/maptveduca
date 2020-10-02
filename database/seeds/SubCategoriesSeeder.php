<?php

use Illuminate\Database\Seeder;
use App\Subcategoria;

class SubCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('subcategorias')->truncate();

    	$subcategoria = Subcategoria::create([
            "categoria_id" => 1,
    		"nombre" => "Cursos base",
            "status" => 1
    	]);

    	$subcategoria = Subcategoria::create([
            "categoria_id" => 1,
    		"nombre" => "Cursos extra",
            "status" => 1
    	]);

        $subcategoria = Subcategoria::create([
            "categoria_id" => 1,
            "nombre" => "Principiante",
            "status" => 1
        ]);

        $subcategoria = Subcategoria::create([
            "categoria_id" => 1,
            "nombre" => "Intermedio",
            "status" => 1
        ]);

        $subcategoria = Subcategoria::create([
            "categoria_id" => 1,
            "nombre" => "Avanzado",
            "status" => 1
        ]);

        $subcategoria = Subcategoria::create([
            "categoria_id" => 1,
            "nombre" => "Grabación",
            "status" => 1
        ]);

        $subcategoria = Subcategoria::create([
            "categoria_id" => 1,
            "nombre" => "Mezcla",
            "status" => 1
        ]);

        $subcategoria = Subcategoria::create([
            "categoria_id" => 1,
            "nombre" => "DAW’s",
            "status" => 1
        ]);

        $subcategoria = Subcategoria::create([
            "categoria_id" => 1,
            "nombre" => "Teoría musical",
            "status" => 1
        ]);

        $subcategoria = Subcategoria::create([
            "categoria_id" => 2,
            "nombre" => "Solfeo",
            "status" => 1
        ]);

        $subcategoria = Subcategoria::create([
            "categoria_id" => 2,
            "nombre" => "Composición",
            "status" => 1
        ]);


        $subcategoria = Subcategoria::create([
            "categoria_id" => 2,
            "nombre" => "Análisis",
            "status" => 1
        ]);

        $subcategoria = Subcategoria::create([
            "categoria_id" => 2,
            "nombre" => "Ensamble",
            "status" => 1
        ]);

        $subcategoria = Subcategoria::create([
            "categoria_id" => 2,
            "nombre" => "Canto",
            "status" => 1
        ]);

        $subcategoria = Subcategoria::create([
            "categoria_id" => 2,
            "nombre" => "Piano",
            "status" => 1
        ]);

        $subcategoria = Subcategoria::create([
            "categoria_id" => 2,
            "nombre" => "Guitarra",
            "status" => 1
        ]);

        $subcategoria = Subcategoria::create([
            "categoria_id" => 2,
            "nombre" => "Bajo",
            "status" => 1
        ]);

        $subcategoria = Subcategoria::create([
            "categoria_id" => 2,
            "nombre" => "Batería",
            "status" => 1
        ]);

        $subcategoria = Subcategoria::create([
            "categoria_id" => 2,
            "nombre" => "Music Business",
            "status" => 1
        ]);

    	$subcategoria->save();
    }
}
