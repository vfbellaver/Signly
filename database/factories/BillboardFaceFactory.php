<?php

use Faker\Generator as Faker;

$factory->define(App\Models\BillboardFace::class, function (Faker $faker) {

    $isIlluminated = (rand(1, 10) > 4);
    return [
        'code' => strtoupper(str_random(6)),
        'height' => 100,
        'width' => 200,
        'reads' => rand(1000, 2000),
        'label' => $faker->word,
        'hard_cost' => 25.00,
        'monthly_impressions' => rand(1000, 2000),
        'notes' => $faker->text(200),
        'max_ads' => rand(2, 10),
        'duration' => rand(10, 20),
        'photo' => $faker->imageUrl(),
        'is_illuminated' => $isIlluminated,
        'lights_on' => $isIlluminated ? $faker->time() : null,
        'lights_off' => $isIlluminated ? $faker->time() : null,
        'billboard_id' => function () {
            return factory(App\Models\Billboard::class)->create()->id;
        },
    ];
});
