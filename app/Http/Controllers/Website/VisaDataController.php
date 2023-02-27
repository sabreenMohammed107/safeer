<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Country;
use App\Models\Nationality;
use App\Models\Visa;
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

        // $data = Visa_type::where('country_id', $value)->get();

        $visa_type_ids = Visa::pluck('visa_type_id');
        $data = Visa_type::whereIn('id', $visa_type_ids)->where('country_id', $value)->get();
        $output = '<option value="">Select Visa Type</option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->en_type . '</option>';
        }
        echo $output;
    }

    public function bookVisas(Request $request)
    {
        $Visas = [];
        for ($i = 0; $i < count($request->country); $i++) {
            $visObj = Visa::where('visa_type_id', $request->visa_type_id[$i])->where('nationality_id', $request->nation[$i])->first();
            $elem = [
                'name' => $request->name[$i],
                'phone' => $request->phone[$i],
                'email' => $request->email[$i],
            ];
            if ($visObj) {
                $elem['visa_id'] = $visObj->id;
                array_push($Visas, $elem);
            }

        }

        if (!session()->get("SiteUser")) {
            $sessionVisasBook = [
                'visas' => $Visas,
                '_date' => date_format(now(), "Y-m-d"),
                'itemType' => 3, // Visa Type Option
            ];
            session(['cartItem' => $sessionVisasBook]);

            \Log::info(\Session::get('cartItem'));

            return redirect()->route("siteLogin");
        }

        return $Visas;
        // foreach ($Visas as $index => $visa) {
        //     # code...
        // }
        // $CartItem = new Cart();
        // $CartItem->user_id = session()->get("SiteUser")["ID"];
        // $CartItem-> = $request->transfer_id;
        // $CartItem->transfer_date = date_format(date_create($request->transfer_date), "Y-m-d");
        // $CartItem->item_type = 2; // -> Transfer
        // $CartItem->save();
        // session()->put("hasCart", 1);

        return redirect()->to("/cart")->with("session-success", "Transfer is added in your cart successfully");
    }
}
