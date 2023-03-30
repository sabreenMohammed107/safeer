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
        $localVar=LaravelLocalization::getCurrentLocale();
        //
        View::share(['comFooter'=>$comFooter,'localVar'=>$localVar]);
    }
}
