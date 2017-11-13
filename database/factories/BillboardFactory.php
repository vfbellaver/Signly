<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Billboard::class, function (Faker $faker) {
    $name = $faker->streetName;
    return [
        'name' => $name,
        'address' => $faker->address,
        'lat' => $faker->latitude,
        'lng' => $faker->longitude,
        'heading' => 297.55399917596174,
        'pitch' => 14.632095135840359,
    ];
});
