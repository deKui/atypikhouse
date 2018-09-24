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

// CGU
Route::get('cgu', 'AtypikController@showcgu')->name('cgu');

// CGV
Route::get('cgv', 'AtypikController@showcgv')->name('cgv');

// Mention légales
Route::get('legal', 'AtypikController@showlegal')->name('legal');


// Contact
Route::get('contact', 'AtypikController@showcontact')->name('contact');

// En savoir plus sur nous
Route::get('about', 'AtypikController@showabout')->name('about');

// Devenir hôte
Route::get('behost', 'AtypikController@showbehost')->name('behost');

// Résultat d'une recherche
Route::get('recherche', 'RechercheController@index')->name('recherche');

// Affiche un habitat
Route::get('habitats/{habitat}', 'HabitatController@show')->name('habitat.show');

// Affiche un habitat après une recherche
Route::get('habitats/show/{habitat}/{nbpersonne}/{date_debut}/{date_fin}/{duree}', 'HabitatController@showAfterSearch')->name('habitat.showAfterSearch');

// Affiche tous les habitats
Route::get('habitats', 'HabitatController@index')->name('habitat.index');

// Affiche les dernières trouvailles
Route::get('showLastHabitats', 'HabitatController@showLastHabitats')->name('showLastHabitats');

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

    // Accès à la page du gérant
    Route::get('gerant', 'UserController@showInfoGerant')->name('profil.gerant');

    // Mise à jour utilisateur active/ désactive
    Route::get('gerant/{id_utilisateur}', 'UserController@updateActiveDesactiveUser')->name('profil.gerantActiveDesactive');

    // Supprime avis
    Route::get('gerant/avis/{id}', 'AvisController@deleteAvis')->name('profil.gerantAvis');

    // MAj avis
    Route::get('profil/avisSignale/{id}', 'AvisController@signaleAvis')->name('profil.signaleAvis');

    // MAj utilisateur signale
    Route::get('profil/utilSignale/{id}', 'UserController@updateSignale')->name('profil.signaleUtil');

    // Affichage du plannig

    Route::get('planning', 'PlanningController@index')->name('planning.index');

    // Affichage de la page proprio
    Route::get('proprio/{id_utilisateur}', 'HabitatController@showHabitatProprio')->name('profil.proprio');

    // Supprime habitat
    Route::get('proprio/habitat/{id}', 'HabitatController@delete')->name('habitat.delete');

    // Edit habitat
    Route::get('proprio/habitatEdit/{id}', 'HabitatController@edit')->name('habitat.edit');

  // Update habitat
    Route::put('proprio/habitatUpdate/{id}', 'HabitatController@update')->name('habitat.update');

    Route::get('planning/{month}/{year}', 'PlanningController@index')->name('planning.index');

    // Mise à jour reservations
    Route::get('proprio/reservation/{id}', 'ReservationController@reservAccepterRefuser')->name('proprio.reservAccepterRefuser');

});
