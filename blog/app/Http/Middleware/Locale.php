<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Locale
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
        // Get the data stored in the Session, if not, return the default from the config
        $language = \Session::get('website_language', config('app.locale'));

        // Switch the app to the selected language
        config(['app.locale' => $language]);

        return $next($request);
    }
}
