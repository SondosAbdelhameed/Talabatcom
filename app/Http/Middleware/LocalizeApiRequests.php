<?php

namespace App\Http\Middleware;

use Closure;
use LaravelLocalization;

class LocalizeApiRequests
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
        // default to app.locale if no locale header is set on the request
        //LaravelLocalization::setLocale($request->header('X-App-Locale') ?: config('app.locale'));
        //dd($request->segment(2));
        $lang = $request->segment(2);
        app()->setLocale($lang);


        return $next($request);
    }
}