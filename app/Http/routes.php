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

Route::get('registromodulorfid', 'muduloRfidConroller@index')->name('registromodulorfid');
Route::post('gridmodulosRFID', 'muduloRfidConroller@gridmodulosRFID')->name('gridmodulosRFID');
Route::get('editarmodulo', 'muduloRfidConroller@editarmoduloRFID')->name('editarmodulo');
Route::get('registrarmodulo', 'muduloRfidConroller@registrarmoduloRFID')->name('registrarmodulo');
//Route::get('/', 'mainController@index');






/*
idiomas
*/

Route::get('espanol', 'idiomaController@espanol')->name('espanol');