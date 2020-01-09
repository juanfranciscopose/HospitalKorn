<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Institution::class, function (Faker $faker) {
    return [
        'name' => $faker->text(20),
        'director' => $faker->name,
        'telephone' => $faker->phoneNumber,
        'address' => $faker->address,
        'sanitary_region_id' => $faker->numberBetween(1, 12)
    ];
});
