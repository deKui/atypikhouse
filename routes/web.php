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

// Route pour l'authentification
Auth::routes();

// Page d'accueil
Route::get('/', 'HomeController@index')->name('home');

Route::get('cgu', 'AtypikController@showcgu')->name('cgu');

Route::get('cgv', 'AtypikController@showcgv')->name('cgv');

Route::get('legal', 'AtypikController@showlegal')->name('legal');

Route::get('help', 'AtypikController@showhelp')->name('help');

Route::get('about', 'AtypikController@showabout')->name('about');

// Résultat d'une recherche
Route::get('recherche', 'RechercheController@index')->name('recherche');

// Affiche un habitat
Route::get('habitats/{habitat}', 'HabitatController@show')->name('habitat.show');

// Affiche tous les habitats
Route::get('habitats', 'HabitatController@index')->name('habitat.index');

// Accessible uniquement aux users connectés
Route::middleware('auth')->group(function () {

	// Ajoute un habitat
	Route::post('habitats/{habitat}', 'AvisController@store');

	// Page profil
	Route::get('profil/{id}', 'UserController@index')->name('profil.index');

	// Page pour modifier son profil
	Route::get('profil/{id}/edit', 'UserController@edit')->name('profil.edit');

	// Page profil public
	Route::get('profil/public/{user}', 'UserController@show')->name('profil.show');

	// Page noter un utilisateur
	Route::get('profil/noter/{user}', 'UserController@noter')->name('profil.noter');

	// Ajoute une note
	Route::post('profil/eval/{user}', 'UserController@eval')->name('profil.eval');

	// Update les infos du profil
	Route::resource('profil', 'UserController', [
        'only' => ['update'],
    ]);

    // Réserver un habitat
	Route::post('reserver/{habitat}','ReservationController@create')->name('reservation.create');
	
	// Affiche une réservation via son id ?
	Route::get('reservation/{id}','ReservationController@index')->name('reservation.index');

	// Affiche les réservation de l'utilisateur
	Route::get('reservation/{id_utilisateur}','ReservationController@show')->name('reservation.show');
	
	//Route::get('habitat/{id_proprietaire}','HabitatController@showAllProprietaire')->name('habitat.showAllProprietaire');

	// Formulaire pour ajouter un habitat
    Route::get('habitat/create', 'HabitatController@create')->name('habitat.create');

    // Ajoute un habitat
    Route::post('habitat/store', 'HabitatController@store')->name('habitat.store');
});
