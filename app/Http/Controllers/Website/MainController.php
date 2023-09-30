<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Best_hotel;
use App\Models\Blog;
use App\Models\Blogs_category;
use App\Models\City;
use App\Models\Company;
use App\Models\Counter;
use App\Models\Country;
use App\Models\Explore_city;
use App\Models\Offer;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Lang as Lang;
class MainController extends Controller
{
    public function index()
    {
        $Company = Company::first();
        $ExploreCities = Explore_city::where("active","=", 1)->get();
         $Offers = Offer::where("active","=", 1)->where('status','!=','main')->inRandomOrder()->limit(4)->get();
         $mainOffer=Offer::where("active","=", 1)->where('status','=','main')->first();
        $Counters = Counter::get();
        $Countries = Country::where('flag',1)->get();
        $cities=City::where('country_id',1)->get();
        $BestHotels = Best_hotel::where('active','=',1)->orderBy("order")->get();
        $BlogsCategories = Blogs_category::where('id','!=',100)->get();
        $AllBlogs = Blog::where('blog_category_id','!=',100)->take(4)->orderBy("id","desc")->get();
// $Offers=Blog::where('blog_category_id','=',100)->inRandomOrder()->limit(4)->get();
        return view("website.home",
            [
                "Company" => $Company,
                "ExploreCities" => $ExploreCities,
                "Offers" => $Offers,
                "mainOffer"=>$mainOffer,
                "Countries" => $Countries,
                "cities" => $cities,
                "Counters" => $Counters,
                "BestHotels" => $BestHotels,
                "BlogsCategories" => $BlogsCategories,
                "AllBlogs" => $AllBlogs
            ]);
    }

    public function fetchCity(Request $request)
    {

        $select = $request->get('select');
        $value = $request->get('value');

        $data = City::where('country_id', $value)->get();

        if (LaravelLocalization::getCurrentLocale() === 'en')
        {
            $output = '<option value="">Select City </option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->en_city . '</option>';
        }
        }else{
            $output = '<option value="">اختر المدينة</option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->ar_city . '</option>';
        }
        }

        echo $output;
    }

    public function terms(){
        $BreadCrumb = [["url" => "/", "name" => Lang::get('links.term_condation')]];
        $Company = Company::first();
        return view("website.terms",
        [
            "Company" => $Company,
            "BreadCrumb" => $BreadCrumb,

        ]);
    }



}
