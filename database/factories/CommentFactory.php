<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Comment::class, function (Faker $faker) {
       return [
           'from_name' => $faker->name,
           'comment' => $faker->text(50),
           'user_id' => function () {
               return factory(App\Models\User::class)->create()->id;
           },
           'team_id' => function () {
               return factory(App\Models\Team::class)->create()->id;
           },
    ];
});
