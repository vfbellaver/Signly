<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Billboard::class, function (Faker $faker) {

    $isIlluminated = (rand(1, 10) > 4);

    return [
        'code' => strtoupper(str_random(6)),
        'height' => $faker->address,
        'width' => $faker->latitude,
        'reads' => $faker->longitude,
        'label' => $faker->word,
        'hard_cost' => $faker->text(200),
        'monthly_impressions' => $faker->text(200),
        'notes' => $faker->text(200),
        'max_ads' => rand(2, 10),
        'duration' => rand(10, 20),
        'photo' => '',
        'is_illuminated' => $isIlluminated,
        'lights_on' => $isIlluminated ? $faker->time() : null,
        'lights_off' => $isIlluminated ? $faker->time() : null,
        'billboard_id' => function () {
            return factory(App\Models\Billboard::class)->create()->id;
        },
    ];
});
