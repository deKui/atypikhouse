<?php

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('recherche', 'RechercheController@index')->name('recherche');

Route::get('habitat/{id}', 'HabitatController@show')->name('habitat.show');

Route::get('habitat', 'HabitatController@index')->name('habitat.index');

Route::middleware('auth')->group(function () {

	Route::get('profil/{id}', 'UserController@index')->name('profil.index');

	Route::get('profil/{id}/edit', 'UserController@edit')->name('profil.edit');

	Route::resource('profil', 'UserController', [
        'only' => ['update'],
    ]);
	
	Route::get('reservation/{id}','ReservationController@index')->name('reservation.index');

	Route::get('habitat/{id_proprietaire}','HabitatController@showAllProprietaire')->name('habitat.showAllProprietaire');


});
