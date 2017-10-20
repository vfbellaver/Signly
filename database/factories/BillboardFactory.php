<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Billboard::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'name' => $name,
        'slugname' => str_slug($name,'-'),
        'address' => $faker->address,
        'lat' => $faker->latitude,
        'lng' => $faker->longitude,
        'heading' => 297.55399917596174,
        'pitch' => 14.632095135840359,
        'description' => $faker->text(200),
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
    ];
});
