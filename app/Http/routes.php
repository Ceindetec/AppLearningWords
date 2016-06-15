<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
 *METODOS GET 
 */

Route::resource('lecciones', 'leccionesController');
Route::resource('leccionesdet', 'leccionesDetController', ['only'=>['store','destroy']]);
Route::post('verificalecciones', 'leccionesController@checkEstadoLeccion')->name('lecciones.verificar');
Route::post('listalecciones', 'leccionesController@cargarLeccionesByDocente')->name('lecciones.cargar');
Route::post('guardarlecciones', 'leccionesController@guardarDetalleLeccion')->name('lecciones.guardardetalle');
Route::post('listacategorias', 'leccionesController@cargarPalabrasBusqueda')->name('lecciones.categorias');

Route::post('detallelecciongrid', 'leccionesDetController@detallelecciongrid')->name('detallelecciongrid');
Route::post('eliminardetlecciongrid', 'leccionesDetController@eliminardetlecciongrid')->name('eliminardetlecciongrid');
Route::post('buscarpalabraleccion', 'leccionesDetController@buscarpalabraleccion')->name('leccionesDet.buscarpalabra');

//nombre, controlador@método->nombreruta
Route::get('registromodulorfid', 'muduloRfidConroller@index')->name('registromodulorfid');
Route::post('gridmodulosRFID', 'muduloRfidConroller@gridmodulosRFID')->name('gridmodulosRFID');
Route::get('editarmodulo', 'muduloRfidConroller@editarmoduloRFID')->name('editarmodulo');
Route::get('registrarmodulo', 'muduloRfidConroller@registrarmoduloRFID')->name('registrarmodulo');
Route::get('/', 'mainController@index');






/*
idiomas
*/

Route::get('espanol', 'idiomaController@espanol')->name('espanol');

Route::get('palabras', 'PalabraController@index');
Route::post('palabras/getpalabras', 'PalabraController@getPalabras')->name('getPalabras');
Route::get('palabras/editarpalabra', 'PalabraController@editarPalabra')->name('editarPalabra');
Route::get('palabras/crear', 'PalabraController@crearPalabra')->name('crearPalabra');
Route::post('palabras/update', 'PalabraController@update')->name('updatePal');


