<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//INDEX
Route::get('/', 'Site\IndexController@showIndex')->name('show.index');

//LOGIN
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('send.login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//HOME
Route::get('home', 'Site\HomeController@index')->name('home');

//REGISTRO
Route::get('registro', 'Auth\RegisterController@showRegistrationForm')->name('registro.show');
Route::post('registro', 'Auth\RegisterController@register')->name('registro');


//CURSOS
Route::get('cursos', 'Site\CursosController@index')->name('cursos');


//VISTAS ESTATICAS
Route::get('eventos', function() {
	return view('site.eventos');
})->name('eventos');

Route::get('aulas', function() {
	return view('site.aulas');
})->name('aulas');

Route::get('single-aulas', function() {
	return view('site.single-aulas');
})->name('single-aulas');

Route::get('checkout', function() {
	return view('site.checkout');
})->name('checkout');

Route::get('micuenta', function() {
	return view('site.micuenta');
})->name('micuenta');

//Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');
