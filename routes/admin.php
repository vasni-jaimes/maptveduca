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


//ADMINISTRADORES
Route::get('agregar-administrador', 'Admin\AministardoresController@create')->name('agregar-administrador.create');


//USUARIOS
Route::get('listado-usuarios', "Admin\UsersController@index")->name('listado-usuarios');

//CURSOS
Route::get('agregar-curso', 'Admin\CoursesController@create')->name('agregar-curso.create');
Route::get('listado-cursos', 'Admin\CoursesController@index')->name('agregar-curso.index');
Route::post('agregar-curso', 'Admin\CoursesController@store')->name('agregar-curso.store');
Route::get('editar-curso/{curso_id}', 'Admin\CoursesController@edit')->name('agregar-curso.edit');
Route::post('editar-curso/{curso_id}', 'Admin\CoursesController@update')->name('actualizar-curso.update');
Route::post('eliminar-archivo', 'Admin\CoursesController@deleteFile')->name('eliminar-archivo.delete');
Route::post('cambiar-status', 'Admin\CoursesController@cambiarStatus')->name('cambiar-status');
Route::post('obtenerSubcategorias', 'Admin\CoursesController@obtenerSubcategorias');


//CLASES EN LINEA
Route::get('agregar-clase', 'Admin\ClasesController@create')->name('agregar-clase.create');
Route::post('agregar-clase', 'Admin\ClasesController@store')->name('agregar-clase.store');
Route::get('listado-clases', 'Admin\ClasesController@index')->name('listado-clases.index');
Route::get('editar-clase/{clase_id}', 'Admin\ClasesController@edit')->name('editar-clase.edit');
Route::post('editar-clase/{clase_id}', 'Admin\ClasesController@update')->name('editar-clase.update');
Route::post('cambiar-status-clase', 'Admin\ClasesController@cambiarStatus')->name('cambiar-status-clase');

//EVENTOS EN LINEA
Route::get('agregar-evento', 'Admin\EventosController@create')->name('agregar-evento.create');
Route::post('agregar-evento', 'Admin\EventosController@store')->name('agregar-evento.store');
Route::get('editar-evento/{evento_id}', 'Admin\EventosController@edit')->name('editar-evento.edit');
Route::get('listado-eventos', 'Admin\EventosController@index')->name('listado-eventos.index');
Route::post('editar-evento/{evento_id}', 'Admin\EventosController@update')->name('editar-evento.update');
Route::post('cambiar-status-evento', 'Admin\EventosController@cambiarStatus')->name('cambiar-status-evento');

//INSTRUCTORES
Route::get('agregar-instructor', 'Admin\InstructoresController@create')->name('agregar-instructor.create');
Route::post('agregar-instructores', 'Admin\InstructoresController@store')->name('agregar-instructor.store');
Route::get('listado-instructores', 'Admin\InstructoresController@index')->name('listado-instructores.index');
Route::get('editar-instructor/{instructor_id}', 'Admin\InstructoresController@edit')->name('editar-instructor.edit');
Route::post('editar-instructor/{instructor_id}', 'Admin\InstructoresController@update')->name('editar-instructor.update');
Route::post('cambiar-status-instructor', 'Admin\InstructoresController@cambiarStatus')->name('cambiar-status-instructor');


//RECOMENDACIONES
Route::get('lista-recomendaciones', 'Admin\RecomendacionesController@index')->name('lista-recomendaciones.index');
Route::get('agregar-recomendaciones/{recom_id}', 'Admin\RecomendacionesController@edit')->name('lista-recomendaciones.edit');
Route::post('editar-recomendaciones/{recom_id}', 'Admin\RecomendacionesController@update')->name('lista-recomendaciones.update');



//MENSAJES
Route::get('agregar-mensaje', 'Admin\MensajesController@mandarMensaje')->name('mandarMensaje');
Route::post('agregar-mensaje', 'Admin\MensajesController@sendMensaje')->name('sendMensaje');
Route::post('buscar-alumnos', 'Admin\MensajesController@searchAlumnos')->name('searchAlumnos');


//AULAS VIRTUALES
Route::get('listado-materias', 'Admin\AulasVirtualesController@index')->name('listado-materias.index');
Route::get('aula-virtual/{slug}', 'Admin\AulasVirtualesController@create')->name('aula-virtual.create');
Route::post('aula-virtual/{curso_id}', 'Admin\AulasVirtualesController@store')->name('aula-virtual.store');
Route::post('aula-virtual-respuesta/{publicacion_id}', 'Admin\AulasVirtualesController@respuestaStore')->name('aula-virtual-respuesta.store');
Route::get('downloadFile/{slug_id}/{publicacion_id}/{positionFile}', 'Admin\AulasVirtualesController@downloadFile')->name('down.publicacion');
Route::get('downloadFileResp/{slug_id}/{publicacion_id}/{respuesta_id}/{positionFile}', 'Admin\AulasVirtualesController@downloadFileResp')->name('down.downloadFileResp');
Route::post('eliminar-publicacion/{publicacion_id}', 'Admin\AulasVirtualesController@eliminarPost')->name('eliminar.publicacion');
Route::post('eliminar-respuesta/{respuesta_id}', 'Admin\AulasVirtualesController@eliminarRespuesta')->name('eliminar.respuesta');
Route::post('actualizar-publicidad/{publicacion_id}', 'Admin\AulasVirtualesController@updatePublicidad')->name('aula-publicidad.update');
Route::post('actualizar-respuesta/{publicacion_id}/{respuesta_id}', 'Admin\AulasVirtualesController@updateRespuesta')->name('aula-respuesta.update');



//CALIFICACIONES
Route::get('calificaciones-alumnos', 'Admin\CalificacionesController@index')->name('calificaciones-alumnos');
Route::get('calificaciones-materias/{alumno_id}', 'Admin\CalificacionesController@getMaterias')->name('calificaciones-materias');
Route::get('calificaciones/{user_id}/{slug_curso}', 'Admin\CalificacionesController@getCalificaciones')->name('calificaciones');
Route::post('calificaciones/{user_id}/{slug_curso}', 'Admin\CalificacionesController@storeCalificaciones')->name('calificaciones.store');


//TEXTO ALTERNATIVO CARRERA
Route::get('textoalternativo-materias', 'Admin\TextoAlternativoCntroller@show')->name('texto-materias');
