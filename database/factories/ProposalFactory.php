<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Proposal::class, function (Faker $faker) {

    $confidences = [25, 50, 75];
    $statuses = ['Active', 'Won', 'Lost'];

    $data = [
        'name' => $faker->company,
        'notes' => $faker->text(),
        'from_date' => \Carbon\Carbon::now()->format('Y-m-d'),
        'to_date' => \Carbon\Carbon::now()->addMonths(3)->format('Y-m-d'),
        'confidence' => $confidences[rand(0, 2)],
        'status' => $statuses[rand(0, 2)],
    ];

    return $data;
});
