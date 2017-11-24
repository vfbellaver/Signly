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
            'user' => $user,
            'csrfToken' => csrf_token(),
            'stripeKey' => env('STRIPE_KEY'),
            'googleApiKey' => env('GOOGLE_API_KEY'),
            'pusher' => env('PUSHER_APP_KEY'),
            'plans' => [
                [
                    'id' => self::PLAN_1['id'],
                    'name' => self::PLAN_1['name'],
                    'interval' => 'Monthly',
                    'trial_days' => 30,
                    'price' => 10,
                    'features' => [
                        'users' => 'Custom',
                        'billboards' => 'Unlimited',
                        'pdfs' => 'Custom',
                        'proposals' => 'Custom',
                        'contracts' => 'Custom',
                        'scheduler' => 'Yes',
                        'whiteLabel' => 'Yes',
                        'valueMonthly' => 'Call For Quote',
                        'valueAnnual' => 'Call For Quote',
                    ]
                ],
                [
                    'id' => self::PLAN_2['id'],
                    'name' => self::PLAN_2['name'],
                    'interval' => 'Monthly',
                    'trial_days' => 30,
                    'price' => 20,
                    'features' => [
                        'users' => '10',
                        'billboards' => 'Unlimited',
                        'pdfs' => '100',
                        'proposals' => '100',
                        'contracts' => '20',
                        'scheduler' => 'Yes',
                        'whiteLabel' => 'Yes',
                        'valueMonthly' => '499',
                        'valueAnnual' => '449',
                    ]
                ],
                [
                    'id' => self::PLAN_3['id'],
                    'name' => self::PLAN_3['name'],
                    'interval' => 'Monthly',
                    'trial_days' => 30,
                    'price' => 30,
                    'features' => [
                        'users' => '5',
                        'billboards' => 'Unlimited',
                        'pdfs' => '50',
                        'proposals' => '50',
                        'contracts' => '10',
                        'scheduler' => '-',
                        'whiteLabel' => '-',
                        'valueMonthly' => '399',
                        'valueAnnual' => '349',
                    ]
                ],
                [
                    'id' => self::PLAN_4['id'],
                    'name' => self::PLAN_4['name'],
                    'interval' => 'Monthly',
                    'trial_days' => 30,
                    'price' => 30,
                    'features' => [
                        'users' => '1',
                        'billboards' => '25',
                        'pdfs' => '20',
                        'proposals' => '-',
                        'contracts' => '-',
                        'scheduler' => '-',
                        'whiteLabel' => '-',
                        'valueMonthly' => '299',
                        'valueAnnual' => '449',
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

