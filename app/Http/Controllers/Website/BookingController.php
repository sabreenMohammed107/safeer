<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Company;
use App\Models\Counter;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\OrderPersons;
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
                "from_date"=> date_format(date_create(session()->get("sessionArr")["from_date"]), "Y-m-d"),
                "to_date"=> date_format(date_create(session()->get("sessionArr")["end_date"]), "Y-m-d"),
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
        $CartItem->from_date            = date_format(date_create(session()->get("sessionArr")["from_date"]), "Y-m-d");
        $CartItem->to_date              = date_format(date_create(session()->get("sessionArr")["end_date"]), "Y-m-d");
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
        ->select( 'cart.user_id','cart.id','cart.room_cap','cart.adults_count', 'cart.children_count', 'cart.rooms_count', 'cart.nights', 'cart.ages','hotel_enoverview','hotels.hotel_stars','hotels.hotel_enname','cart.id','cart.from_date', 'cart.to_date', 'en_room_type', 'food_bev_type', 'ar_room_type',
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

    public function MakeOrder(Request $request)
    {
        $BreadCrumb = [];
        $Company = Company::first();

        $Counters = Counter::get();
        DB::beginTransaction();

        try {
            $order = new Orders();
            $order->user_id                 = $request->user_id;
            $order->holder_salutation       = $request->adultsSal[0];
            $order->holder_name             = $request->adultsNames[0];
            $order->holder_mobile           = $request->adultsMobile[0];
            $order->notes                   = $request->notes;
            $order->from_date               = $request->from_date;
            $order->to_date                 = $request->to_date;
            $order->nights                  = $request->nights;
            $order->adults_count            = $request->adults_count;
            $order->children_count          = $request->children_count;
            $order->rooms_count             = $request->rooms_count;
            $order->save();

            //Adult Loop
            if($request->adultsSal && count($request->adultsSal) > 1)
            {
                for ($i=1; $i < count($request->adultsSal); $i++) {
                    $person = new OrderPersons();
                    $person->order_id = $order->id;
                    $person->person_type = 0; // Adult bit
                    $person->person_salutation = $request->adultsSal[$i];
                    $person->person_name = $request->adultsNames[$i];
                    $person->person_mobile = $request->adultsMobile[$i];
                    $person->person_cost = 0;
                    $person->save();
                }
            }

            //Children Loop
            if ($request->childrenNames && count($request->childrenNames) > 0) {
                for ($i = 0; $i < count($request->childrenNames); $i++) {
                    $person = new OrderPersons();
                    $person->order_id = $order->id;
                    $person->person_type = 1; // child bit
                    $person->person_salutation = "";
                    $person->person_mobile = "";
                    $person->person_name = $request->childrenNames[$i];
                    if($request->childrenAges[$i] <= $request->child_free_age_to && $request->childrenAges[$i] >= $request->child_free_age_from){
                        $person->person_cost = 0;
                    }else{
                        $person->person_cost = $request->child_age_cost;
                    }
                    $person->save();
                }
            }

            $room = new OrderDetails();
            $room->order_id = $order->id;
            $room->room_type = $request->room_type;
            $room->room_view = $request->room_view;
            $room->food_bev_type = $request->food_bev_type;
            $room->room_cost = $request->room_cost;
            $room->total_cost = $request->total_cost;
            $room->hotel_id = $request->hotel_id;
            $room->save();


            $Cart = Cart::where("user_id","=",$request->user_id);
            $Cart->delete();
            session()->forget("hasCart");

            DB::commit();

            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return redirect()->back()->with("session-danger","Can't Purchase Right Now Please Try Again Later");
        }

        return view(
            "website.bookingSuccess",
            [
                "Company" => $Company,
                "Counters" => $Counters,
                "BreadCrumb" => $BreadCrumb,
                "Room"=>$room
            ]
        );
    }
}
