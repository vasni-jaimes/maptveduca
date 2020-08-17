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