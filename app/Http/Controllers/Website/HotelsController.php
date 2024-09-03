<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\Favorite_hotels_tour;
use App\Models\Gallery;
use App\Models\Hotel;
use App\Models\Review;
use App\Models\Room_type_cost;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang as Lang;
use Validator;
class HotelsController extends Controller
{
    public function profile($id)
    {
        //return session("SiteUser");
        // $RoomCost = Room_type_cost::find((int) $id);
        $Hotel = Hotel::find((int) $id);
        // return $RoomCost->hotelRooms->hotel;
        $Company = Company::first();
        $BreadCrumb = [["url" => "/", "name" => Lang::get('links.home')], ["url" => "/hotels", "name" => Lang::get('links.hotels')]];


        $HasRoomCart =(session()->get("SiteUser"))? Cart::where([["user_id",'=',session()->get("SiteUser")["ID"]],["item_type",'=',0]])->count() : 0;

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
            ->where([["hotel_id", "=", $id]])

            ->get();
            $Countries =Country::where('flag',1)->get();
            $Cities=City::get();
        \Log::info($RoomCosts->count());
        return view("website.hotels.hotel_profile", [
            "Company" => $Company,
            // "RoomCost" => $RoomCost,
            "Hotel" => $Hotel,
            "BreadCrumb" => $BreadCrumb,
            "FeaturesCategories" => $FeaturesCategories,
            "HotelTourGallery" => $HotelTourGallery,
            "RoomCosts" => $RoomCosts,
            "Countries" => $Countries,
            'HasRoom' => $HasRoomCart,
            "Cities" => $Cities,
        ]);
    }

    public function hotels(Request $request)
    {

        $arr = explode(' |', $request->from_date);
        $Company = Company::first();
        $BreadCrumb = [["url" => "/", "name" => Lang::get('links.home')]];
        $Countries = Country::where('flag',1)->get();
        $Cities = City::where('country_id',$request->country_id)->get();
        $zones = Zone::all();
        //data of hotels
        $Hotels = Hotel::all();
        $RoomCosts = Room_type_cost::all()->unique('hotel_id');

        if ($request->from_date) {
            $xx = Carbon::parse($arr[0])->format('d/m/Y');
            $xxend = Carbon::parse($arr[1])->format('d/m/Y');
            \Log::info($xx);
            $todate = Carbon::createFromFormat('d/m/Y', $xx)->format('Y-m-d');
            $enddate = Carbon::createFromFormat('d/m/Y', $xxend)->format('Y-m-d');

        }

        $city_id = $request->city_id;

        $HotelsRecommended = Room_type_cost::join('hotels', 'room_type_costs.hotel_id', '=', 'hotels.id')->orderBy('hotels.hotel_stars', 'desc')
        ->whereHas('hotel', function ($q) use ($city_id) {
            $q->where('city_id', $city_id);
        })->groupBy('hotel_id')->paginate(6);

        $HotelsByPrice = $HotelsRecommended->sortBy('single_cost');
        $HotelsByAlpha = $HotelsRecommended->sortBy('hotel.hotel_enname');
        // $HotelsByAlpha =  Room_type_cost::with(['hotel' => function ($q) {
        //     $q->orderBy('hotel_enname');
        // }])->whereHas('hotel', function ($q) use ($city_id) {
        //     $q->where('city_id', $city_id);
        // })->groupBy('hotel_id')->paginate(6);
        //set serching data in session

        $sessionArr=['from_date' => $arr[0] , 'country_id' => $request->country_id ,
        'city_id'=> $request->city_id ,
        'nights' => $request->nights, 'adultsNumber' => $request->adultsNumber ,'childNumber' => $request->childNumber ,
        'roomsNumber' => $request->roomsNumber,
        'end_date'=> $arr[1],
        'ages' => $request->ages,
    ];
        session(['sessionArr' => $sessionArr]);

        \Log::info(\Session::get('sessionArr'));

        return view("website.hotels.hotels", [
            "Company" => $Company,
            "Countries" => $Countries,
            "Cities" => $Cities,
            "BreadCrumb" => $BreadCrumb,
            "zones" => $zones,
            "Hotels" => $Hotels,
            "HotelsRecommended" => $HotelsRecommended,
            "HotelsByPrice" => $HotelsByPrice,
            "HotelsByAlpha" => $HotelsByAlpha,
            "Count" => $HotelsRecommended->count(),
            "todate" => $todate,
            'enddate'=>$enddate
        ]);
    }

    public function getHotelByCity($id)
    {



        $Company = Company::first();
        $BreadCrumb = [["url" => "/", "name" => Lang::get('links.home')]];
        $Countries = Country::where('flag',1)->get();
        $Cities = City::where('country_id',1)->get();
        $zones = Zone::all();
         //data of hotels
        $Hotels = Hotel::all();
        $RoomCosts = Room_type_cost::all()->unique('hotel_id');



        $city_id = $id;

        $HotelsRecommended = Room_type_cost::join('hotels', 'room_type_costs.hotel_id', '=', 'hotels.id')->orderBy('hotels.hotel_stars', 'desc')
        ->whereHas('hotel', function ($q) use ($city_id) {
            $q->where('city_id', $city_id);
        })->groupBy('hotel_id')->paginate(6);

        $HotelsByPrice = $HotelsRecommended->sortBy('single_cost');
        $HotelsByAlpha = $HotelsRecommended->sortBy('hotel.hotel_enname');

        // $HotelsByAlpha = Room_type_cost::whereHas('hotel', function ($q) use ($city_id) {
        //     $q->where('city_id', $city_id);
        // })->groupBy('hotel_id')->paginate(6);

        $todate=null;
        $enddate=null;
        return view("website.hotels.hotels", [
            "Company" => $Company,
            "Countries" => $Countries,
            "Cities" => $Cities,
            "BreadCrumb" => $BreadCrumb,
            "zones" => $zones,
            "Hotels" => $Hotels,
            "HotelsRecommended" => $HotelsRecommended,
            "HotelsByPrice" => $HotelsByPrice,
            "HotelsByAlpha" => $HotelsByAlpha,
            "Count" => $HotelsRecommended->count(),
            "todate" => $todate,
            'enddate'=>$enddate
        ]);
    }

    public function all_hotels(Request $request)
    {

        $Company = Company::first();
        $BreadCrumb = [["url" => "/", "name" => Lang::get('links.home')]];
        $Countries = Country::where('flag',1)->get();
        $Cities = City::where('country_id',1)->get();
        $zones = Zone::all();
            //data of hotels
        $Hotels = Hotel::all();
        $RoomCosts = Room_type_cost::all()->unique('hotel_id');
        $HotelsRecommended = Room_type_cost::join('hotels', 'room_type_costs.hotel_id', '=', 'hotels.id')->orderBy('hotels.hotel_stars', 'desc')->groupBy('hotel_id')->paginate(6);

        $HotelsByPrice = $HotelsRecommended->sortBy('single_cost');
        $HotelsByAlpha = $HotelsRecommended->sortBy('hotel.hotel_enname');

        // $HotelsByAlpha = Room_type_cost::with(['hotel' => function ($q) {
        //     $q->orderBy('hotel_enname');
        // }])->groupBy('hotel_id')->paginate(6);

        $todate = null;
        $enddate = null;
        return view("website.hotels.hotels", [
            "Company" => $Company,
            "Countries" => $Countries,
            "Cities" => $Cities,
            "BreadCrumb" => $BreadCrumb,
            "zones" => $zones,
            "Hotels" => $Hotels,
            "HotelsRecommended" => $HotelsRecommended,
            "HotelsByPrice" => $HotelsByPrice,
            "HotelsByAlpha" => $HotelsByAlpha,
            "Count" => $HotelsRecommended->count(),
            "todate" => $todate,
            "enddate" => $enddate,
        ]);
    }

    public function fetch(Request $request)
    {

    \Log::info(["message",$request->all()]);

        if ($request->ajax()) {
            $todate=null;
            $enddate=null;
            $searchHotelId= $request->searchHotelId;
            $city_id= $request->hotel_cities_ids;
            $zone_id=$request->hotel_zone_ids;
            $rate_id=$request->hotel_rating;
            $serch=$request->searchHotelId;
            \Log::info($request->all());
            $RoomCosts = Room_type_cost::whereHas('hotel', function ($q) {
                $q->where('active',  1);
            });

            if ($request->searchHotelId ) {
                $ser=Hotel::where('hotel_enname', $serch)->first();
                $RoomCosts->where("hotel_id",$ser->id);
            //
            }
            if ($request->hotel_ids && $request->searchHotelId) {
                $RoomCosts->where("hotel_id",$ser->id)->orWhereIn("hotel_id", explode(',', $request->hotel_ids));
                }elseif($request->hotel_ids && empty($request->searchHotelId)) {
                    $RoomCosts->whereIn("hotel_id", explode(',', $request->hotel_ids));
                }
            if ($request->hotel_rating) {
                $rtes=Hotel::whereIn('hotel_stars',   explode(',', $rate_id))->pluck('id');
                $RoomCosts->whereIn('hotel_id',$rtes) ;
            }
            if ($request->hotel_cities_ids) {

                $RoomCosts->whereHas('hotel', function ($q) use ($city_id) {
                    $q->whereIn('city_id',  explode(',', $city_id));
                });
            }

            if ($request->hotel_zone_ids) {
                $RoomCosts->whereHas('hotel', function ($q) use ($zone_id) {
                    $q->whereIn('zone_id', explode(',', $zone_id));
                });


            }


            $HotelsRecommended = $RoomCosts->join('hotels', 'room_type_costs.hotel_id', '=', 'hotels.id')->orderBy('hotels.hotel_stars', 'desc')->groupBy('hotel_id')->paginate(6);

            $HotelsByPrice = $HotelsRecommended->sortBy('single_cost');
            $HotelsByAlpha = $HotelsRecommended->sortBy('hotel.hotel_enname');

            // $HotelsByAlpha =  $RoomCosts->with(['hotel' => function ($q) {
            //     $q->orderBy('hotel_enname');
            // }])->groupBy('hotel_id')->paginate(6);
\Log::info( $HotelsRecommended);
            return view("website.hotels.hotelsList",
                [
                    "HotelsRecommended" => $HotelsRecommended,
                    "HotelsByPrice" => $HotelsByPrice,
                    "HotelsByAlpha" => $HotelsByAlpha,
                    // "Count" =>  $HotelsRecommended->count(),
                    // "page_num" => $request->page_num,
                    "todate" =>$todate,
                    "enddate" =>$enddate,

                ])->render();
        }

    }



      function fetch_data(Request $request){

        if ($request->ajax()) {
            $todate=null;
            $enddate=null;
            $city_id= $request->hotel_cities_ids;
            $zone_id=$request->hotel_zone_ids;
            $rate_id=$request->hotel_rating;
            $serch=$request->searchHotelId;
\Log::info($request->all());
            if ($request->searchHotelId) {

                $serIds=Hotel::where('hotel_enname', 'LIKE', '%'. $serch. '%')->pluck(id);

            }
            $RoomCosts = Room_type_cost::whereHas('hotel', function ($q) {
                $q->where('active',  1);
            });
            if ($request->searchHotelId && !$request->hotel_ids) {
                $ser=Hotel::where('hotel_enname', $serch)->first();
                $RoomCosts->where("hotel_id",$ser->id);
            //
            }
            if ($request->hotel_ids && $request->searchHotelId) {
                $RoomCosts->where("hotel_id",$ser->id)->orWhereIn("hotel_id", explode(',', $request->hotel_ids));
                }else{
                    $RoomCosts->whereIn("hotel_id", explode(',', $request->hotel_ids));
                }

            if ($request->hotel_rating) {

                $rtes=Hotel::whereIn('hotel_stars',   explode(',', $rate_id))->pluck('id');
                $RoomCosts->whereIn('hotel_id',$rtes) ;

            }
            if ($request->hotel_cities_ids) {

                $RoomCosts->whereHas('hotel', function ($q) use ($city_id) {
                    $q->whereIn('city_id',  explode(',', $city_id));
                });
            }

            if ($request->hotel_zone_ids) {
                $RoomCosts->whereHas('hotel', function ($q) use ($zone_id) {
                    $q->whereIn('zone_id', explode(',', $zone_id));
                });


            }


            $HotelsRecommended = $RoomCosts->join('hotels', 'room_type_costs.hotel_id', '=', 'hotels.id')->orderBy('hotels.hotel_stars', 'desc')->groupBy('hotel_id')->paginate(6);

            $HotelsByPrice = $HotelsRecommended->sortBy('single_cost');
            $HotelsByAlpha = $HotelsRecommended->sortBy('hotel.hotel_enname');

            // $HotelsByAlpha =  $RoomCosts->with(['hotel' => function ($q) {
            //     $q->orderBy('hotel_enname');
            // }])->groupBy('hotel_id')->paginate(6);
            \Log::info( $HotelsRecommended);
            return view("website.hotels.hotelsList",
                [
                    "HotelsRecommended" => $HotelsRecommended,
                    "HotelsByPrice" => $HotelsByPrice,
                    "HotelsByAlpha" => $HotelsByAlpha,
                    "Count" =>  $HotelsRecommended->count(),
                    "page_num" => $request->page_num,
                    "todate" =>$todate,
                    "enddate" =>$enddate,

                ])->render();
        }
    }


    public function fetch_hotel_cards(Request $request)
    {
    }

    public function add_review(Request $request)
    {


        $validator = Validator::make($request->all(), [

            'review_text' => 'required',
            'captcha' => 'required|captcha',


        ], [

            'captcha.captcha' => Lang::get('links.captcha_captcha'),
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        $Rev = new Review;
        $Rev->review_text = $request->review_text;
        $Rev->review_stars = $request->rate_val;
        $Rev->hotel_id = $request->hotel_id;
        $Rev->review_date = now();
        $Rev->active = 1;
        if(session()->get("SiteUser")){
            $Rev->user_id = session()->get("SiteUser")["ID"];
        }
        // $Rev->tour_id = 1; //temp contactMsg

        $Rev->save();
        return response()->json(['success'=>Lang::get('links.contactMsg')]);
        // return redirect()->back();
    }


    public function favourite($id){

        if(session()->get("SiteUser")){
            $input=[
                'hotel_id'=>$id,
                'user_id'=>session()->get("SiteUser")["ID"],
            ];
            Favorite_hotels_tour::create($input);
            return redirect()->back();
        }else{
            session()->put("AddFavHotel", $id);
            return redirect("/safer/login");
        }
    }

    public function removeFavourite($id){

        if(session()->get("SiteUser")){

            $fav=Favorite_hotels_tour::where('hotel_id',$id)->where('user_id',session()->get("SiteUser")["ID"])->first();
            if($fav){
                $fav->delete();
            }
            return redirect()->back();
        }else{
            session()->put("RemFavHotel", $id);
            return session()->get("RemFavHotel");
            return redirect("/safer/login");
        }
    }


    public function autocompleteSearch(Request $request)
    {
        $data = Hotel::select("hotel_enname as value", "id")
                    ->where('hotel_enname', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();

        return response()->json($data);
    }
}
