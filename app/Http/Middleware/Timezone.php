<?php

namespace App\Http\Middleware;

use Closure;

class Timezone
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if ($user && $user->timezone) {
            config()->set('request.timezone', auth()->user()->timezone);
            return $next($request);
        }

        if (request()->exists('timezone')) {
            config()->set('request.timezone', request()->get('timezone'));
            return $next($request);
        }

        config()->set('request.timezone', config('app.timezone'));
        return $next($request);
    }
}
