<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Company;
use App\Models\Country;
use App\Models\Nationality;
use App\Models\Visa;
use App\Models\Visa_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Lang as Lang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class VisaDataController extends Controller
{
    //
    public function all_visa()
    {

        $Company = Company::first();
        $BreadCrumb = [["url" => "/", "name" => Lang::get('links.home')], ["url" => "/visa", "name" => Lang::get('links.visa')]];
        $countries = Country::all();
        $nationality_ids = Visa::pluck('nationality_id');
        $nationalities = Nationality::whereIn('id',$nationality_ids)->get();
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
        if (LaravelLocalization::getCurrentLocale() === 'en')
        {
            $output = '<option value="">Select Visa Type</option>';

        foreach ($data as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->en_type . '</option>';
        }
        }else{
            $output = '<option value="">اختر نوع الفيزا</option>';

        foreach ($data as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->ar_type . '</option>';
        }
        }

        echo $output;
    }

    public function fetchNationality(Request $request)
    {

        $select = $request->get('select');
        $value = $request->get('value');

        // $data = Visa_type::where('country_id', $value)->get();

        $nationality_ids = Visa::where('visa_type_id',$value)->pluck('nationality_id');
        $nationalities = Nationality::whereIn('id',$nationality_ids)->get();

        if (LaravelLocalization::getCurrentLocale() === 'en')
{
    $output = '<option value="">Select Nationality</option>';
    foreach ($nationalities as $row) {
        $output .= '<option value="' . $row->id . '">' . $row->en_nationality . '</option>';
    }
}else{
    $output = '<option value="">اختر الجنسية</option>';
    foreach ($nationalities as $row) {
        $output .= '<option value="' . $row->id . '">' . $row->ar_nationality . '</option>';
    }
}

        echo $output;
    }

    public function dynamicCost(Request $request)
    {

        $nationality = $request->get('nationality');
        $visa_type = $request->get('visa_type');

         $data = Visa::where('visa_type_id', $visa_type)->where('nationality_id',$nationality)->first();

         \Log::info([$nationality,$visa_type]);
        $output ='';
        if($data){
            $output =$data->cost;
        }
        if (LaravelLocalization::getCurrentLocale() === 'en')
{
    echo json_encode(array( $output,$data->en_notes ?? ''));
}else{
    echo json_encode(array( $output,$data->ar_notes ?? ''));
}



        // echo $output;
    }
    public function bookVisas(Request $request)
    {
        // return $request->passport[0]->getClientOriginalName();
        // $passport = uniqid() . $request->passport[0]->getClientOriginalName();
        // return $request;
        $Visas = [];
        for ($i = 0; $i < count($request->country); $i++) {
            $visObj = Visa::where('visa_type_id', $request->visa_type_id[$i])->where('nationality_id', $request->nation[$i])->first();
            $passport = Storage::disk('public')->put('uploads/visas/', $request->passport[$i]);
            $personal = Storage::disk('public')->put('uploads/visas/', $request->personal[$i]);
            $elem = [
                'name' => $request->name[$i],
                'phone' => $request->phone[$i],
                'email' => $request->email[$i],
                'passport' => basename($passport),
                'personal' => basename($personal),

            ];
            if ($visObj) {
                $elem['visa_id'] = $visObj->id;
                array_push($Visas, $elem);
            }

        }
        // return $Visas;
        if (!session()->get("SiteUser")) {
            $sessionVisasBook = [
                'visas' => $Visas,
                'itemType' => 3, // Visa Type Option
            ];
            session(['cartItem' => $sessionVisasBook]);

            \Log::info(\Session::get('cartItem'));

            return redirect()->route("siteLogin");
        }

        foreach ($Visas as $index => $visa) {

            $CartItem = new Cart();
            $CartItem->user_id = session()->get("SiteUser")["ID"];
            $CartItem->visa_id = $visa["visa_id"];
            $CartItem->visa_name = $visa["name"];
            $CartItem->visa_phone = $visa["phone"];
            $CartItem->visa_email = $visa["email"];
            $CartItem->visa_personal_photo = $visa["personal"];
            $CartItem->visa_passport_photo = $visa["passport"];
            $CartItem->item_type = 3; // -> Visa Type Option
            $CartItem->save();
        }

        session()->put("hasCart", 1);

        return redirect()->to("/cart")->with("session-success", Lang::get('links.visaMsg'));
    }
}
