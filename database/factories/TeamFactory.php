<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Team::class, function (Faker $faker) {
    static $password;

    $name = $faker->company;
    return [
        'name' => $name,
        'email' => $faker->companyEmail,
        'phone' => $faker->tollFreePhoneNumber,
        'fax' => $faker->tollFreePhoneNumber,
        'slug' => str_slug($name,'-'),
        'address' => $faker->streetAddress,
    ];
});
