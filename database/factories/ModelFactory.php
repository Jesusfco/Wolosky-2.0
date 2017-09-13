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

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Carbon\Carbon;

$factory->define(Wolosky\User::class, function (Faker\Generator $faker) {
    static $password;

    $strings = array(
        'Masculino',
        'Femenino',
    );
    $key = array_rand($strings);

    $phone = '';

    for($i = 0; $i < 7; $i++) {
        $phone .= mt_rand(0, 9);
    }

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'img' => str_random(5),
        'birthday' => Carbon::create('2000', '01', '01'),
        'gender' => $key,
        'phone' => 961 . $phone,
        'street' => str_random(10),
        'hauseNumber' => mt_rand(0, 1000),
        'city' => 'Tuxtla Gtz',
        'colony' => str_random(8),
        'userTypeId' => mt_rand(1, 2),
    ];
});
