<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        if (!$request->user() || !$request->user()->is_admin) {
            session()->flash('message', 'You are not an admin.');
            return redirect('account-settings');
        }

        return $next($request);
    }
}
