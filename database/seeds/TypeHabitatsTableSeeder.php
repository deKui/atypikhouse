<?php

use Illuminate\Database\Seeder;
use App\Models\TypeHabitats;

class TypeHabitatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeHabitats::create([
        	'nom' => 'Cabane',
        	'slug' => 'cabane',
        ]);

        TypeHabitats::create([
        	'nom' => 'Yourte',
        	'slug' => 'yourte',
        ]);

        TypeHabitats::create([
        	'nom' => 'Roulotte',
        	'slug' => 'roulotte',
        ]);

        TypeHabitats::create([
            'nom' => 'Bulle',
            'slug' => 'bulle',
        ]);

        TypeHabitats::create([
            'nom' => 'Tipi',
            'slug' => 'tipi',
        ]);
    }
}
