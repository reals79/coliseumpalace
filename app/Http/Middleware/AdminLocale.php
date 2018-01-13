<?php

namespace App\Http\Middleware;

use Closure;

class AdminLocale
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
        if (preg_match('/\/admin/', $request->url()))
        {
            if (!$request->session()->has('admin.locale'))
            {
                $locales = config('translatable.locales');
                $request->session()->put('admin.locale', $request->getPreferredLanguage($locales));
            }
            app()->setLocale($request->session()->get('admin.locale'));
        }
        return $next($request);
    }
}
