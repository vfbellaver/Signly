<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Team::class, function (Faker $faker) {
    $name = $faker->company;
    return [
        'name' => $name,
        'email' => $faker->companyEmail,
        'slug' => str_slug($name),

        'address_line1' => $faker->streetAddress,
        'address_line2' => null,
        'city' => $faker->city,
        'zipcode' => $faker->postcode,
        'state' => 'UT',
        'phone1' => $faker->phoneNumber,
        'phone2' => $faker->phoneNumber,
        'fax' => $faker->phoneNumber,
    ];
});
