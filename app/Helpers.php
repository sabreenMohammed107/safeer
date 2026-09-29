<?php

namespace App\Helpers {
    use App\Models\Employees;
    use Illuminate\Support\Facades\Auth;
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

    class Helper {

        public static function helperfunction1(){
            return "helper function 1 response";
        }

        // public static function getEmployeeStatus($id=0){
        //     $record = Employees::find($id);

        //     return $record->status;
        // }

        function localRoute($routeName, $locale = null)
    {
        if (!$locale && Auth::user())  $locale = Auth::user()->lang;

        return $locale ? LaravelLocalization::getLocalizedURL($locale, route($routeName)) : route($routeName);
    }
    }
}

// Global namespace block so `money()` is callable unqualified from Blade
// views, controllers, and Mailables alike.
namespace {
    if (! function_exists('money')) {
        /**
         * Format a price for display with the site's currency symbol.
         * Central formatter so every price on the site (and in emails) is
         * consistent — change the symbol/format here, not at each call site.
         */
        function money($amount, string $symbol = '$'): string
        {
            return $symbol . number_format((float) $amount, 2);
        }
    }
}
