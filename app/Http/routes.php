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
Route::get('home', [
	'uses'=>'homeController@index',
	'as'=>'home'
	]);

Route::get('/', 'homeController@index');
//Route::resource('actividadesRepaso', 'actividadesRepasoController');

/*************** Routes funcionalidad actividades de repaso *************************************************/
Route::group(['middleware' => ['is_estudiante']], function() {

	Route::get('actividadesRepaso', 'actividadesRepasoController@index')->name('actividadesRepaso.index');

	Route::get('actividaduno/{idleccion}', 'actividadUnoController@index')->name('actividaduno.index');
	Route::get('actividaddos/{idleccion}', 'actividadDosController@index')->name('actividaddos.index');
	Route::get('actividadtres/{idleccion}', 'actividadTresController@index')->name('actividadtres.index');
});
/***********************************************************************************************************/

/*************** Routes funcionalidad lecciones de repaso **************************************************/
Route::group(['middleware'=>['is_docente']], function(){
	Route::resource('lecciones', 'leccionesController');
	Route::resource('leccionesdet', 'leccionesDetController', ['only'=>['store','destroy']]);

	Route::post('verificalecciones', 'leccionesController@checkEstadoLeccion')->name('lecciones.verificar');
	Route::post('listalecciones', 'leccionesController@cargarLeccionesByDocente')->name('lecciones.cargar');
	Route::post('guardarlecciones', 'leccionesController@guardarDetalleLeccion')->name('lecciones.guardardetalle');
	Route::post('listacategorias', 'leccionesController@cargarPalabrasBusqueda')->name('lecciones.categorias');
	Route::post('detallelecciongrid', 'leccionesDetController@detallelecciongrid')->name('detallelecciongrid');
	Route::post('eliminardetlecciongrid', 'leccionesDetController@eliminardetlecciongrid')->name('eliminardetlecciongrid');
	Route::post('buscarpalabraleccion', 'leccionesDetController@buscarpalabraleccion')->name('leccionesDet.buscarpalabra');

	/*
	Palabras
	*/
	Route::get('palabras', 'PalabraController@index');
	Route::post('palabras/getpalabras', 'PalabraController@getPalabras')->name('getPalabras');
	Route::get('palabras/crear', 'PalabraController@ModalcrearPalabra')->name('crearPalabra');
	Route::post('palabras/insert', 'PalabraController@insertarPalabra')->name('insertPalabra');
	Route::get('palabras/editarpalabra', 'PalabraController@ModaleditarPalabra')->name('editarPalabra');
	Route::post('palabras/update', 'PalabraController@update')->name('updatePal');
	Route::post('palabras/borrar', 'PalabraController@destroy')->name('deletePal');

	/*
	 * Categorias
	*/
	Route::post('categoria/insert', 'PalabraController@insertCategoria')->name('insertCategoria');

	/*
	 * Control de Avances
	*/
	Route::get('progresos/{id}', 'avancesController@index');
	Route::get('avances/getlista/{id}', 'avancesController@getAvances')->name('getAvances');
});
/***********************************************************************************************************/


Route::get('registromodulorfid', 'muduloRfidConroller@index')->name('registromodulorfid');
Route::post('gridmodulosRFID', 'muduloRfidConroller@gridmodulosRFID')->name('gridmodulosRFID');
Route::get('editarmodulo', 'muduloRfidConroller@editarmoduloRFID')->name('editarmodulo');
Route::get('registrarmodulo', 'muduloRfidConroller@registrarmoduloRFID')->name('registrarmodulo');
Route::get('/', 'mainController@index');

Route::get('login', 'Auth\AuthController@getLogin')->name('login');
Route::post('login', 'Auth\AuthController@postLogin')->name('login');
Route::get('logout', 'Auth\AuthController@getLogout')->name('logout');

// Registration routes...
Route::get('register', 'Auth\AuthController@getRegister')->name('register');
Route::post('register', 'Auth\AuthController@postRegister')->name('register');

Route::group(['middleware' => ['is_admin']], function(){
	Route::get('administracion', [
	'uses'=>'homeController@administracion',
	'as'=>'administracion.index'
	]);
	Route::resource('usuarios', 'Admin\usuariosController', ['except' => ['destroy']]);
	Route::get('usuarios/delete/{id}', 'Admin\usuariosController@destroy')->name('usuarios.destroy');

	Route::group(['middleware' => ['is_super']], function(){
		Route::resource('instituciones', 'Admin\institucionController', ['except' => ['destroy']]);
		Route::get('instituciones/delete/{id}', 'Admin\institucionController@destroy')->name('instituciones.destroy');
	});
});



/*
idiomas
*/

Route::get('espanol', 'idiomaController@espanol')->name('espanol');







