<?php

use Faker\Generator as Faker;

$factory->define(App\Models\User::class, function (Faker $faker) {
    static $password;

    $gender = rand(1, 2) > 1 ? 'female' : 'male';
    $email = $faker->unique()->safeEmail;

    return [
        'name' => $faker->name($gender),
        'photo_url' => $faker->avatar($gender),
        'email' => $email,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'address' => $faker->address,
        'lat' => $faker->latitude,
        'lng' => $faker->longitude,
    ];
});
