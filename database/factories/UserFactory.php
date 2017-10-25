<?php

use Faker\Generator as Faker;

$factory->define(App\Models\User::class, function (Faker $faker) {
    static $password;

    $gender = rand(1, 2) > 1 ? 'female' : 'male';

    return [
        'name' => $faker->name($gender),
        'photo_url' => $faker->avatar($gender),
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'team_id' => $faker->numberBetween(2, 6),
        'address' => $faker->address,
        'lat' => $faker->latitude,
        'lng' => $faker->longitude,
        'card_exp_month' => $faker->numberBetween(1,12),
        'card_exp_year' => $faker->numberBetween(2010,2020),
    ];
});
