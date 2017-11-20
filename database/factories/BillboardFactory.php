<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Billboard::class, function (Faker $faker) {
    $name = $faker->streetName;

    $center = ['40.7767168', '-111.9905246'];
    $point = $faker->point($center, 64);
    return [
        'name' => $name,
        'address' => $faker->address,
        'lat' => $point[0],
        'lng' => $point[1],
        'heading' => 297.55399917596174,
        'pitch' => 14.632095135840359,
    ];
});
