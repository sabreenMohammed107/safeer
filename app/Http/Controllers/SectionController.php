<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\City;
use App\Models\Offer;
use App\Models\Company;
use App\Models\Counter;
use App\Models\Country;
use App\Models\Explore_city;
use App\Models\Best_hotel;
use App\Models\Blogs_category;

use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function loadSection($name){
        switch($name) {
            // case 'explore':
            //     $Company = Company::where('id',1)->firstorfail();
            //     $ExploreCities = Explore_city::where("active","=", 1)->get();
            //     return view('website.sections.explore' , compact('ExploreCities','Company'));
            case 'limit':

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
                return view('website.sections.limit', compact('Offers','ExploreCities','Company','mainOffer','Counters','Countries','cities','BestHotels','BlogsCategories','AllBlogs' ));

        }

    }
}
