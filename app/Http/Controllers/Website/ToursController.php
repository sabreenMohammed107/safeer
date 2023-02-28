<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\Favorite_hotels_tour;
use App\Models\Gallery;
use App\Models\Review;
use App\Models\Tour;
use App\Models\Tour_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ToursController extends Controller
{
/*

 */
    public function profile($id)
    {

        $Tour = Tour::find((int) $id);
        $Company = Company::first();
        $BreadCrumb = [["url" => "/", "name" => "Home"], ["url" => "/tours", "name" => "Tours"]];

        $TourGallery = Gallery::where([["tour_id", '=', $id], ["active", '=', 1]])->take(4)->get();
        // return $HotelTourGallery;
        $FeaturesCategories = DB::table("tour_features")
            ->select("en_category", "features_categories.id")
            ->leftJoin("features", "features.id", "=", "tour_features.feature_id")
            ->leftJoin("features_categories", "features.feature_category_id", "=", "features_categories.id")
            ->where("tour_id", '=', $id)
            ->groupBy(["en_category", "features_categories.id"])->get();
        // Hotels_feature::with(["feature"])->where("hotel_id", "=", $id)->groupBy("feature->feature_category_id")->get();

        $Countries = Country::all();
        $Cities = City::where('country_id', 1)->get();
        return view("website.tours.tourProfile", [
            "Company" => $Company,
            "Tour" => $Tour,
            "BreadCrumb" => $BreadCrumb,
            "FeaturesCategories" => $FeaturesCategories,
            "TourGallery" => $TourGallery,

            "Countries" => $Countries,
            "Cities" => $Cities,
        ]);
    }
    //
    public function all_tours(Request $request)
    {

        $Company = Company::first();
        $BreadCrumb = [["url" => "/", "name" => "Home"]];
        $Cities = City::all();
        $TourTypes = Tour_type::all();

        $ToursRecommended = Tour::leftJoin('reviews', 'reviews.tour_id', '=', 'tours.id')->orderBy('reviews.tour_id', 'desc')->groupBy('tours.id')->select('tours.*')->paginate(3);
        $ToursByPrice = $ToursRecommended->sortBy('tour_person_cost');
        $ToursByAlpha = $ToursRecommended->sortBy('en_name');

        return view("website.tours.tours", [
            "Company" => $Company,
            "Cities" => $Cities,
            "BreadCrumb" => $BreadCrumb,
            "TourTypes" => $TourTypes,
            "ToursRecommended" => $ToursRecommended,
            "ToursByPrice" => $ToursByPrice,
            "ToursByAlpha" => $ToursByAlpha,
            "Count" => $ToursRecommended->count(),

        ]);
    }

    public function fetch_data(Request $request)
    {
        \Log::info($request->all());
        if ($request->ajax()) {

            $city_id = $request->tour_cities_ids;
            $type_id = $request->tour_Types_ids;

            $filterTour = Tour::leftJoin('reviews', 'reviews.tour_id', '=', 'tours.id');

            if ($request->tour_cities_ids) {
                $filterTour->whereIn("tours.city_id", explode(',', $request->tour_cities_ids));
                //
            }
            if ($request->tour_Types_ids) {
                $filterTour->whereIn("tours.tour_type_id", explode(',', $request->tour_Types_ids));
                //
            }
            if ($request->price_from && $request->price_to) {
                $filterTour->whereBetween('tour_person_cost', [$request->price_from, $request->price_to]);
                //
            }

            $ToursRecommended = $filterTour->orderBy('reviews.tour_id', 'desc')->groupBy('tour_id')->paginate(3);
            $ToursByPrice = $ToursRecommended->sortBy('tour_person_cost');
            $ToursByAlpha = $ToursRecommended->sortBy('en_name');

            return view("website.tours.toursList",
                [

                    "ToursRecommended" => $ToursRecommended,
                    "ToursByPrice" => $ToursByPrice,
                    "ToursByAlpha" => $ToursByAlpha,
                    "Count" => $ToursRecommended->count(),
                    "page_num" => $request->page_num,

                ])->render();
        }
    }

    public function fetch(Request $request)
    {
        if ($request->ajax()) {

            $city_id = $request->tour_cities_ids;
            $type_id = $request->tour_Types_ids;

            $filterTour = Tour::leftJoin('reviews', 'reviews.tour_id', '=', 'tours.id');

            if ($request->tour_cities_ids) {
                $filterTour->whereIn("tours.city_id", explode(',', $request->tour_cities_ids));
                //
            }
            if ($request->tour_Types_ids) {
                $filterTour->whereIn("tours.tour_type_id", explode(',', $request->tour_Types_ids));
                //
            }
            if ($request->price_from && $request->price_to) {
                $filterTour->whereBetween('tour_person_cost', [$request->price_from, $request->price_to]);
                //
            }

            $ToursRecommended = $filterTour->orderBy('reviews.tour_id', 'desc')->groupBy('tour_id')->paginate(3);
            $ToursByPrice = $ToursRecommended->sortBy('tour_person_cost');
            $ToursByAlpha = $ToursRecommended->sortBy('en_name');
return $ToursRecommended;
            return view("website.tours.toursList",
                [

                    "ToursRecommended" => $ToursRecommended,
                    "ToursByPrice" => $ToursByPrice,
                    "ToursByAlpha" => $ToursByAlpha,
                    "Count" => $ToursRecommended->count(),
                    "page_num" => $request->page_num,

                ])->render();
        }
    }

    public function bookTours(Request $request)
    {
        if(!session()->get("SiteUser")){
            $sessionTourBook = [
                // 'ID' => $request->id,
                'tour_id' => $request->tour_id,
                'tour_date' => $request->tour_date,
                'adultsNumber' => $request->adultsNumber,
                'childNumber' => $request->childNumber,
                'ages' => $request->ages,
                'itemType' => 1, // Tour
            ];
            session(['cartItem' => $sessionTourBook]);

            \Log::info(\Session::get('cartItem'));

            return redirect()->route("siteLogin");
        }

        $CartItem = new Cart();
        $CartItem->user_id = session()->get("SiteUser")["ID"];
        $CartItem->tour_id = $request->tour_id;
        $CartItem->adults_count = $request->adultsNumber;
        $CartItem->children_count = $request->childNumber;
        $CartItem->tour_date = date_format(date_create($request->tour_date), "Y-m-d");
        $CartItem->item_type = 1; // -> Tour
        if (!$request->ages) {
            $CartItem->ages = null;
        } else {
            $CartItem->ages = implode(",", $request->ages);
        }
        $CartItem->save();
        session()->put("hasCart", 1);

        return redirect()->to("/cart")->with("session-success", "Tour is added in your cart successfully");

    }


    public function favourite($id){

        if(session()->get("SiteUser")){
            $input=[
                'tour_id'=>$id,
                'user_id'=>session()->get("SiteUser")["ID"],
            ];
            Favorite_hotels_tour::create($input);
            return redirect()->back();
        }else{
            session()->put("AddFavTour", $id);
            return redirect("/safer/login");
        }
    }

    public function removeFavourite($id){

        if(session()->get("SiteUser")){

            $fav=Favorite_hotels_tour::where('tour_id',$id)->where('user_id',session()->get("SiteUser")["ID"])->first();
            if($fav){
                $fav->delete();
            }
            return redirect()->back();
        }else{
            session()->put("RemFavTour", $id);
            return session()->get("RemFavTour");
            return redirect("/safer/login");
        }
    }


    public function add_review(Request $request)
    {
        $Rev = new Review();
        $Rev->review_text = $request->review_text;
        $Rev->review_stars = $request->rate_val;
        $Rev->tour_id = $request->tour_id;
        $Rev->review_date = now();
        $Rev->active = 1;
        // $Rev->tour_id = 1; //temp

        $Rev->save();

        return redirect()->back();
    }

}
