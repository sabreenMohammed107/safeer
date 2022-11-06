<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Best_hotel;
use App\Models\Blog;
use App\Models\Blogs_category;
use App\Models\Company;
use App\Models\Counter;
use App\Models\Explore_city;
use App\Models\Offer;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $Company = Company::first();
        $ExploreCities = Explore_city::where("active","=", 1)->take(5)->get();
        $Offers = Offer::where("active","=", 1)->get();
        $Counters = Counter::get();
        $BestHotels = Best_hotel::where('active','=',1)->orderBy("order")->get();
        $BlogsCategories = Blogs_category::all();
        $AllBlogs = Blog::take(4)->get();
        return view("website.home",
            [
                "Company" => $Company,
                "ExploreCities" => $ExploreCities,
                "Offers" => $Offers,
                "Counters" => $Counters,
                "BestHotels" => $BestHotels,
                "BlogsCategories" => $BlogsCategories,
                "AllBlogs" => $AllBlogs
            ]);
    }
}
