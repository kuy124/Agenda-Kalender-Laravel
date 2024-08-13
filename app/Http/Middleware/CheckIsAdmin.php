<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login'); 
        }

        $user = Auth::user();

        // Check for the IsAdmin attribute
        if ($user->IsAdmin !== 1) {
            return redirect('/login')->withErrors(['error' => 'You do not have admin access.']);
        }

        return $next($request);
    }
}
