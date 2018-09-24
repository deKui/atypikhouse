<?php

use Illuminate\Database\Seeder;
use App\Models\Habitat;

class HabitatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Habitat::create([
        	'id_proprietaire' => 4,
            'id_type_habitat' => 1,
            'titre' => 'Séjour dans une cabane dans les arbres',
            'description' => 'Belle cabane, avec une vue panoramique !',
            'photo' => 'cabane.jpg',
            'adresse' => 'Coline nord',
            'code_postal' => 11000,
            'ville' => 'Carcassonne',
            'nb_lit_simple' => 0,
            'nb_lit_double' => 1,
            'nb_personne_max' => 2,
            'date_debut_dispo' => '2018-09-24',
            'date_fin_dispo' => '2018-10-07',
            'prix' => 90,
         ]);

        Habitat::create([
            'id_proprietaire' => 5,
            'id_type_habitat' => 2,
            'titre' => 'Séjour dans une yourte',
            'description' => 'Yourte agréable et trés bien situé au coeur de la france ',
            'photo' => 'yourte.jpg',
            'adresse' => 'cote haute',
            'code_postal' => 19000,
            'ville' => 'Tulle',
            'nb_lit_simple' => 2,
            'nb_lit_double' => 1,
            'nb_personne_max' => 4,
            'date_debut_dispo' => '2018-09-10',
            'date_fin_dispo' => '2018-10-14',
            'prix' => 100,
         ]);

        Habitat::create([
            'id_proprietaire' => 6,
            'id_type_habitat' => 3,
            'titre' => 'Roulotte à la campagne',
            'description' => 'Petite roulotte pour vacances en famille, avec tout le confort!',
            'photo' => 'roulotte.jpg',
            'adresse' => 'Champs gris',
            'code_postal' => 81100,
            'ville' => 'Castres',
            'nb_lit_simple' => 3,
            'nb_lit_double' => 1,
            'nb_personne_max' => 5,
            'date_debut_dispo' => '2018-09-17',
            'date_fin_dispo' => '2018-09-30',
            'prix' => 80,
         ]);

        Habitat::create([
            'id_proprietaire' => 7,
            'id_type_habitat' => 4,
            'titre' => 'Bulle',
            'description' => 'Lieu de détente, relaxation, venez vous endormir en observant les étoiles.',
            'photo' => 'bulle.jpg',
            'adresse' => 'Foret des pins',
            'code_postal' => 82200,
            'ville' => 'Labarthe',
            'nb_lit_simple' => 0,
            'nb_lit_double' => 1,
            'nb_personne_max' => 2,
            'date_debut_dispo' => '2018-09-03',
            'date_fin_dispo' => '2018-09-30',
            'prix' => 130,
         ]);

        Habitat::create([
            'id_proprietaire' => 8,
            'id_type_habitat' => 5,
            'titre' => 'Séjour insolite dans un tipi',
            'description' => 'Tipi agréable, un plus : petit déjeuné offert.',
            'photo' => 'tipi.jpg',
            'adresse' => 'Las montas',
            'code_postal' => 31250,
            'ville' => 'Revel',
            'nb_lit_simple' => 4,
            'nb_lit_double' => 0,
            'nb_personne_max' => 4,
            'date_debut_dispo' => '2018-09-03',
            'date_fin_dispo' => '2018-11-30',
            'prix' => 60,
         ]);
    }
}
