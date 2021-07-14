<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check logged?
        if (Auth::check()) {
            return $next($request);
        }
        else{
            return redirect("/auth/login")
                ->with([
                    'message' => __('auth.login_logged'),
                    'alert' => 'alert-danger',
                ]);
        }
    }
}
