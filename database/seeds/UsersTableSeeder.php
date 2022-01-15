<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	\DB::table('users')->truncate();
        //factory(User::class, 50)->create();

         $user = User::create([
    		"nombre" => "Vasni",
            "apaterno" => "Jaimes",
    		"amaterno" => "Lopez",
            "fecha_nacimiento" => "1992-07-18",
    		"email" => "baster07mi@hotmail.com",
    		"password" => bcrypt("123456789"),
    	]);


         $user->save();
    }
}
