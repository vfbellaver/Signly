<?php

namespace App\Providers;

use Faker\Factory;
use Faker\Provider\Base;
use Illuminate\Support\ServiceProvider;

class FakerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->singleton('Faker\Generator', function ($app) {
            $faker = Factory::create();
            $newClass = new class($faker) extends Base
            {
                public function avatar($gender = null)
                {
                    if (!$gender) {
                        $gender = rand(1, 2) > 1 ? 'female' : 'male';
                    }

                    $photoIndex = rand(1, 99);
                    $photoUri = [
                        'male' => 'men',
                        'female' => 'women',
                    ];

                    $photoUrl = "https://randomuser.me/api/portraits/{$photoUri[$gender]}/{$photoIndex}.jpg";

                    return $photoUrl;
                }
            };

            $faker->addProvider($newClass);
            return $faker;
        });
    }
}
