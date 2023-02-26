<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Country;
use App\Models\Nationality;
use App\Models\Visa_type;
use Illuminate\Http\Request;

class VisaDataController extends Controller
{
    //
    public function all_visa()
    {

        $Company = Company::first();
        $BreadCrumb = [["url" => "/", "name" => "Home"], ["url" => "/visa", "name" => "visa"]];
        $countries = Country::all();
        $nationalities = Nationality::all();
        return view("website.visa.visa", [
            "Company" => $Company,
            "countries" => $countries,
            "nationalities" => $nationalities,
            "BreadCrumb" => $BreadCrumb,

        ]);

    }

    public function fetchCat(Request $request)
    {

        $select = $request->get('select');
        $value = $request->get('value');

        $data = Visa_type::where('country_id', $value)->get();
        $output = '<option value="">Select Visa Type</option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->en_type . '</option>';
        }
        echo $output;
    }
}
