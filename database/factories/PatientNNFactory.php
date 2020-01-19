<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\PatientNN::class, function (Faker $faker) {
    return [
        'clinical_history_number' => $faker->unique()->numberBetween(501, 511),
        'created' => date('Y-m-d'),
    ];
});
