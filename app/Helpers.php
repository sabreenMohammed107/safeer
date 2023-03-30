<?php

namespace App\Helpers;
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
