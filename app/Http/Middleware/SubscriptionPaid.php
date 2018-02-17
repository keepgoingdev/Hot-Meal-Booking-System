<?php

namespace App\Http\Middleware;

use Closure;

class SubscriptionPaid
{
    public function handle($request, Closure $next)
    {
        if ($request->user() && ! $request->user()->subscribed('main')) {
            session()->flash('message', 'Your subscription needs to be renewed in order to access the service.');
            return redirect('account-settings');
        }

        return $next($request);
    }
}
