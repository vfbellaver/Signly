<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Message::class, function (Faker $faker) {
       return [
           'subject' => $faker->text(50),
           'message' => $faker->text(200),
           'user_id' => function () {
               return factory(App\Models\User::class)->create()->id;
           },
    ];
});
