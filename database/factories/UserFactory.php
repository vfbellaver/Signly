<?php

use Faker\Generator as Faker;

$factory->define(App\Models\User::class, function (Faker $faker) {
    static $password;

    $gender = rand(1, 2) > 1 ? 'female' : 'male';
    $email = $faker->unique()->safeEmail;

    $center = ['40.7767168', '-111.9905246'];
    $point = $faker->point($center, 64);

    return [
        'name' => $faker->name($gender),
        'photo_url' => $faker->avatar($gender),
        'email' => $email,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'address' => $faker->address,
        'lat' => $point[0],
        'lng' => $point[1],
    ];
});
