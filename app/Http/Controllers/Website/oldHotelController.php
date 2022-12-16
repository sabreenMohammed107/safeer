<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\Gallery;
use App\Models\Hotel;
use App\Models\Review;
use App\Models\Room_type_cost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class oldHotelController extends Controller
{
    public function Abd_profile(int $id)
    {
        $RoomCost = Room_type_cost::find((int) $id);
        // return $RoomCost->hotelRooms->hotel;
        $Company = Company::first();
        $BreadCrumb = [["url" => "/", "name" => "Home"], ["url" => "/hotels", "name" => "Hotels"]];

        $HotelTourGallery = Gallery::where([["hotel_id", '=', $RoomCost->hotelRooms->hotel->id], ["active", '=', 1]])->take(4)->get();
        // return $HotelTourGallery;
        $FeaturesCategories = DB::table("hotels_features")
            ->select("en_category", "features_categories.id")
            ->leftJoin("features", "features.id", "=", "hotels_features.feature_id")
            ->leftJoin("features_categories", "features.feature_category_id", "=", "features_categories.id")
            ->where("hotel_id", '=', $RoomCost->hotelRooms->hotel->id)
            ->groupBy(["en_category", "features_categories.id"])->get();
        // Hotels_feature::with(["feature"])->where("hotel_id", "=", $id)->groupBy("feature->feature_category_id")->get();

        $RoomCosts = DB::table("room_type_costs")
            ->select('room_type_costs.id as id', 'hotels.id as hotel_id', 'hotel_enname', 'hotel_arname',
                'hotel_enoverview', 'hotel_aroverview', 'hotel_stars',
                'hotel_banner', 'hotel_logo', 'hotel_enbrief', 'hotel_arbrief',
                'city_id', 'details_enaddress', 'hotels.active', 'country_id', 'en_country',
                'ar_country', 'en_city', 'ar_city', 'from_date', 'end_date', 'en_room_type', 'food_bev_type', 'ar_room_type',
                'cost')
            ->leftJoin("hotel_rooms", "hotel_rooms.id", "=", "room_type_costs.hotel_room_id")
            ->leftJoin("room_types", "room_types.id", "=", "hotel_rooms.room_type_id")
            ->leftJoin("food_beverages", "food_beverages.id", "=", "room_type_costs.food_beverage_id")
            ->leftJoin("hotels", "hotels.id", "=", "hotel_rooms.hotel_id")
            ->leftJoin("cities", "cities.id", "=", "hotels.city_id")
            ->leftJoin("countries", "countries.id", "=", "cities.country_id")
            ->where([["hotels.active", "=", 1], ["hotels.id", "=", $RoomCost->hotelRooms->hotel->id]])
            ->get();
        return view("website.hotels.hotel_profile", [
            "Company" => $Company,
            "RoomCost" => $RoomCost,
            "BreadCrumb" => $BreadCrumb,
            "FeaturesCategories" => $FeaturesCategories,
            "HotelTourGallery" => $HotelTourGallery,
            "RoomCosts" => $RoomCosts,
        ]);
    }
    public function profile(int $id)
    {
        // $RoomCost = Room_type_cost::find((int) $id);
        $Hotel = Hotel::find((int) $id);
        // return $RoomCost->hotelRooms->hotel;
        $Company = Company::first();
        $BreadCrumb = [["url" => "/", "name" => "Home"], ["url" => "/hotels", "name" => "Hotels"]];

        $HotelTourGallery = Gallery::where([["hotel_id", '=', $id], ["active", '=', 1]])->take(4)->get();
        // return $HotelTourGallery;
        $FeaturesCategories = DB::table("hotels_features")
            ->select("en_category", "features_categories.id")
            ->leftJoin("features", "features.id", "=", "hotels_features.feature_id")
            ->leftJoin("features_categories", "features.feature_category_id", "=", "features_categories.id")
            ->where("hotel_id", '=', $id)
            ->groupBy(["en_category", "features_categories.id"])->get();
        // Hotels_feature::with(["feature"])->where("hotel_id", "=", $id)->groupBy("feature->feature_category_id")->get();

        $RoomCosts = DB::table("room_type_costs")
            ->select('room_type_costs.id', 'from_date', 'end_date', 'en_room_type', 'food_bev_type', 'ar_room_type',
                'cost', 'single_cost', 'double_cost', 'triple_cost', 'hotel_id')

            ->leftJoin("room_types", "room_types.id", "=", "room_type_costs.room_type_id")
            ->leftJoin("food_beverages", "food_beverages.id", "=", "room_type_costs.food_beverage_id")
        // ->leftJoin("hotels", "hotels.id", "=", "room_type_costs.hotel_id")
        // ->leftJoin("cities", "cities.id", "=", "hotels.city_id")
        // ->leftJoin("countries", "countries.id", "=", "cities.country_id")
            ->where([["hotel_id", "=", $id]])

            ->get();

        \Log::info($RoomCosts->count());
        return view("website.hotels.hotel_profile", [
            "Company" => $Company,
            // "RoomCost" => $RoomCost,
            "Hotel" => $Hotel,
            "BreadCrumb" => $BreadCrumb,
            "FeaturesCategories" => $FeaturesCategories,
            "HotelTourGallery" => $HotelTourGallery,
            "RoomCosts" => $RoomCosts,
        ]);
    }
    public function Abd_hotels(Request $request)
    {

        //return $offers;
        $Hotels = Hotel::all();
        $RoomCosts = DB::table("room_type_costs")
            ->select('room_type_costs.id as id', 'hotels.id as hotel_id', 'hotel_enname', 'hotel_arname',
                'hotel_enoverview', 'hotel_aroverview', 'hotel_stars',
                'hotel_banner', 'hotel_logo', 'hotel_enbrief', 'hotel_arbrief',
                'city_id', 'details_enaddress', 'hotels.active', 'country_id', 'en_country',
                'ar_country', 'en_city', 'ar_city', 'from_date', 'end_date', 'cost', DB::raw('count(review_text) as totalreviews'))
            ->leftJoin("hotel_rooms", "hotel_rooms.id", "=", "room_type_costs.hotel_room_id")
            ->leftJoin("hotels", "hotels.id", "=", "hotel_rooms.hotel_id")
            ->leftJoin("reviews", "hotels.id", "=", "reviews.hotel_id")
            ->leftJoin("cities", "cities.id", "=", "hotels.city_id")
            ->leftJoin("countries", "countries.id", "=", "cities.country_id")
            ->where("hotels.active", "=", 1)
            ->groupBy('room_type_costs.id', 'hotels.id', 'hotel_enname', 'hotel_arname',
                'hotel_enoverview', 'hotel_aroverview', 'hotel_stars',
                'hotel_banner', 'hotel_logo', 'hotel_enbrief', 'hotel_arbrief',
                'city_id', 'details_enaddress', 'hotels.active', 'country_id', 'en_country',
                'ar_country', 'en_city', 'ar_city', 'from_date', 'end_date', 'cost');
        if ($request->end_date) {
            $fromdate = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
            $RoomCosts->where("end_date", "<=", $fromdate);
        }
        if ($request->from_date) {
            $todate = Carbon::createFromFormat('d/m/Y', $request->from_date)->format('Y-m-d');
            $RoomCosts->where("from_date", ">=", $todate);
        }
        if ($request->nights) {
            $RoomCosts->where(DB::raw("DATEDIFF(end_date, from_date)"), "<=", $request->nights);
        }
        if ($request->country_id) {
            $RoomCosts->where("country_id", "=", $request->country_id);

        }

        $Company = Company::first();
        $BreadCrumb = [["url" => "/", "name" => "Home"]];
        $Countries = Country::all();
        $Cities = City::all();
        $HotelsRecommended = $RoomCosts->where("city_id", "=", \Session::get('sessionArr')['city_id'])->take(6)->orderBy("hotel_stars" /*I took hotel stars as a recommendation factor*/)->get();
        $HotelsByPrice = $RoomCosts->where("city_id", "=", \Session::get('sessionArr')['city_id'])->take(6)->orderBy("hotels.id" /*Should have been made by price but there is no price column*/)->get();
        $countries = Country::all();
        // return $HotelsByPrice;
        return view("website.hotels.hotels", [
            "Company" => $Company,
            "Hotels" => $Hotels,
            "Count" => $RoomCosts->count(),
            "HotelsRecommended" => $HotelsRecommended,
            "HotelsByPrice" => $HotelsByPrice,
            "Countries" => $Countries,
            "Cities" => $Cities,
            "BreadCrumb" => $BreadCrumb,
            "countries" => $countries,
        ]);
    }

    public function hotels(Request $request)
    {
        $arr = explode(' |', $request->from_date);
        // \Log::info($arr);
        //return $offers;
        $cityId = $request->city_id;
        $Hotels = Hotel::all();
        $RoomCosts = DB::table("room_type_costs")
            ->select('hotels.id as hotel_id', 'hotel_enname', 'hotel_arname',
                'hotel_enoverview', 'hotel_aroverview', 'hotel_stars',
                'hotel_banner', 'hotel_logo', 'hotel_enbrief', 'hotel_arbrief',
                'city_id', 'details_enaddress', 'hotels.active', 'country_id', 'en_country', 'room_type_costs.from_date', 'room_type_costs.end_date',
                'ar_country', 'en_city', 'ar_city', 'from_date', 'end_date', 'cost', DB::raw('count(review_text) as totalreviews'),
                DB::raw('min(single_cost) as single_cost'))

        //->leftJoin("hotel_rooms","hotel_rooms.id","=","room_type_costs.hotel_room_id")
            ->leftJoin("hotels", "hotels.id", "=", "room_type_costs.hotel_id")
            ->leftJoin("reviews", "hotels.id", "=", "reviews.hotel_id")
            ->leftJoin("cities", "cities.id", "=", "hotels.city_id")
            ->leftJoin("countries", "countries.id", "=", "cities.country_id")
            ->where("hotels.active", "=", 1)
            ->groupBy('hotels.id', 'hotel_enname', 'hotel_arname',
                'hotel_enoverview', 'hotel_aroverview', 'hotel_stars',
                'hotel_banner', 'hotel_logo', 'hotel_enbrief', 'hotel_arbrief',
                'city_id', 'details_enaddress', 'hotels.active', 'country_id', 'en_country', 'room_type_costs.from_date', 'room_type_costs.end_date'
                , 'ar_country', 'en_city', 'ar_city', 'from_date', 'end_date', 'cost');
        // if ($request->end_date) {
        //     $fromdate = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
        //     $RoomCosts->where("end_date", "<=", $fromdate);
        // }
        // if ($request->from_date) {
        //     $xx = Carbon::parse($arr[0])->format('d/m/Y');

        //     $todate = Carbon::createFromFormat('d/m/Y', $xx)->format('Y-m-d');
        //     $RoomCosts->where("from_date", ">=", $todate);
        // }
        // if($request->nights){
        //     $RoomCosts->where(DB::raw("DATEDIFF(end_date, from_date)"),"<=", $request->nights);
        // }
        // if ($request->country_id) {
        //     $RoomCosts->where("country_id", "=", $request->country_id);

        // }
//search with only city id
        if ($request->city_id) {
            $RoomCosts->where("city_id", "=", $request->city_id);

        } else {
            $RoomCosts->where("city_id", "=", \Session::get('sessionArr')['city_id']);

        }
        $Company = Company::first();
        $BreadCrumb = [["url" => "/", "name" => "Home"]];
        $Countries = Country::all();
        $Cities = City::all();
        if ($request->city_id) {
            $HotelsRecommended = $RoomCosts->where("city_id", "=", $request->city_id)->take(6)->orderBy("hotel_stars", 'desc')->get();
            $HotelsByPrice = $RoomCosts->where("city_id", "=", $request->city_id)->take(6)->orderBy("single_cost", 'asc')->get();

            $HotelsByAlpha = $RoomCosts->where("city_id", "=", $request->city_id)->take(6)->orderBy("hotels.hotel_enname", 'asc')->get();

        } else {
            $HotelsRecommended = $RoomCosts->where("city_id", "=", \Session::get('sessionArr')['city_id'])->take(6)->orderBy("hotel_stars", 'desc')->get();
            $HotelsByPrice = $RoomCosts->where("city_id", "=", \Session::get('sessionArr')['city_id'])->take(6)->orderBy("single_cost", 'asc')->get();

            $HotelsByAlpha = $RoomCosts->where("city_id", "=", \Session::get('sessionArr')['city_id'])->take(6)->orderBy("hotels.hotel_enname", 'asc')->get();

        }

        // return $HotelsByPrice;
        //set serching data in session

        $sessionArr = ['from_date' => $arr[0], 'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'nights' => $request->nights, 'adultsNumber' => $request->adultsNumber, 'childNumber' => $request->childNumber,
            'roomsNumber' => $request->roomsNumber,
            'end_date' => $arr[1],
            'ages' => $request->ages,
        ];
        session(['sessionArr' => $sessionArr]);

        \Log::info(\Session::get('sessionArr'));
        $countries = Country::all();
        $cities = City::get();
        return view("website.hotels.hotels", [
            "Company" => $Company,
            "Hotels" => $Hotels,
            "Count" => $HotelsRecommended->count(),
            "HotelsRecommended" => $HotelsRecommended,
            "HotelsByPrice" => $HotelsByPrice,
            "HotelsByAlpha" => $HotelsByAlpha,

            "Cities" => $Cities,
            "BreadCrumb" => $BreadCrumb,
            "countries" => $countries,
            "cities" => $cities,
        ]);
    }
    public function getHotelByCity($id)
    {

        $Hotels = Hotel::all();
        $RoomCosts = DB::table("room_type_costs")
            ->select('hotels.id as hotel_id', 'hotel_enname', 'hotel_arname',
                'hotel_enoverview', 'hotel_aroverview', 'hotel_stars',
                'hotel_banner', 'hotel_logo', 'hotel_enbrief', 'hotel_arbrief',
                'city_id', 'details_enaddress', 'hotels.active', 'country_id', 'en_country', 'room_type_costs.from_date', 'room_type_costs.end_date',
                'ar_country', 'en_city', 'ar_city', 'from_date', 'end_date', 'cost', DB::raw('count(review_text) as totalreviews'),
                DB::raw('min(single_cost) as single_cost'))

            ->leftJoin("hotels", "hotels.id", "=", "room_type_costs.hotel_id")
            ->leftJoin("reviews", "hotels.id", "=", "reviews.hotel_id")
            ->leftJoin("cities", "cities.id", "=", "hotels.city_id")
            ->leftJoin("countries", "countries.id", "=", "cities.country_id")
            ->where("hotels.active", "=", 1)
            ->groupBy('hotels.id', 'hotel_enname', 'hotel_arname',
                'hotel_enoverview', 'hotel_aroverview', 'hotel_stars',
                'hotel_banner', 'hotel_logo', 'hotel_enbrief', 'hotel_arbrief',
                'city_id', 'details_enaddress', 'hotels.active', 'country_id', 'en_country', 'room_type_costs.from_date', 'room_type_costs.end_date'
                , 'ar_country', 'en_city', 'ar_city', 'from_date', 'end_date', 'cost');

        $RoomCosts->where("city_id", "=", $id);

        $Company = Company::first();
        $BreadCrumb = [["url" => "/", "name" => "Home"]];
        $Countries = Country::all();
        $Cities = City::all();

        $HotelsRecommended = $RoomCosts->where("city_id", "=", \Session::get('sessionArr')['city_id'])->take(6)->orderBy("hotel_stars", 'desc')->get();

        $HotelsByPrice = $RoomCosts->where("city_id", "=", \Session::get('sessionArr')['city_id'])->take(6)->orderBy("single_cost", 'asc')->get();

        $HotelsByAlpha = $RoomCosts->take(6)->where("city_id", "=", \Session::get('sessionArr')['city_id'])->orderBy("hotels.hotel_enname", 'asc')->get();

        \Log::info($RoomCosts->count());
        $countries = Country::all();
        return view("website.hotels.hotels", [
            "Company" => $Company,
            "Hotels" => $Hotels,
            "Count" => $HotelsRecommended->count(),
            "HotelsRecommended" => $HotelsRecommended,
            "HotelsByPrice" => $HotelsByPrice,
            "HotelsByAlpha" => $HotelsByAlpha,
            "Countries" => $Countries,
            "Cities" => $Cities,
            "BreadCrumb" => $BreadCrumb,
            "countries" => $countries,
        ]);
    }
    public function all_hotels(Request $request)
    {
        //return $offers;
        $Hotels = Hotel::all();
        $RoomCosts = DB::table("room_type_costs")
            ->select('hotels.id as hotel_id', 'hotel_enname', 'hotel_arname',
                'hotel_enoverview', 'hotel_aroverview', 'hotel_stars',
                'hotel_banner', 'hotel_logo', 'hotel_enbrief', 'hotel_arbrief',
                'city_id', 'details_enaddress', 'hotels.active', 'country_id', 'en_country', 'room_type_costs.from_date', 'room_type_costs.end_date',
                'ar_country', 'en_city', 'ar_city', 'from_date', 'end_date', 'cost', DB::raw('count(review_text) as totalreviews'),
                DB::raw('min(single_cost) as single_cost'))

        //->leftJoin("hotel_rooms","hotel_rooms.id","=","room_type_costs.hotel_room_id")
            ->leftJoin("hotels", "hotels.id", "=", "room_type_costs.hotel_id")
            ->leftJoin("reviews", "hotels.id", "=", "reviews.hotel_id")
            ->leftJoin("cities", "cities.id", "=", "hotels.city_id")
            ->leftJoin("countries", "countries.id", "=", "cities.country_id")
            ->where("hotels.active", "=", 1)
            ->groupBy('hotels.id', 'hotel_enname', 'hotel_arname',
                'hotel_enoverview', 'hotel_aroverview', 'hotel_stars',
                'hotel_banner', 'hotel_logo', 'hotel_enbrief', 'hotel_arbrief',
                'city_id', 'details_enaddress', 'hotels.active', 'country_id', 'en_country', 'room_type_costs.from_date', 'room_type_costs.end_date'
                , 'ar_country', 'en_city', 'ar_city', 'from_date', 'end_date', 'cost');
        $Company = Company::first();
        $BreadCrumb = [["url" => "/", "name" => "Home"]];
        $Countries = Country::all();
        $Cities = City::all();
        if (session()->has('sessionArr')) {
            $HotelsRecommended = $RoomCosts->where("city_id", "=", \Session::get('sessionArr')['city_id'])->take(6)->orderBy("hotel_stars", 'desc')->get();
            $HotelsByPrice = $RoomCosts->where("city_id", "=", \Session::get('sessionArr')['city_id'])->take(6)->orderBy("single_cost", 'asc')->get();

            $HotelsByAlpha = $RoomCosts->where("city_id", "=", \Session::get('sessionArr')['city_id'])->take(6)->orderBy("hotels.hotel_enname", 'asc')->get();

        } else {
            $HotelsRecommended = $RoomCosts->take(6)->orderBy("hotel_stars", 'desc')->get();

            $HotelsByPrice = $RoomCosts->take(6)->orderBy("single_cost", 'asc')->get();

            $HotelsByAlpha = $RoomCosts->take(6)->orderBy("hotels.hotel_enname", 'asc')->get();
        }

        // return $HotelsByPrice;
        $countries = Country::all();
        return view("website.hotels.hotels", [
            "Company" => $Company,
            "Hotels" => $Hotels,
            "Count" => count($HotelsRecommended),
            "HotelsRecommended" => $HotelsRecommended,
            "HotelsByPrice" => $HotelsByPrice,
            "HotelsByAlpha" => $HotelsByAlpha,
            "Countries" => $Countries,
            "Cities" => $Cities,
            "BreadCrumb" => $BreadCrumb,
            "countries" => $countries,
        ]);
    }

    public function fetch(Request $request)
    {

        if ($request->ajax()) {

            $RoomCosts = DB::table("room_type_costs")
                ->select('hotels.id as hotel_id', 'hotel_enname', 'hotel_arname',
                    'hotel_enoverview', 'hotel_aroverview', 'hotel_stars',
                    'hotel_banner', 'hotel_logo', 'hotel_enbrief', 'hotel_arbrief',
                    'city_id', 'details_enaddress', 'hotels.active', 'country_id', 'en_country', 'room_type_costs.from_date', 'room_type_costs.end_date',
                    'ar_country', 'en_city', 'ar_city', 'from_date', 'end_date', 'cost', DB::raw('count(review_text) as totalreviews'),
                    DB::raw('min(single_cost) as single_cost'))

            //->leftJoin("hotel_rooms","hotel_rooms.id","=","room_type_costs.hotel_room_id")
                ->leftJoin("hotels", "hotels.id", "=", "room_type_costs.hotel_id")
                ->leftJoin("reviews", "hotels.id", "=", "reviews.hotel_id")
                ->leftJoin("cities", "cities.id", "=", "hotels.city_id")
                ->leftJoin("countries", "countries.id", "=", "cities.country_id")
                ->where("hotels.active", "=", 1)
                ->groupBy('hotels.id', 'hotel_enname', 'hotel_arname',
                    'hotel_enoverview', 'hotel_aroverview', 'hotel_stars',
                    'hotel_banner', 'hotel_logo', 'hotel_enbrief', 'hotel_arbrief',
                    'city_id', 'details_enaddress', 'hotels.active', 'country_id', 'en_country', 'room_type_costs.from_date', 'room_type_costs.end_date'
                    , 'ar_country', 'en_city', 'ar_city', 'from_date', 'end_date', 'cost');
            if ($request->hotel_ids) {
                $RoomCosts->whereIn("hotels.id", explode(',', $request->hotel_ids));
            }
            if ($request->hotel_rating) {
                $RoomCosts->whereIn("hotel_stars", explode(',', $request->hotel_rating));
            }
            if ($request->hotel_cities_ids) {
                $RoomCosts->whereIn("city_id", explode(',', $request->hotel_cities_ids));

            }
            if ($request->hotel_countries_ids) {
                $RoomCosts->whereIn("country_id", explode(',', $request->hotel_countries_ids));

            }
            $Count = $RoomCosts->count();
            if (session()->has('sessionArr')) {
                $HotelsRecommended = $RoomCosts->where("city_id", "=", \Session::get('sessionArr')['city_id'])->take(6)->orderBy("hotel_stars", 'desc')->get();
                $HotelsByPrice = $RoomCosts->where("city_id", "=", \Session::get('sessionArr')['city_id'])->take(6)->orderBy("single_cost", 'asc')->get();

                $HotelsByAlpha = $RoomCosts->where("city_id", "=", \Session::get('sessionArr')['city_id'])->take(6)->orderBy("hotels.hotel_enname", 'asc')->get();

            } else {
                $HotelsRecommended = $RoomCosts->take(6)->orderBy("hotel_stars", 'desc')->get();

                $HotelsByPrice = $RoomCosts->take(6)->orderBy("single_cost", 'asc')->get();

                $HotelsByAlpha = $RoomCosts->take(6)->orderBy("hotels.hotel_enname", 'asc')->get();
            }
            \Log::info($HotelsByPrice);
            return view("components.website.hotels.search_cards",
                [
                    "HotelsRecommended" => $HotelsRecommended,
                    "HotelsByPrice" => $HotelsByPrice,
                    "HotelsByAlpha" => $HotelsByAlpha,
                    "Count" => $Count,
                    "page_num" => $request->page_num,

                ]);
        }
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $RoomCosts = DB::table("room_type_costs")
                ->select('hotels.id as hotel_id', 'hotel_enname', 'hotel_arname',
                    'hotel_enoverview', 'hotel_aroverview', 'hotel_stars',
                    'hotel_banner', 'hotel_logo', 'hotel_enbrief', 'hotel_arbrief',
                    'city_id', 'details_enaddress', 'hotels.active', 'country_id', 'en_country', 'room_type_costs.from_date', 'room_type_costs.end_date',
                    'ar_country', 'en_city', 'ar_city', 'from_date', 'end_date', 'cost', DB::raw('count(review_text) as totalreviews'),
                    DB::raw('min(single_cost) as single_cost'))

            //->leftJoin("hotel_rooms","hotel_rooms.id","=","room_type_costs.hotel_room_id")
                ->leftJoin("hotels", "hotels.id", "=", "room_type_costs.hotel_id")
                ->leftJoin("reviews", "hotels.id", "=", "reviews.hotel_id")
                ->leftJoin("cities", "cities.id", "=", "hotels.city_id")
                ->leftJoin("countries", "countries.id", "=", "cities.country_id")
                ->where("hotels.active", "=", 1)
                ->groupBy('hotels.id', 'hotel_enname', 'hotel_arname',
                    'hotel_enoverview', 'hotel_aroverview', 'hotel_stars',
                    'hotel_banner', 'hotel_logo', 'hotel_enbrief', 'hotel_arbrief',
                    'city_id', 'details_enaddress', 'hotels.active', 'country_id', 'en_country', 'room_type_costs.from_date', 'room_type_costs.end_date'
                    , 'ar_country', 'en_city', 'ar_city', 'from_date', 'end_date', 'cost');
            $arr = explode(' |', $request->from_date);

            if ($request->from_date) {
                $xx = Carbon::parse($arr[0])->format('d/m/Y');
                \Log::info($xx);
                $todate = Carbon::createFromFormat('d/m/Y', $xx)->format('Y-m-d');
                $RoomCosts->where("from_date", ">=", $todate);
            }
            if ($request->nights) {
                $RoomCosts->where(DB::raw("DATEDIFF(end_date, from_date)"), "<=", $request->nights);
            }
            if ($request->country_id) {
                $RoomCosts->where("country_id", "=", $request->country_id);

            }
            $Count = $RoomCosts->count();
            $HotelsRecommended = $RoomCosts->where("city_id", "=", \Session::get('sessionArr')['city_id'])->skip(($request->page_num - 1) * 6)->take(6)->orderBy("hotel_stars", 'desc')->get();
            $HotelsByPrice = $RoomCosts->where("city_id", "=", \Session::get('sessionArr')['city_id'])->skip(($request->page_num - 1) * 6)->take(6)->orderBy("single_cost")->get();

            $HotelsByAlpha = $RoomCosts->where("city_id", "=", \Session::get('sessionArr')['city_id'])->skip(($request->page_num - 1) * 6)->take(6)->orderBy("hotels.hotel_enname")->get();

            return view("components.website.hotels.search_cards",
                [
                    "HotelsRecommended" => $HotelsRecommended,
                    "HotelsByPrice" => $HotelsByPrice,
                    "HotelsByAlpha" => $HotelsByAlpha,
                    "Count" => $Count,
                    "page_num" => $request->page_num,

                ]);
        }
    }

    public function fetch_hotel_cards(Request $request)
    {
        if ($request->ajax()) {
            $RoomCosts = DB::table("room_type_costs")
                ->select('room_type_costs.id as id', 'hotels.id as hotel_id', 'hotel_enname', 'hotel_arname',
                    'hotel_enoverview', 'hotel_aroverview', 'hotel_stars',
                    'hotel_banner', 'hotel_logo', 'hotel_enbrief', 'hotel_arbrief',
                    'city_id', 'details_enaddress', 'hotels.active', 'country_id', 'en_country',
                    'ar_country', 'en_city', 'ar_city', 'from_date', 'end_date', 'en_room_type', 'food_bev_type', 'ar_room_type', 'cost')
                ->leftJoin("hotel_rooms", "hotel_rooms.id", "=", "room_type_costs.hotel_room_id")
                ->leftJoin("room_types", "room_types.id", "=", "hotel_rooms.room_type_id")
                ->leftJoin("food_beverages", "food_beverages.id", "=", "room_type_costs.food_beverage_id")
                ->leftJoin("hotels", "hotels.id", "=", "hotel_rooms.hotel_id")
                ->leftJoin("cities", "cities.id", "=", "hotels.city_id")
                ->leftJoin("countries", "countries.id", "=", "cities.country_id")
                ->where([["hotels.active", "=", 1], ["hotels.id", "=", $request->hotel_id]]);
            if ($request->end_date) {
                $todate = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
                $RoomCosts->where("end_date", "<=", $todate);
            }
            if ($request->from_date) {
                $fromdate = Carbon::createFromFormat('d/m/Y', $request->from_date)->format('Y-m-d');
                $RoomCosts->where("from_date", ">=", $fromdate);
            }

            if ($request->nights) {
                $RoomCosts->where(DB::raw("DATEDIFF(end_date, from_date)"), "<=", $request->nights);
            }
            $Count = $RoomCosts->count();
            $RoomCosts = $RoomCosts->get();

            //return $RoomCosts;

            return view("components.website.hotels.search_hotel_cards",
                [
                    "RoomCosts" => $RoomCosts,
                    "Count" => $Count,
                    "page_num" => $request->page_num,

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
