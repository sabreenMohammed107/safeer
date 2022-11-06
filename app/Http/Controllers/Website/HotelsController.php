<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Gallery;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelsController extends Controller
{
    public function profile(int $id)
    {
        $Hotel = Hotel::find($id);
        $Company = Company::first();
        $BreadCrumb = [["url"=>"/","name"=>"Home"],["url"=>"/hotels","name"=>"Hotels"]];

        $HotelTourGallery = Gallery::where([["hotel_id",'=',$id],["active",'=',1]])->take(4)->get();

        return view("website.hotels.hotel_profile",[
            "Company" => $Company,
            "Hotel" => $Hotel,
            "BreadCrumb"=>$BreadCrumb,
            "HotelTourGallery"=>$HotelTourGallery
        ]);
    }
}
