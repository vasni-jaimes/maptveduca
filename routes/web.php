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


// Route::get('/variables', function() {
// 	return config('mail.mailers.smtp');
// });

//INDEX
Route::get('/', 'Site\IndexController@showIndex')->name('show.index');

//LOGIN
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('send.login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

//LIGA PARA REGALAR 1 SEMESTRE
Route::get('meses-regalo/{token}', 'Site\UsersController@promocionLink')->name('promocionLink');
//Route::get('meses-regalo/1', 'Site\UsersController@mesesRegalo')->name('meses-regalo');


//HOME
Route::get('home', 'Site\HomeController@index')->name('home');

//REGISTRO
Route::get('registro', 'Auth\RegisterController@showRegistrationForm')->name('registro.show');
Route::post('registro', 'Auth\RegisterController@register')->name('registro');


//CURSOS
Route::get('cursos/{origen?}', 'Site\CursosController@index')->name('cursos');
Route::get('single-cursos/{curso_id}/{clase_id?}/{subclase_id?}', 'Site\CursosController@show')->name('single-cursos.show');
Route::get('download/material/{slug_curso}/{slug_sesion}', 'Site\CursosController@download')->name('download.material-curso');

//CLASES
Route::get('clases-linea', 'Site\ClasesController@index')->name('clases-linea.index');
Route::get('single-clase/{clase_id}', 'Site\ClasesController@show')->name('clases-single.show');


//EVENTOS
Route::get('eventos', 'Site\EventosControllers@index')->name('eventos.index');
Route::get('evento/{evento_id}', 'Site\EventosControllers@show')->name('evento.show');


//MEMBRESIAS
Route::get('membresia-basica', 'Site\MembresiasController@indexBasica')->name('membresia-basica');
Route::get('membresia-academica', 'Site\MembresiasController@index')->name('membresias.index');

//NOSOTROS
Route::get('nosotros', 'Site\NosotrosControllers@index')->name('nosotros.index');

//MICUENTA
Route::get('micuenta', 'Site\UsersController@index')->name('micuenta.index');
Route::post('usuario/editar', 'Site\UsersController@editar')->name('usuario.editar');


//CHECKOUT
Route::get('checkout/{slug_membresia}', 'Site\CheckoutController@index')->name('checkout');
Route::get('pago/{slug_membresia}', 'Site\CheckoutController@PayWithPaypal')->name('paago-membresia');
Route::get('pago/{slug_membresia}/status', 'Site\CheckoutController@PaypalStatus')->name('pago-status');
Route::get('gracias', 'Site\CheckoutController@getGracias')->name('gracias');


Route::get('cancelar-subscripcion', 'Site\CheckoutController@cancelarSubscripcionView')->name('cancelar-subscripcionview');
Route::get('cancelar-subscripcion/{id_subscripcion}', 'Site\CheckoutController@cancelarSubscripcion')->name('cancelar-subscripcion');

// PAGO DE EVENTO
Route::get('pago-evento/{evento_id}', 'Site\EventosCheckout@PayWithPaypal')->name('paago-evento');
Route::get('pago-evento/{evento_id}/status', 'Site\EventosCheckout@PaypalStatus')->name('pago-evento-status');
Route::get('pagoevento/{slug_membresia}/status', 'Site\EventosCheckout@PaypalStatus')->name('pagoevento-status');


//FAVORITOS
Route::post('usuario/favorito', 'Site\FavoritosController@create')->name('user.favorito');
Route::post('usuario/eliminarFavoritos', 'Site\FavoritosController@delete')->name('user.favorito-delete');

//TABLERO CURSOS
Route::post('usuario/empezarCurso', 'Site\CursosController@agregarTablero')->name('user.agregarTablero');

//TABLERO EVENTOS
Route::post('usuario/registrarEvento', 'Site\EventosControllers@agregarTablero')->name('user.agregarTableroEvento');

//AULAS VIRTUALES
Route::get('aulas-virtuales', 'Site\AulasVirtualesController@showAulas')->name('aulas-virtuales.show');
Route::get('aula-virtual/{user_id}', 'Site\AulasVirtualesController@showAula')->name('aula-virtual.show');
Route::post('aula-virtual-respuesta/{publicacion_id}', 'Site\AulasVirtualesController@respuestaStore')->name('aula-virtual-web.store');
Route::get('downloadFile/{slug_id}/{publicacion_id}/{respuesta_id}/{positionFile}', 'Site\AulasVirtualesController@downloadFile')->name('down.publicacion.web');

Route::get('downloadFileProfe/{slug_id}/{publicacion_id}/{positionFile}', 'Site\AulasVirtualesController@downloadFileProfe')->name('down.publicacionprofe.web');


Route::post('eliminar-respuesta/{respuesta_id}', 'Site\AulasVirtualesController@eliminarRespuesta')->name('eliminar.resp-web');
Route::post('actualizar-respuesta/{publicacion_id}/{respuesta_id}', 'Site\AulasVirtualesController@updateRespuesta')->name('update.resp-web');
Route::post('eliminar-archivo', 'Site\AulasVirtualesController@eliminarArchivo')->name('eliminarArchivo');


//GUIA DE ESTUDIO
Route::get('guia-estudio', 'Site\GuiaEstudioController@index')->name('guia-estudio');

//MENSAJES
Route::post('ver-mensaje', 'Site\UsersController@verMensaje')->name('verMensaje');
Route::post('ver-notificacion', 'Site\UsersController@verNotificacion')->name('verNotificacion');

//CONTACTO
Route::get('faqs', 'Site\ContactoController@index')->name('faqs');
Route::post('contacto', 'Site\ContactoController@store')->name('contacto.store');


Route::get('bienvenida', function() {
	return view('site.layouts.mails.bienvenida');
});

Route::get('password/email', function() {
	return view('site.recover');
})->name('recover');

Route::get('terminos', function() {
	return view('site.terminos');
})->name('terminos');

Route::get('privacidad', function() {
	return view('site.privacidad');
})->name('privacidad');


//Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');
