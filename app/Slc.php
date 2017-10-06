<?php

namespace App;

class Slc
{
    public static function scriptVariables()
    {
        //TODO[daniel]: get map center from some place else.
        return [
            'user' => self::getCurrentUser(),
            'settings' => [
                'map_center' => ['lat' => 39.3209801, 'lng' => -111.09373110000001]
            ],
            'csrfToken' => csrf_token()
        ];
    }

    public static function getCurrentUser()
    {
        if (auth()->guest()) return null;
        return auth()->user()->toArray();
    }
}
