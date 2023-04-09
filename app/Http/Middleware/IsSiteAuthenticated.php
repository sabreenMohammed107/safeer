<?php

namespace App\Http\Middleware;

use App\Http\Controllers\SiteAuth\AuthController;
use App\Models\SiteUser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationMiddlewareBase;

class IsSiteAuthenticated extends LaravelLocalizationMiddlewareBase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */


    public function handle(Request $request, Closure $next)
    {
        if(!session()->get("SiteUser"))
        {
            Carbon::setLocale(app('laravellocalization')->getCurrentLocale());
            return redirect()->to(LaravelLocalization::localizeUrl("/safer/login"));
        }

        Carbon::setLocale(app('laravellocalization')->getCurrentLocale());

        return $next($request);
    }
}
