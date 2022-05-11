<?php

use App\Http\Controllers\EventoController;
use Illuminate\Support\Facades\Auth;
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
    return view('inicio');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/eventos', 'EventoController@index' )->name('eventos.index');
Route::get('/eventos/nuevo', 'EventoController@create' )->name('eventos.create');
Route::post('/eventos', 'EventoController@store' )->name('eventos.store');
Route::get('/eventos/{evento}', 'EventoController@show' )->name('eventos.show');
Route::get('/eventos/{evento}/edit', 'EventoController@edit' )->name('eventos.edit');
Route::put('/eventos/{evento}', 'EventoController@update' )->name('eventos.update');
Route::delete('/eventos/{evento}', 'EventoController@destroy' )->name('eventos.destroy');




Route::get('/registro/{evento}', 'RegistroController@index' )->name('registro.listado');
Route::post('/registro/{evento}', 'RegistroController@store' )->name('eventos.registro');
Route::delete('/registro/{registro}', 'RegistroController@destroy' )->name('registro.destroy');


Route::get('/ingreso/{token}', 'IngresoController@ingreso')->name('ingreso');
Route::get('/ingreso/estado/{evento}', 'IngresoController@show')->name('ingreso.estado');

