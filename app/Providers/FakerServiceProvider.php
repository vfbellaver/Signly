<?php

namespace App\Providers;

use Carbon\Carbon;
use Exception;
use Faker\Factory;
use Faker\Provider\Base;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Storage;
use Stripe\Customer;
use Stripe\Plan;
use Stripe\Stripe;
use Stripe\Subscription;
use Stripe\Token;

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

                public function billboardImage($number = null)
                {
                    if (!$number) {
                        $number = rand(0, 128);
                    }

                    $path = "seeder/billboard-images.json";
                    if (!Storage::exists($path)) {
                        Storage::put($path, json_encode(['start' => 1, 'images' => []]));
                    }
                    $imageStore = json_decode(Storage::get($path), true);

                    if (isset($imageStore['images'][$number])) {
                        return $imageStore['images'][$number];
                    }

                    $base = "https://content.googleapis.com/customsearch/v1?cx=000522129486115398846%3Adib_wpp-abg&imgSize=large&imgType=photo&num=10&q=billboard%20ad&searchType=image&alt=json&key=AIzaSyDgQtGBUTxET7N5WSvenbLkaGlwc-hUmTo";
                    $start = $imageStore['start'];

                    $client = new Client();
                    do {
                        $uri = "{$base}&start={$start}";
                        try {
                            $response = $client->get($uri);
                            $body = (string)$response->getBody();
                            $result = json_decode($body, true);
                            foreach ($result['items'] as $item) {
                                $imageStore['images'][] = $item['link'];
                            }

                            $start += 10;
                            $imageStore['start'] = $start;
                        } catch (Exception $e) {
                            break;
                        }
                    } while (count($imageStore['images']) < $number);

                    Storage::put($path, json_encode($imageStore));

                    if (isset($imageStore['images'][$number])) {
                        return $imageStore['images'][$number];
                    }

                    return array_pop($imageStore['images']);
                }
            };

            $faker->addProvider($newClass);
            return $faker;
        });
    }
}
