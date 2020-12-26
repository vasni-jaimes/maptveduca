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
Route::get('single-cursos/{curso_id}/{clase_id?}', 'Site\CursosController@show')->name('single-cursos.show');
Route::get('download/material/{slug_curso}/{slug_sesion}', 'Site\CursosController@download')->name('download.material-curso');

//CLASES
Route::get('clases-linea', 'Site\ClasesController@index')->name('clases-linea.index');
Route::get('single-clase/{clase_id}', 'Site\ClasesController@show')->name('clases-single.show');


//EVENTOS
Route::get('eventos', 'Site\EventosControllers@index')->name('eventos.index');
Route::get('evento/{evento_id}', 'Site\EventosControllers@show')->name('evento.show');


//MEMBRESIAS
Route::get('membresias', 'Site\MembresiasController@index')->name('membresias.index');

//NOSOTROS
Route::get('nosotros', 'Site\NosotrosControllers@index')->name('nosotros.index');

//MICUENTA
Route::get('micuenta', 'Site\UsersController@index')->name('micuenta.index');


//CHECKOUT
Route::get('checkout/{slug_membresia}', 'Site\CheckoutController@index')->name('checkout');
Route::get('pago/{slug_membresia}', 'Site\CheckoutController@PayWithPaypal')->name('paago-membresia');
Route::get('pago/{slug_membresia}/status', 'Site\CheckoutController@PaypalStatus')->name('pago-status');


//FAVORITOS
Route::post('usuario/favorito', 'Site\FavoritosController@create')->name('user.favorito');





//VISTAS ESTATICAS
// Route::get('eventos', function() {
// 	return view('site.eventos');
// })->name('eventos');

Route::get('aulas', function() {
	return view('site.aulas');
})->name('aulas');

Route::get('single-aulas', function() {
	return view('site.single-aulas');
})->name('single-aulas');

// Route::get('checkout', function() {
// 	return view('site.checkout');
// })->name('checkout');

// Route::get('micuenta', function() {
// 	return view('site.micuenta');
// })->name('micuenta');

//new
// Route::get('clases-linea', function() {
// 	return view('site.clases-linea');
// })->name('clases-linea');

//
// Route::get('clases-sessiones', function() {
// 	return view('site.clases-sessiones');
// })->name('clases-sessiones');

// Route::get('single-clases', function() {
// 	return view('site.single-clases');
// })->name('single-clases');

Route::get('evento-archivado', function() {
	return view('site.evento-archivado');
})->name('evento-archivado');

Route::get('membresia-basica', function() {
	return view('site.membresia-basica');
})->name('membresia-basica');

// Route::get('membresia', function() {
// 	return view('site.membresia');
// })->name('membresia');


// Route::get('single-eventos', function() {
// 	return view('site.single-eventos');
// })->name('single-eventos');


// Route::get('single-cursos', function() {
// 	return view('site.single-cursos');
// })->name('single-cursos');



Route::get('guia-estudio', function() {
	return view('site.guia-estudio');
})->name('guia-estudio');

Route::get('faqs', function() {
	return view('site.faqs');
})->name('faqs');

// Route::get('nosotros', function() {
// 	return view('site.nosotros');
// })->name('nosotros');




//Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');
