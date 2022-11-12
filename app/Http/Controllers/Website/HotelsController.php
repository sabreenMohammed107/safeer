<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\Gallery;
use App\Models\Hotel;
use App\Models\Hotel_room;
use App\Models\Hotels_feature;
use App\Models\Review;
use App\Models\Room_type_cost;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelsController extends Controller
{
    public function profile(int $id)
    {
        $RoomCost = Room_type_cost::find($id);
        // return $RoomCost->hotelRooms->hotel;
        $Company = Company::first();
        $BreadCrumb = [["url"=>"/","name"=>"Home"],["url"=>"/hotels","name"=>"Hotels"]];

        $HotelTourGallery = Gallery::where([["hotel_id",'=',$id],["active",'=',1]])->take(4)->get();
        $FeaturesCategories = DB::table("hotels_features")
        ->select("en_category","features_categories.id")
        ->join("features","features.id","=","hotels_features.feature_id")
        ->join("features_categories","features.feature_category_id","=","features_categories.id")
        ->where("hotel_id",'=',$RoomCost->hotelRooms->hotel->id)
        ->groupBy(["en_category","features_categories.id"])->get();
        // Hotels_feature::with(["feature"])->where("hotel_id", "=", $id)->groupBy("feature->feature_category_id")->get();

        $RoomCosts = DB::table("room_type_costs")
        ->select('hotels.id','hotel_enname','hotel_arname',
        'hotel_enoverview','hotel_aroverview','hotel_stars',
        'hotel_banner','hotel_logo','hotel_enbrief','hotel_arbrief',
        'city_id','details_enaddress','hotels.active','country_id','en_country',
        'ar_country','en_city','ar_city','from_date','end_date','en_room_type','food_bev_type','ar_room_type','cost')
        ->join("hotel_rooms","hotel_rooms.room_type_id","=","room_type_costs.id")
        ->join("room_types","room_types.id","=","hotel_rooms.room_type_id")
        ->join("food_beverages","food_beverages.id","=","room_type_costs.food_beverage_id")
        ->join("hotels","hotels.id","=","hotel_rooms.hotel_id")
        ->join("cities","cities.id","=","hotels.city_id")
        ->join("countries","countries.id","=","cities.country_id")
        ->where([["hotels.active","=",1],["hotels.id","=", $RoomCost->hotelRooms->hotel->id]])
        ->get();
        return view("website.hotels.hotel_profile",[
            "Company" => $Company,
            "RoomCost" => $RoomCost,
            "BreadCrumb"=>$BreadCrumb,
            "FeaturesCategories"=>$FeaturesCategories,
            "HotelTourGallery"=>$HotelTourGallery,
            "RoomCosts"=>$RoomCosts
        ]);
    }

    public function hotels(Request $request)
    {
        //return $offers;
        $Hotels = Hotel::all();
        $RoomCosts = DB::table("room_type_costs")
            ->select('hotels.id','hotel_enname','hotel_arname',
            'hotel_enoverview','hotel_aroverview','hotel_stars',
            'hotel_banner','hotel_logo','hotel_enbrief','hotel_arbrief',
            'city_id','details_enaddress','hotels.active','country_id','en_country',
            'ar_country','en_city','ar_city','from_date','end_date','cost',DB::raw('count(review_text) as totalreviews'))
            ->join("hotel_rooms","hotel_rooms.room_type_id","=","room_type_costs.id")
            ->join("hotels","hotels.id","=","hotel_rooms.hotel_id")
            ->join("reviews","hotels.id","=","reviews.hotel_id")
            ->join("cities","cities.id","=","hotels.city_id")
            ->join("countries","countries.id","=","cities.country_id")
            ->where("hotels.active","=",1)
            ->groupBy('hotels.id','hotel_enname','hotel_arname',
            'hotel_enoverview','hotel_aroverview','hotel_stars',
            'hotel_banner','hotel_logo','hotel_enbrief','hotel_arbrief',
            'city_id','details_enaddress','hotels.active','country_id','en_country',
            'ar_country','en_city','ar_city','from_date','end_date','cost');
        if($request->end_date){
            $fromdate = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
            $RoomCosts->where("end_date", "<=", $fromdate);
        }
        if($request->from_date){
            $todate = Carbon::createFromFormat('d/m/Y', $request->from_date)->format('Y-m-d');
            $RoomCosts->where("from_date", ">=",$todate);
        }
        if($request->nights){
            $RoomCosts->where(DB::raw("DATEDIFF(end_date, from_date)"),"<=", $request->nights);
        }
        if($request->country_id){
            $RoomCosts->where("country_id", "=" ,$request->country_id);

        }

        $Company = Company::first();
        $BreadCrumb = [["url"=>"/","name"=>"Home"]];
        $Countries = Country::all();
        $Cities = City::all();
        $HotelsRecommended = $RoomCosts->take(6)->orderBy("hotel_stars"/*I took hotel stars as a recommendation factor*/)->get();
        $HotelsByPrice = $RoomCosts->take(6)->orderBy("hotels.id" /*Should have been made by price but there is no price column*/)->get();
        // return $HotelsByPrice;
        return view("website.hotels.hotels",[
            "Company" => $Company,
            "Hotels"=>$Hotels,
            "Count"=>$RoomCosts->count(),
            "HotelsRecommended"=>$HotelsRecommended,
            "HotelsByPrice"=>$HotelsByPrice,
            "Countries" => $Countries,
            "Cities" => $Cities,
            "BreadCrumb"=>$BreadCrumb
        ]);
    }
    public function all_hotels(Request $request)
    {
        //return $offers;
        $Hotels = Hotel::all();
        $RoomCosts = DB::table("room_type_costs")
            ->select('hotels.id','hotel_enname','hotel_arname',
            'hotel_enoverview','hotel_aroverview','hotel_stars',
            'hotel_banner','hotel_logo','hotel_enbrief','hotel_arbrief',
            'city_id','details_enaddress','hotels.active','country_id','en_country',
            'ar_country','en_city','ar_city','from_date','end_date','cost',DB::raw('count(review_text) as totalreviews'))
            ->join("hotel_rooms","hotel_rooms.room_type_id","=","room_type_costs.id")
            ->join("hotels","hotels.id","=","hotel_rooms.hotel_id")
            ->join("reviews","hotels.id","=","reviews.hotel_id")
            ->join("cities","cities.id","=","hotels.city_id")
            ->join("countries","countries.id","=","cities.country_id")
            ->where("hotels.active","=",1)
            ->groupBy('hotels.id','hotel_enname','hotel_arname',
            'hotel_enoverview','hotel_aroverview','hotel_stars',
            'hotel_banner','hotel_logo','hotel_enbrief','hotel_arbrief',
            'city_id','details_enaddress','hotels.active','country_id','en_country',
            'ar_country','en_city','ar_city','from_date','end_date','cost');

        $Company = Company::first();
        $BreadCrumb = [["url"=>"/","name"=>"Home"]];
        $Countries = Country::all();
        $Cities = City::all();
        $HotelsRecommended = $RoomCosts->take(6)->orderBy("hotel_stars"/*I took hotel stars as a recommendation factor*/)->get();
        $HotelsByPrice = $RoomCosts->take(6)->orderBy("hotels.id" /*Should have been made by price but there is no price column*/)->get();
        // return $HotelsByPrice;
        return view("website.hotels.hotels",[
            "Company" => $Company,
            "Hotels"=>$Hotels,
            "Count"=>$RoomCosts->count(),
            "HotelsRecommended"=>$HotelsRecommended,
            "HotelsByPrice"=>$HotelsByPrice,
            "Countries" => $Countries,
            "Cities" => $Cities,
            "BreadCrumb"=>$BreadCrumb
        ]);
    }

    public function fetch(Request $request)
    {
        if($request->ajax()){

            $RoomCosts = DB::table("room_type_costs")
            ->select('hotels.id','hotel_enname','hotel_arname',
            'hotel_enoverview','hotel_aroverview','hotel_stars',
            'hotel_banner','hotel_logo','hotel_enbrief','hotel_arbrief',
            'city_id','details_enaddress','hotels.active','country_id','en_country',
            'ar_country','en_city','ar_city','from_date','end_date','cost',DB::raw('count(review_text) as totalreviews'))
            ->join("hotel_rooms","hotel_rooms.room_type_id","=","room_type_costs.id")
            ->join("hotels","hotels.id","=","hotel_rooms.hotel_id")
            ->join("reviews","hotels.id","=","reviews.hotel_id")
            ->join("cities","cities.id","=","hotels.city_id")
            ->join("countries","countries.id","=","cities.country_id")
            ->where("hotels.active","=",1)
            ->groupBy('hotels.id','hotel_enname','hotel_arname',
            'hotel_enoverview','hotel_aroverview','hotel_stars',
            'hotel_banner','hotel_logo','hotel_enbrief','hotel_arbrief',
            'city_id','details_enaddress','hotels.active','country_id','en_country',
            'ar_country','en_city','ar_city','from_date','end_date','cost');
            if($request->hotel_ids){
                $RoomCosts->whereIn("hotels.id", explode(',', $request->hotel_ids));
            }
            if($request->hotel_rating){
                $RoomCosts->whereIn("hotel_stars", explode(',', $request->hotel_rating));
            }
            if($request->hotel_cities_ids){
                $RoomCosts->whereIn("city_id", explode(',', $request->hotel_cities_ids));

            }
            if($request->hotel_countries_ids){
                $RoomCosts->whereIn("country_id", explode(',', $request->hotel_countries_ids));

            }
            $Count = $RoomCosts->count();
            $HotelsRecommended = $RoomCosts->skip(($request->page_num - 1) * 6)->take(6)->orderBy("hotel_stars"/*I took hotel stars as a recommendation factor*/)->get();
            $HotelsByPrice = $RoomCosts->skip(($request->page_num - 1) * 6)->take(6)->orderBy("cost")->get();

            return view("components.website.hotels.search_cards",
            [
                "HotelsRecommended"=>$HotelsRecommended,
                "HotelsByPrice"=>$HotelsByPrice,
                "Count"=>$Count,
                "page_num"=>$request->page_num

            ]);
        }
    }

    public function search(Request $request)
    {
        if($request->ajax()){
            $RoomCosts = DB::table("room_type_costs")
            ->select('hotels.id','hotel_enname','hotel_arname',
            'hotel_enoverview','hotel_aroverview','hotel_stars',
            'hotel_banner','hotel_logo','hotel_enbrief','hotel_arbrief',
            'city_id','details_enaddress','hotels.active','country_id','en_country',
            'ar_country','en_city','ar_city','from_date','end_date','cost',DB::raw('count(review_text) as totalreviews, DATEDIFF(end_date, from_date) AS date_difference,
            DATEDIFF(end_date, from_date) + 1 AS days_inclusive'))
            ->join("hotel_rooms","hotel_rooms.room_type_id","=","room_type_costs.id")
            ->join("hotels","hotels.id","=","hotel_rooms.hotel_id")
            ->join("reviews","hotels.id","=","reviews.hotel_id")
            ->join("cities","cities.id","=","hotels.city_id")
            ->join("countries","countries.id","=","cities.country_id")
            ->where("hotels.active","=",1)
            ->groupBy('hotels.id','hotel_enname','hotel_arname',
            'hotel_enoverview','hotel_aroverview','hotel_stars',
            'hotel_banner','hotel_logo','hotel_enbrief','hotel_arbrief',
            'city_id','details_enaddress','hotels.active','country_id','en_country',
            'ar_country','en_city','ar_city','from_date','end_date','cost');
            if($request->end_date){
                $fromdate = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
                $RoomCosts->where("end_date", "<=", $fromdate);
            }
            if($request->from_date){
                $todate = Carbon::createFromFormat('d/m/Y', $request->from_date)->format('Y-m-d');
                $RoomCosts->where("from_date", ">=",$todate);
            }
            if($request->nights){
                $RoomCosts->where(DB::raw("DATEDIFF(end_date, from_date)"),"<=", $request->nights);
            }
            if($request->country_id){
                $RoomCosts->where("country_id", "=" ,$request->country_id);

            }
            $Count = $RoomCosts->count();
            $HotelsRecommended = $RoomCosts->skip(($request->page_num - 1) * 6)->take(6)->orderBy("hotel_stars"/*I took hotel stars as a recommendation factor*/)->get();
            $HotelsByPrice = $RoomCosts->skip(($request->page_num - 1) * 6)->take(6)->orderBy("cost")->get();

            return view("components.website.hotels.search_cards",
            [
                "HotelsRecommended"=>$HotelsRecommended,
                "HotelsByPrice"=>$HotelsByPrice,
                "Count"=>$Count,
                "page_num"=>$request->page_num

            ]);
        }
    }

    public function fetch_hotel_cards(Request $request)
    {
        if($request->ajax()){
            $RoomCosts = DB::table("room_type_costs")
            ->select('hotels.id','hotel_enname','hotel_arname',
            'hotel_enoverview','hotel_aroverview','hotel_stars',
            'hotel_banner','hotel_logo','hotel_enbrief','hotel_arbrief',
            'city_id','details_enaddress','hotels.active','country_id','en_country',
            'ar_country','en_city','ar_city','from_date','end_date','en_room_type','food_bev_type','ar_room_type','cost')
            ->join("hotel_rooms","hotel_rooms.room_type_id","=","room_type_costs.id")
            ->join("room_types","room_types.id","=","hotel_rooms.room_type_id")
            ->join("food_beverages","food_beverages.id","=","room_type_costs.food_beverage_id")
            ->join("hotels","hotels.id","=","hotel_rooms.hotel_id")
            ->join("cities","cities.id","=","hotels.city_id")
            ->join("countries","countries.id","=","cities.country_id")
            ->where([["hotels.active","=",1],["hotels.id","=", $request->hotel_id]]);
            if($request->end_date){
                $todate = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
                $RoomCosts->where("end_date", "<=", $todate);
            }
            if($request->from_date){
                $fromdate = Carbon::createFromFormat('d/m/Y', $request->from_date)->format('Y-m-d');
                $RoomCosts->where("from_date", ">=",$fromdate);
            }

            if($request->nights){
                $RoomCosts->where(DB::raw("DATEDIFF(end_date, from_date)"),"<=", $request->nights);
            }
            $Count = $RoomCosts->count();
            $RoomCosts = $RoomCosts->get();

            //return $RoomCosts;

            return view("components.website.hotels.search_hotel_cards",
            [
                "RoomCosts" => $RoomCosts,
                "Count"=>$Count,
                "page_num"=>$request->page_num

            ]);
        }
    }

    public function add_review(Request $request)
    {
        $Rev = new Review;
        $Rev->review_text = $request->review_text;
        $Rev->review_stars = $request->rate_val;
        $Rev->hotel_id = $request->hotel_id;
        $Rev->review_date = now();
        $Rev->active = 1;
        $Rev->tour_id = 1; //temp

        $Rev->save();

        return redirect()->back();
    }
}
