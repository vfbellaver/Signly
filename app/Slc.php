<?php

namespace App;

class Slc
{
    const PLAN_1 = ['id' => 'enterprise', 'name' => 'Enterprise Team'];
    const PLAN_2 = ['id' => 'company', 'name' => 'Company Team'];
    const PLAN_3 = ['id' => 'growing', 'name' => 'Growing Team'];
    const PLAN_4 = ['id' => 'solo', 'name' => 'Solo'];

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
            'user'         => $user,
            'csrfToken'    => csrf_token(),
            'stripeKey'    => env('STRIPE_KEY'),
            'googleApiKey' => env('GOOGLE_API_KEY'),
            'pusher'       => env('PUSHER_APP_KEY'),
            'plans'        => [
                [
                    'id'         => self::PLAN_1['id'],
                    'name'       => self::PLAN_1['name'],
                    'interval'   => 'Monthly',
                    'trial_days' => 30,
                    'price'      => "200.00",
                    'features'   => [
                        'Unlimited Users',
                        'Unlimited Billboards',
                    ],
                ],
            ],
        ];
    }

    public static function getCurrentUser()
    {
        if (auth()->guest()) return null;
        return auth()->user()->toArray();
    }
}

