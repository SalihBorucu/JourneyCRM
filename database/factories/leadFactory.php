<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\lead;
use Faker\Generator as Faker;

$factory->define(App\lead::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'country' => $faker->country,
        'phoneNumber' => $faker->e164PhoneNumber,
        'created_date' => $faker->date($format = 'Y-m-d', $max = 'now'),

    ];
});
