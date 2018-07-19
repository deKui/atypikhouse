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
        	'name' => 'lucas',
        	'email' => 'lucas@test.fr',
        	'password' => bcrypt('scribe'),
        ]);

        User::create([
            'name' => 'celia',
            'email' => 'celia@test.fr',
            'password' => bcrypt('scribe'),
        ]);
    }
}
