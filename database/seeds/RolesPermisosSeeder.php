<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin    = Role::create(["name" => "admin"]);
        $profesor = Role::create(["name" => "profesor_lider"]);
        $director = Role::create(["name" => "director"]);


        //USUARIOS (CLIENTES) MAPTVEDUCA
        Permission::create(["name" => "listado-usuarios"])->syncRoles([$admin, $director]);
        Permission::create(["name" => "usuarios.create"])->syncRoles([$admin]);
        Permission::create(["name" => "usuarios.store"])->syncRoles([$admin]);
        Permission::create(["name" => "usuarios.update"])->syncRoles([$admin]);
        Permission::create(["name" => "cambiar-status-user"])->syncRoles([$admin]);
        Permission::create(["name" => "usuario.destroy"])->syncRoles([$admin]);
    }
}
