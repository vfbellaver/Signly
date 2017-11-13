<?php

use App\Models\BillboardFace;
use Faker\Generator as Faker;

$factory->define(App\Models\BillboardFace::class, function (Faker $faker) {

    $type = rand(1, 10) > 3 ? BillboardFace::TYPE_STATIC : BillboardFace::TYPE_DIGITAL;
    $reads = [BillboardFace::READS_ACROSS, BillboardFace::READS_LEFT, BillboardFace::READS_RIGHT];

    $isIlluminated = (rand(1, 10) > 4) && $type == BillboardFace::TYPE_STATIC;

    $labels = ['South', 'East', 'West', 'North'];

    $code = strtoupper(str_random(6));

    return [
        'code' => $code,
        'height' => 14,
        'width' => 48,
        'reads' => $reads[rand(0, 2)],
        'label' => $labels[rand(0, 3)],
        'slug' => str_slug($code),
        'rate_card' => rand(500, 2000),
        'monthly_impressions' => rand(1000, 2000),
        'notes' => $faker->text(200),
        'type' => $type,
        'photo_url' => $faker->billboardImage(),

        'max_ads' => $type == BillboardFace::TYPE_DIGITAL ? rand(2, 4) : null,
        'duration' => $type == BillboardFace::TYPE_DIGITAL ? rand(8, 12) : null,

        'is_illuminated' => $type == BillboardFace::TYPE_STATIC ? $isIlluminated : null,
        'lights_on' => $isIlluminated ? $faker->time() : null,
        'lights_off' => $isIlluminated ? $faker->time() : null,
    ];
});
