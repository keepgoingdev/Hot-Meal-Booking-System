<?php

namespace App\Http\Middleware;

use Closure;

class SubscriptionPaid
{
    public function handle($request, Closure $next)
    {
        if ($request->user() && ! $request->user()->subscribed('main')) {
            // This user is not a paying customer...
            return redirect('billing');
        }

        return $next($request);
    }
}
