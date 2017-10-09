<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Client::class, function (Faker $faker) {

    return [
        'company_name' => $faker->company,
        'logo' => $faker->imageUrl(),
        'first_name' => $faker->firstName((rand(1, 2) > 1 ? 'female' : 'male')),
        'last_name' => $faker->lastName,
        'email' => $faker->companyEmail,
        'address_line1' => $faker->streetAddress,
        'address_line2' => null,
        'city' => $faker->city,
        'zipcode' => $faker->postcode,
        'state' => 'UT',
        'phone1' => $faker->phoneNumber,
        'phone2' => $faker->phoneNumber,
        'fax' => $faker->phoneNumber,
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
    ];
});
