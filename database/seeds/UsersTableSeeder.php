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
        User::create([
            'pseudo' => 'rEo',
        	'prenom' => 'lucas',
        	'email' => 'lucas@test.fr',
            'password' => bcrypt('scribe'),
        	'date_naissance' => '1994-08-18',
        ]);

        User::create([
            'pseudo' => 'sister',
            'prenom' => 'celia',
            'email' => 'celia@test.fr',
            'password' => bcrypt('celia'),
            'date_naissance' => '1998-05-28',
        ]);
    }
}
