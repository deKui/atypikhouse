<?php

use Illuminate\Database\Seeder;
use App\Models\Reservation;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //        
        Reservation::create([
        	'id_locataire' => 2,
            'id_proprietaire' => 4,
            'id_habitat'=> 1,
            'date_debut' => '2018-09-24',
            'date_fin' => '2018-10-26',
            'montant' => 180,
            'statut' => 'accepted',
         ]);

         Reservation::create([
        	'id_locataire' => 3,
            'id_proprietaire' => 5,
            'id_habitat'=> 2,
            'date_debut' => '2018-09-12',
            'date_fin' => '2018-09-13',
            'montant' => 100,
            'statut' => 'accepted',
         ]);

         Reservation::create([
        	'id_locataire' => 2,
            'id_proprietaire' => 6,
            'id_habitat'=> 3,
            'date_debut' => '2018-09-24',
            'date_fin' => '2018-09-28',
            'montant' => 320,
            'statut' => 'accepted',
         ]);

        Reservation::create([
        	'id_locataire' => 3,
            'id_proprietaire' => 7,
            'id_habitat'=> 4,
            'date_debut' => '2018-09-24',
            'date_fin' => '2018-09-28',
            'montant' => 320,
            'statut' => 'accepted',
         ]);
    }
}
