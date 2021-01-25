<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Models\roles;
use App\Models\sales;
use App\Models\collection;
use App\Models\game_cards;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'token'  => '',
        'role' => $faker->randomElement($array = array ('administrador','profesional', 'particular')),
    ];
});


$factory->state(roles::class, 'admin', function (Faker $faker) {
    return [
        'name' => 'Administrador',
        'description' => 'Rol con acceso total al sistema',
    ];
});

$factory->state(roles::class,'profesional', function (Faker $faker) {
    return [
        'name' => 'Profesional',
        'description' => 'Persona con experiencia en el manejo de las cartas del juego',
    ];
});

$factory->state(roles::class,'neofito', function (Faker $faker) {
    return [
        'name' => 'Particular',
        'description' => 'Persona con poca experiencia en las cartas del juego',
    ];
});

$factory->define(sales::class, function (Faker $faker) {
    return [
        'quantity' => $faker->numberBetween($min = 1, $max = 20),
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 50000),
    ];
});

$factory->define(collection::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'symbol' => $faker->imageUrl($width = 640, $height = 480),
        'edition_date' => $faker->dateTimeInInterval($startDate = 'now', $interval = '+ 60 days', $timezone = null),
    ];
});

$factory->define(game_cards::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'user_id' => $faker->numberBetween($min = 1, $max = 30),
        'sale_id' => $faker->numberBetween($min = 1, $max = 20),
    ];
});