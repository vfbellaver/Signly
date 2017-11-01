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
            //'stripeKey' => env('STRIPE_KEY'),
            'stripeKey' => env('STRIPE_KEY'),
            'pusher' => env('PUSHER_APP_KEY'),
            'plans' => [
                [
                    'id' => 'enterprise-team',
                    'name' => 'ENTERPRISE TEAM',
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
                    'id' => 'company-team',
                    'name' => 'COMPANY-TEAM',
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
                    'id' => 'growing-team',
                    'name' => 'GROWING-TEAM',
                    'interval' => 'Monthly',
                    'trial_days' => 30,
                    'price' => 30,
                    'features' => [
                        'Feature 1',
                        'Feature 2',
                        'Feature 3',
                    ]
                ],
                [
                'id' => 'solo-team',
                'name' => 'SOLO TEAM',
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
