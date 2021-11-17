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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

//RUTAS PROTEGIDAS
Route::group(['middleware' => ['auth', 'verified']], function() {
    //RUTAS DE VACANTES
    Route::get('/vacantes', 'VacanteController@index')->name('vacantes.index');
    Route::get('/vacantes/create', 'VacanteController@create')->name('vacantes.create');
    Route::post('/vacantes', 'VacanteController@store')->name('vacantes.store');

    //SUBIR IMAGENES
    Route::post('/vacantes/imagen', 'VacanteController@imagen')->name('vacantes.imagen');
    Route::post('/vacantes/borrarimagen', 'VacanteController@borrarimagen')->name('vacantes.borrar');

    //CAMBIAR ESTADO DE LA VACANTE
    Route::post('/vacantes/{vacante}', 'VacanteController@estado')->name('vacantes.estado');
    //NOTIFICACIONES
    Route::get('/notificaciones', 'NotificacionesController')->name('notificaciones');
});

//ENVIAR DATOS PARA UNA VACANTE
Route::get('/candidatos/{id}', 'CandidatoController@index')->name('candidatos.index');
Route::post('/candidatos/store', 'CandidatoController@store')->name('candidatos.store');

//MUESTRA TRABAJOS EN FRONTEND SIN AUTENTICACION
Route::get('vacantes/{vacante}', 'VacanteController@show')->name('vacantes.show');



