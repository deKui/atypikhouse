<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Habitat::class, function (Faker $faker) {
    return [
        'id_proprietaire' => $faker->numberBetween(3, 8),
        'id_type_habitat' => $faker->numberBetween(1, 3),
        'titre' => $faker->sentence(2),
        'description' => $faker->text,
        'adresse' => $faker->streetAddress,
        'code_postal' => $faker->numberBetween(10000, 99999),
        'ville' => $faker->city,
        'nb_lit_simple' => $faker->numberBetween(1, 5),
        'nb_lit_double' => $faker->numberBetween(1, 5),
        'nb_personne_max' => $faker->randomDigitNotNull,
        'date_debut_dispo' => $faker->date,
        'date_fin_dispo' => $faker->date,
        'prix' => $faker->word,
    ];
});
