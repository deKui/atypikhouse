<?php

use Illuminate\Database\Seeder;
use App\Models\Avis;

class AvisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Avis::create([
            'id_utilisateur' => 3,
            'id_habitat' => 2,
            'note' => 4,
            'comment' => 'Séjour agréable !',
            'signale' => false,
        ]);
    }
}
