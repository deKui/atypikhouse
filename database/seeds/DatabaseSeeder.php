<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        
        //factory(App\Models\User::class, 5)->create();

        $this->call(TypeHabitatsTableSeeder::class);
        
        $this->call(HabitatsTableSeeder::class);
        
        //factory(App\Models\Habitat::class, 5)->create();
    }
}
