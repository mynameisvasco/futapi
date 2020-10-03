<?php

namespace App\Application\Common\Middleware;

use App\Domain\Entities\User;
use Closure;
use Auth;

class LimitRequests
{
    public function handle($request, Closure $next)
    {
        $user = User::find(Auth::user()->id);
        $maxRequestsDaily = $user->role()->first()->num_requests_daily;

        if ($user->num_requests_today > $maxRequestsDaily && $maxRequestsDaily != -1) {
            abort(403,
                "You already reached your daily quota. If you need to make more requests consider update your plan");
        }
        $user->num_requests_today++;
        $user->save();
        return $next($request);
    }
}
