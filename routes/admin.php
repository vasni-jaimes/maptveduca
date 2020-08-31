<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//LOGIN
Route::get('/', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('login', 'Admin\LoginController@login')->name('send.admin.login');
Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');


//USUARIOS
Route::get('listado-usuarios', "Admin\UsersController@index")->name('listado-usuarios');

//CURSOS
Route::get('agregar-curso', 'Admin\CoursesController@create')->name('agregar-curso.create');
Route::get('listado-cursos', 'Admin\CoursesController@index')->name('agregar-curso.index');
Route::post('agregar-curso', 'Admin\CoursesController@store')->name('agregar-curso.store');
Route::get('editar-curso/{curso_id}', 'Admin\CoursesController@edit')->name('agregar-curso.edit');
Route::post('editar-curso/{curso_id}', 'Admin\CoursesController@update')->name('actualizar-curso.update');
Route::post('eliminar-archivo', 'Admin\CoursesController@deleteFile')->name('eliminar-archivo.delete');



//CURSOS EN LINEA
Route::get('agregar-clase', 'Admin\ClasesController@create')->name('agregar-clase.create');
Route::post('agregar-clase', 'Admin\ClasesController@store')->name('agregar-clase.store');
Route::get('listado-clases', 'Admin\ClasesController@index')->name('listado-clases.index');
Route::get('editar-clase/{clase_id}', 'Admin\ClasesController@edit')->name('editar-clase.edit');
Route::post('editar-clase/{clase_id}', 'Admin\ClasesController@update')->name('editar-clase.update');

//EVENTOS EN LINEA
Route::get('agregar-evento', 'Admin\EventosController@create')->name('agregar-evento.create');