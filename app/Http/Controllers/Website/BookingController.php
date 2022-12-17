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
            session()->put("cartItem",[
                "ID"=>$id,
                "Cap"=>$cap,
                "Nights"=>session()->get("sessionArr")["nights"],
                "adultsNumber"=>session()->get("sessionArr")["adultsNumber"],
                "childNumber"=>session()->get("sessionArr")["childNumber"],
                "roomsNumber"=>session()->get("sessionArr")["roomsNumber"],
                "from_date"=>session()->get("sessionArr")["from_date"],
                "to_date"=>session()->get("sessionArr")["end_date"],
                'ages' => session()->get("sessionArr")["ages"],
            ]);

            return redirect()->route("siteLogin");
        }

        $CartItem = Cart::where("user_id",'=',session()->get("SiteUser")["ID"])->first();

        if($CartItem){
            return redirect()->to("/safer/room/$id/book/$cap")->with("session-warning","Can't Purchase multiple booking in one time");
        }

        $CartItem = new Cart();
        $CartItem->user_id              = session()->get("SiteUser")["ID"];
        $CartItem->room_type_cost_id    = $id;
        $CartItem->room_cap             = $cap;
        $CartItem->adults_count         = session()->get("sessionArr")["adultsNumber"];
        $CartItem->children_count       = session()->get("sessionArr")["childNumber"];
        $CartItem->rooms_count          = session()->get("sessionArr")["roomsNumber"];
        $CartItem->nights               = session()->get("sessionArr")["nights"];
        $CartItem->from_date            = session()->get("sessionArr")["from_date"];
        $CartItem->to_date              = session()->get("sessionArr")["end_date"];
        if(!session()->get("sessionArr")["ages"]){
            $CartItem->ages                 = null;
        }else{
            $CartItem->ages                 = implode(",",session()->get("sessionArr")["ages"]);
        }
        $CartItem->save();
        session()->put("hasCart" , 1);

        return redirect()->to("/cart")->with("session-success","Room is added in your cart successfully");

    }
    public function ExBookRoom(int $id, int $cap)
    {
        Cart::where("user_id",'=',session()->get("SiteUser")["ID"])->delete();
        return $this->BookRoom($id, $cap);
    }
    public function Cart()
    {
        $BreadCrumb = [];
        $Company = Company::first();

        $Counters = Counter::get();

        $RoomCost = DB::table("cart")
        ->select( 'cart.id','cart.room_cap','cart.adults_count', 'cart.children_count', 'cart.rooms_count', 'cart.nights', 'cart.ages','hotel_enoverview','hotels.hotel_stars','hotels.hotel_enname','cart.id','cart.from_date', 'cart.to_date', 'en_room_type', 'food_bev_type', 'ar_room_type',
            'cost','single_cost','double_cost','triple_cost','hotel_id','hotel_banner','countries.en_country','cities.en_city',
            'child_free_age_from','child_free_age_to','child_age_from','child_age_to','child_age_cost')
        ->leftJoin("room_type_costs", "room_type_costs.id", "=", "cart.room_type_cost_id")
        ->leftJoin("hotels", "hotels.id", "=", "room_type_costs.hotel_id")
        ->leftJoin("cities", "hotels.city_id", "=", "cities.id")
        ->leftJoin("countries", "countries.id", "=", "cities.country_id")
        ->leftJoin("room_types", "room_types.id", "=", "room_type_costs.room_type_id")
        ->leftJoin("food_beverages", "food_beverages.id", "=", "room_type_costs.food_beverage_id")
        ->where([["user_id", "=", session()->get("SiteUser")["ID"]]])
        ->first();

        //return view("website.cart",
        return view("website.booking",
            [
                "Company" => $Company,
                "Counters" => $Counters,
                "BreadCrumb" => $BreadCrumb,
                "RoomCost" => $RoomCost
            ]);
    }

    public function DeleteCartItem(int $id)
    {
        $Cart = Cart::find($id);
        $Cart->delete();
        session()->forget("hasCart");

        return redirect()->back();
    }
}
