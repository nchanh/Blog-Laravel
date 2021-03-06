<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
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
        if (Auth::user()->can_post()) {
            return $next($request);
        }

        return redirect()
            ->route('home')
            ->with([
                'message' => __('custom.message_home_role_error'),
                'alert' => 'alert-danger',
            ]);;
    }
}
