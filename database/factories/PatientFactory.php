<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Patient::class, function (Faker $faker) {
    $party_town = $faker->numberBetween(1, 12);
    return [
        'clinical_history_number' => $faker->unique()->numberBetween(1, 500),
        'name' => $faker->firstName,
        'surname' => $faker->lastName ,
        'birthdate' => date('Y-m-d'),
        'party' => $party_town,
        'town' => $party_town,
        'address' => $faker->address,
        'gender' => $faker->randomElement(['MASCULINO', 'FEMENINO', 'TRANS', 'OTROS']),
        'document_type' => $faker->numberBetween(1, 5),
        'document_number' => $faker->unique()->numberBetween(10000000, 50000000),
        'folder_number' => $faker->numberBetween(1000, 50000),
        'telephone' => $faker->phoneNumber,
        'social_work' => $faker->numberBetween(1, 21)
    ];
});
