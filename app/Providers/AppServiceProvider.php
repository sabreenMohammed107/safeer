<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Company_branch;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\View;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::defaultStringLength(191);
        $master=Company_branch::where('master_flag',1)->firstorfail();
        $comFooter=Company::where('id',1)->firstorfail();
        View::share('comFooter', $comFooter);

        // `localVar` must NOT be computed here: AppServiceProvider::boot()
        // runs before RouteServiceProvider loads routes/web.php, which is
        // where LaravelLocalization::setLocale() detects the locale from the
        // URL's locale prefix — so LaravelLocalization::getCurrentLocale()
        // at this point is always stale (falls back to the browser's
        // Accept-Language header or the app default, never the actual
        // current page's locale). Every view that doesn't locally recompute
        // $localVar itself (most don't) then generates links/form actions
        // for the wrong locale. A view composer runs per-view at render
        // time — after routing has resolved the real locale — so it picks
        // up the correct value.
        View::composer('*', function ($view) {
            $view->with('localVar', LaravelLocalization::getCurrentLocale());
        });

        // The admin "choose from server" image list is no longer built here: the
        // modal fetches it on first open (ImageLibraryController).
    }
}
