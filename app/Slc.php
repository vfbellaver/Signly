<?php

namespace App;

class Slc
{
    public static function scriptVariables()
    {
        $user = self::getCurrentUser();
        if (!$user['lat'] || !$user['lng']) {
            $user['lat'] = 37;
            $user['lng'] = -104;
            $user['zoom'] = 4;
        } else {
            $user['zoom'] = 7;
        }

        return [
            'user' => $user,
            'csrfToken' => csrf_token(),
            'stripeKey' => env('STRIPE_KEY'),
            'pusher' => env('PUSHER_APP_KEY'),
            'plans' => [
                [
                    'id' => 'plan1',
                    'name' => 'Plan 1',
                    'interval' => 'Monthly',
                    'trial_days' => 30,
                    'price' => 10,
                    'features' => [
                        'Feature 1',
                        'Feature 2',
                        'Feature 3',
                    ]
                ],
                [
                    'id' => 'plan2',
                    'name' => 'Plan 2',
                    'interval' => 'Monthly',
                    'trial_days' => 30,
                    'price' => 20,
                    'features' => [
                        'Feature 1',
                        'Feature 2',
                        'Feature 3',
                    ]
                ],
                [
                    'id' => 'plan3',
                    'name' => 'Plan 3',
                    'interval' => 'Monthly',
                    'trial_days' => 30,
                    'price' => 30,
                    'features' => [
                        'Feature 1',
                        'Feature 2',
                        'Feature 3',
                    ]
                ]
            ]
        ];
    }

    public static function getCurrentUser()
    {
        if (auth()->guest()) return null;
        return auth()->user()->toArray();
    }
}
