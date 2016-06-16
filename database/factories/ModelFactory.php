<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(LearningWords\User::class, function (Faker\Generator $faker) {
    return [
    	'nombres' => $faker->name,
        'apellidos' => $faker->lastName,
        'documento' => '86071518',
        'password' => 'Secreto',
        'remember_token' => str_random(10),
        'rol' => $faker->randomElement(['docente', 'estudiante']),
        'institucion_id' => 1
    ];
});

$factory->define(LearningWords\institucion::class, function (Faker\Generator $faker) {
    return [
        'nombre' => 'Ceindetec',
        'nit' => '123456789',
        'cantidad_licencias' => 100
    ];
});
