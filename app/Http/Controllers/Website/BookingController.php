<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Company;
use App\Models\Counter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function BookRoom(int $id, int $cap)
    {
        if(!session()->get("SiteUser")){
            session()->put("cartItem",["ID"=>$id,"Cap"=>$cap]);

            return redirect()->route("siteLogin");
        }

        $CartItem = Cart::where([["user_id",'=',session()->get("SiteUser")["ID"]],["room_type_cost_id","=",$id],["room_cap","=",$cap]])->first();

        if($CartItem){
            return redirect()->back()->with("session-warning","Room is already in your cart");
        }

        $CartItem = new Cart();
        $CartItem->user_id              = session()->get("SiteUser")["ID"];
        $CartItem->room_type_cost_id    = $id;
        $CartItem->room_cap    = $cap;
        $CartItem->save();


        return redirect()->back()->with("session-success","Room is added in your cart successfully");

    }

    public function Cart()
    {
        $BreadCrumb = [];
        $Company = Company::first();

        $Counters = Counter::get();

        $RoomCosts = DB::table("cart")
        ->select( 'cart.room_cap','hotel_enoverview','hotels.hotel_stars','hotels.hotel_enname','cart.id','from_date', 'end_date', 'en_room_type', 'food_bev_type', 'ar_room_type',
            'cost','single_cost','double_cost','triple_cost','hotel_id','hotel_banner','countries.en_country','cities.en_city')
        ->leftJoin("room_type_costs", "room_type_costs.id", "=", "cart.room_type_cost_id")
        ->leftJoin("hotels", "hotels.id", "=", "room_type_costs.hotel_id")
        ->leftJoin("cities", "hotels.city_id", "=", "cities.id")
        ->leftJoin("countries", "countries.id", "=", "cities.country_id")
        ->leftJoin("room_types", "room_types.id", "=", "room_type_costs.room_type_id")
        ->leftJoin("food_beverages", "food_beverages.id", "=", "room_type_costs.food_beverage_id")
        ->where([["user_id", "=", session()->get("SiteUser")["ID"]]])
        ->get();

        //return view("website.cart",
        return view("website.booking",
            [
                "Company" => $Company,
                "Counters" => $Counters,
                "BreadCrumb" => $BreadCrumb,
                "RoomCosts" => $RoomCosts
            ]);
    }

    public function DeleteCartItem(int $id)
    {
        $Cart = Cart::find($id);
        $Cart->delete();

        return redirect()->back();
    }
}
