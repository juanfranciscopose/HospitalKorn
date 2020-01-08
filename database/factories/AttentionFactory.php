<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Attention::class, function (Faker $faker) {
    return [
        'date' => date("Y-m-d"),
        'patient_id' => $faker->numberBetween(1, 100),
        'diagnostic' => $faker->text(20),
        'internment' => $faker->numberBetween(0,1),
        'accompaniment' => $faker->randomElement(['Familiar cercano', 'Hermanos e hijos', 'Pareja', 'Referentes vinculares', 'Policía', 'SAME', 'Por sus propios medios']),
        'reason' => $faker->randomElement(['Receta médica', 'Control de guardia', 'Consulta', 'Intento de suicidio', 'Interconsulta', 'Otras']),
        'pharmacotherapy' => $faker->randomElement(['Mañana', 'Tarde', 'Noche']),
        'articulation' => $faker->text(20),
        'observation'=> $faker->text(20),
        'derivation'=> $faker->numberBetween(1, 3),
    ];
});
