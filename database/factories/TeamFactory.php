<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Team::class, function (Faker $faker) {
    static $password;

    $name = $faker->company;
    return [
        'name' => $name,
        'slug' => str_slug($name,'-'),
    ];
});
