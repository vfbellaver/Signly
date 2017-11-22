<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Team::class, function (Faker $faker) {
    $name = $faker->company;
    return [
        'name' => $name,
        'email' => $faker->companyEmail,
        'slug' => str_slug($name),
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'zipcode' => $faker->postcode,
        'state' => 'UT',
        'phone' => $faker->phoneNumber,
        'fax' => $faker->phoneNumber,
    ];
});
