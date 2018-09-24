<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Gérant
        User::create([
            'pseudo' => 'atypik-house',
            'prenom' => 'Gérant',
            'email' => 'gerant@atypikhouse.com',
            'password' => bcrypt('atypik'),
            'date_naissance' => '2017-07-01',
            'role' => 'gerant',
        ]);

        // Utilisateurs profite
        User::create([
            'pseudo' => 'camill3',
        	'prenom' => 'Camille',
        	'email' => 'Camille_paris@gmail.com',
            'password' => bcrypt('camille'),
        	'date_naissance' => '1986-08-18',
        ]);

        User::create([
            'pseudo' => 'John',
            'prenom' => 'Jonathan',
            'email' => 'Jonathan_lyon@gmail.com',
            'password' => bcrypt('jonathan'),
            'date_naissance' => '1980-05-28',
        ]);

        // Utilisateurs proprio
        User::create([
            'pseudo' => 'MarionC',
            'prenom' => 'Marion',
            'email' => 'marionC@gmail.com',
            'password' => bcrypt('marion'),
            'date_naissance' => '1992-08-28',
        ]);

        User::create([
            'pseudo' => 'LucasS',
            'prenom' => 'Lucas',
            'email' => 'lucasS@gmail.com',
            'password' => bcrypt('lucas'),
            'date_naissance' => '1994-08-18',
        ]);

        User::create([
            'pseudo' => 'ValC',
            'prenom' => 'Valériane',
            'email' => 'valerianeC@gmail.com',
            'password' => bcrypt('valeriane'),
            'date_naissance' => '1993-11-04',
        ]);

        User::create([
            'pseudo' => 'CeliaS',
            'prenom' => 'Célia',
            'email' => 'celiaS@gmail.com',
            'password' => bcrypt('celia'),
            'date_naissance' => '1998-05-28',
        ]);

        User::create([
            'pseudo' => 'MarieC',
            'prenom' => 'Marie',
            'email' => 'marieC@gmail.com',
            'password' => bcrypt('marie'),
            'date_naissance' => '1997-10-16',
        ]);

        User::create([
            'pseudo' => 'JulieC',
            'prenom' => 'Julie',
            'email' => 'julieC@gmail.com',
            'password' => bcrypt('julie'),
            'date_naissance' => '1997-10-16',
        ]);

    }
}
