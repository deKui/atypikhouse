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
        	'id_proprietaire' => 1,
            'id_type_habitat' => 1,
            'titre' => 'Cabane en bois',
            'description' => 'Ceci est une belle cabane',
            'photo' => 'cabane.jpg',
            'adresse' => '5 rue de toulouse',
            'code_postal' => 31000,
            'ville' => 'Toulouse',
            'nb_lit_simple' => 1,
            'nb_lit_double' => 2,
            'nb_personne_max' => 5,
            'date_debut_dispo' => '2018-06-29',
            'date_fin_dispo' => '2018-07-29',
            'prix' => 20,
         ]);
    }
}
