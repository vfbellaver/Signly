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
            'csrfToken' => csrf_token()
        ];
    }

    public static function getCurrentUser()
    {
        if (auth()->guest()) return null;
        return auth()->user()->toArray();
    }
}
