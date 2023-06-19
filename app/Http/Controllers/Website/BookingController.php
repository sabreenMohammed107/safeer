<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Company;
use App\Models\Counter;
use App\Models\OrderDetails;
use App\Models\OrderPersons;
use App\Models\Orders;
use App\Models\RoomDetails;
use App\Models\Room_type_cost;
use App\Models\SiteUser;
use App\Models\Tour;
use App\Models\TourDetails;
use App\Models\TransferDetails;
use App\Models\VisaDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang as Lang;

abstract class ItemType
{
    const ROOM = 0;
    const TOUR = 1;
// etc.
}
class BookingController extends Controller
{
    public function BookRoom(int $id, int $cap)
    {
        if (!session()->get("SiteUser")) {
            session()->put("cartItem", [
                "ID" => $id,
                "Cap" => $cap,
                "Nights" => (session()->get("sessionArr")) ? session()->get("sessionArr")["nights"] : 7,
                "adultsNumber" => (session()->get("sessionArr")) ? session()->get("sessionArr")["adultsNumber"] : 1,
                "childNumber" => (session()->get("sessionArr")) ? session()->get("sessionArr")["childNumber"] : 0,
                "roomsNumber" => (session()->get("sessionArr")) ? session()->get("sessionArr")["roomsNumber"] : 1,
                "from_date" => (session()->get("sessionArr")) ? date_format(date_create(session()->get("sessionArr")["from_date"]), "Y-m-d") : date("Y-m-d"),
                "to_date" => (session()->get("sessionArr")) ? date_format(date_create(session()->get("sessionArr")["end_date"]), "Y-m-d") : Date("Y-m-d", strtotime('+7 days')),
                'ages' => (session()->get("sessionArr")) ? session()->get("sessionArr")["ages"] : [],
                'itemType' => 0, // Room
            ]);

            return redirect()->route("siteLogin");
        }

        $CartItem = Cart::where([["user_id", '=', session()->get("SiteUser")["ID"]], ["item_type", '=', 0]])->first();

        if ($CartItem) { // Has Room ?
            return redirect()->to("/safer/room/$id/book/$cap")->with("session-warning", Lang::get('links.purchase'));
        }

        $CartItem = new Cart();
        $CartItem->user_id = session()->get("SiteUser")["ID"];
        $CartItem->room_type_cost_id = $id;
        $CartItem->room_cap = $cap;
        $CartItem->adults_count = (session()->get("sessionArr")) ? session()->get("sessionArr")["adultsNumber"] : 1;
        $CartItem->children_count = (session()->get("sessionArr")) ? session()->get("sessionArr")["childNumber"] : 0;
        $CartItem->rooms_count = (session()->get("sessionArr")) ? session()->get("sessionArr")["roomsNumber"] : 1;
        $CartItem->nights = (session()->get("sessionArr")) ? session()->get("sessionArr")["nights"] : 7;
        $CartItem->from_date = (session()->get("sessionArr")) ? date_format(date_create(session()->get("sessionArr")["from_date"]), "Y-m-d") : date("Y-m-d");
        $CartItem->to_date = (session()->get("sessionArr")) ? date_format(date_create(session()->get("sessionArr")["from_date"]), "Y-m-d") : date("Y-m-d", strtotime('+7 days'));
        $CartItem->item_type = 0;

        if (!session()->get("sessionArr") || !session()->get("sessionArr")["ages"]) {
            $CartItem->ages = null;
        } else {
            $CartItem->ages = implode(",", session()->get("sessionArr")["ages"]);
        }
        $CartItem->save();
        session()->put("hasCart", 1);

        return redirect()->to("/cart")->with("session-success", Lang::get('links.roomMsg'));

    }
    public function ExBookRoom(int $id, int $cap)
    {
        Cart::where([["user_id", '=', session()->get("SiteUser")["ID"]], ['item_type', '=', 0]])->delete();
        return $this->BookRoom($id, $cap);
    }

    public function Cart()
    {

        // return date("Y-m-d", strtotime('+7 days'));
        $BreadCrumb = [];
        $Company = Company::first();

        $Counters = Counter::get();

        $RoomCost = DB::table("cart")
            ->select(
                'cart.user_id',
                'cart.room_type_cost_id',
                'cart.id',
                'cart.room_cap',
                'cart.adults_count',
                'cart.children_count',
                'cart.rooms_count',
                'cart.nights',
                'cart.ages',
                'hotel_enoverview',
                'hotels.hotel_stars',
                'hotels.hotel_enname',
                'hotels.hotel_arname',
                'cart.id',
                'cart.from_date',
                'cart.to_date',
                'en_room_type',
                'food_bev_type',
                'ar_room_type',
                'cost',
                'single_cost',
                'double_cost',
                'triple_cost',
                'hotel_id',
                'hotel_banner',
                'countries.en_country',
                'countries.ar_country',
                'cities.en_city',
                'cities.ar_city',
                'child_free_age_from',
                'cart.item_type',
                'child_free_age_to',
                'child_age_from',
                'child_age_to',
                'child_age_cost'
            )
            ->leftJoin("room_type_costs", "room_type_costs.id", "=", "cart.room_type_cost_id")
            ->leftJoin("hotels", "hotels.id", "=", "room_type_costs.hotel_id")
            ->leftJoin("cities", "hotels.city_id", "=", "cities.id")
            ->leftJoin("countries", "countries.id", "=", "cities.country_id")
            ->leftJoin("room_types", "room_types.id", "=", "room_type_costs.room_type_id")
            ->leftJoin("food_beverages", "food_beverages.id", "=", "room_type_costs.food_beverage_id")
            ->where([["user_id", "=", session()->get("SiteUser")["ID"]], ["cart.item_type", '=', 0]])
            ->first();

        $ToursCost = DB::table("cart")
            ->select(
                'cart.user_id',
                'cart.id',
                'cart.tour_id',
                'cart.adults_count',
                'cart.children_count',
                'cart.ages',
                'en_overview',
                'banner',
                'tours.en_name',
                'tours.ar_name',
                'tours.id',
                'cart.id',
                'cart.tour_date',
                'tour_person_cost',
                'duration',
                'countries.en_country',
                'countries.ar_country',
                'cities.en_city',
                'cities.ar_city',
                'cart.item_type',
            )
            ->leftJoin("tours", "cart.tour_id", "=", "tours.id")
            ->leftJoin("cities", "tours.city_id", "=", "cities.id")
            ->leftJoin("countries", "countries.id", "=", "cities.country_id")
            ->where([["user_id", "=", session()->get("SiteUser")["ID"]], ["cart.item_type", '=', 1]])
            ->get();

        $TransferCost = DB::table("cart")
            ->select(
                'cart.user_id',
                'cart.id',
                'cart.transfer_id',
                'cart.transfer_date',
                'from_loc.location_enname as from_location_enname',
                'from_loc.location_arname as from_location_arname',
                'to_loc.location_enname as to_location_enname',
                'to_loc.location_arname as to_location_arname',
                'car_models.model_enname',
                'car_models.model_arname',
                'car_models.image',
                'car_models.capacity',
                'car_classes.class_enname',
                'car_classes.class_arname',
                'cart.item_type',
                'transfers.person_price',
            )
            ->leftJoin("transfers", "transfers.id", "=", "cart.transfer_id")
            ->leftJoin("transfer_locations as from_loc", "transfers.from_location_id", "=", "from_loc.id")
            ->leftJoin("transfer_locations as to_loc", "transfers.to_location_id", "=", "to_loc.id")
            ->leftJoin("car_models", "transfers.car_model_id", "=", "car_models.id")
            ->leftJoin("car_classes", "transfers.class_id", "=", "car_classes.id")
            ->where([["user_id", "=", session()->get("SiteUser")["ID"]], ["cart.item_type", '=', 2]])
            ->first();

        $VisasCost = DB::table("cart")
            ->select(
                'cart.user_id',
                'cart.id',
                'cart.visa_name',
                'cart.visa_phone',
                'cart.visa_email',
                'cart.visa_personal_photo',
                'cart.visa_passport_photo',
                'cart.visa_id',
                'cart.item_type',
                'visa_types.en_type',
                'visa_types.ar_type',
                'countries.en_country',
                'countries.ar_country',
                'nationalities.en_nationality',
                'nationalities.ar_nationality',
                'visas.cost',
            )
            ->leftJoin("visas", "visas.id", "=", "cart.visa_id")
            ->leftJoin("visa_types", "visa_types.id", "=", "visas.visa_type_id")
            ->leftJoin("countries", "countries.id", "=", "visa_types.country_id")
            ->leftJoin("nationalities", "nationalities.id", "=", "visas.nationality_id")
            ->where([["user_id", "=", session()->get("SiteUser")["ID"]], ["cart.item_type", '=', 3]])
            ->get();
        $GPVisasCost = DB::table("cart")
            ->select(
                'cart.user_id',
                'cart.visa_id',
                'cart.item_type',
                'visa_types.en_type',
                'visa_types.ar_type',
                'countries.en_country',
                'countries.ar_country',
                'nationalities.en_nationality',
                'nationalities.ar_nationality',
                DB::raw('COUNT(cost) as groupped_count, SUM(cost) as sum_costs')
            )
            ->leftJoin("visas", "visas.id", "=", "cart.visa_id")
            ->leftJoin("visa_types", "visa_types.id", "=", "visas.visa_type_id")
            ->leftJoin("countries", "countries.id", "=", "visa_types.country_id")
            ->leftJoin("nationalities", "nationalities.id", "=", "visas.nationality_id")
            ->where([["user_id", "=", session()->get("SiteUser")["ID"]], ["cart.item_type", '=', 3]])
            ->groupBy(
                'cart.user_id',
                'cart.visa_id',
                'cart.item_type',
                'visa_types.en_type',
                'visa_types.ar_type',
                'countries.en_country',
                'countries.ar_country',
                'nationalities.en_nationality',
                'nationalities.ar_nationality',
            )
            ->get();
        // return $GPVisasCost;

        $tax_percentage = DB::table('tax')->orderBy('id', 'desc')->first()->tax_percentage; // 14% Currently
        return view(
            "website.booking",
            [
                "Company" => $Company,
                "tax_percentage" => $tax_percentage,
                "Counters" => $Counters,
                "BreadCrumb" => $BreadCrumb,
                "RoomCost" => $RoomCost,
                "ToursCost" => $ToursCost,
                "VisasCost" => $VisasCost,
                "GPVisasCost" => $GPVisasCost,
                "TransferCost" => $TransferCost,
            ]
        );
    }

    public function DeleteCartItem(int $id)
    {
        $Cart = Cart::find($id);
        $Cart->delete();
        session()->forget("hasCart");

        return redirect()->back();
    }
    public function DeleteVisa()
    {
        $Cart = Cart::where([["user_id", '=', session()->get("SiteUser")["ID"]], ["item_type", '=', 3]]);
        $Cart->delete();

        return redirect()->back();
    }

    public function MakeOrder(Request $request)
    {
        // return $request;
        $BreadCrumb = [];
        $Company = Company::first();

        $Counters = Counter::get();
        DB::beginTransaction();
        $RoomDetail = null;
        $order = null;
        try {
            $order = new Orders();
            $order->user_id = session()->get("SiteUser")["ID"];
            $order->tax_percentage = $request->tax_percentage;
            $order->save();

            if ($request->adultsSal && $request->adultsSal[0]) {
                $Cost = 0;
                $ChildrenCost = 0;
                $FreeChildren = 0;
                $PaidChildren = 0;
                $room = Room_type_cost::find($request->room_id);
                $cartitem = Cart::find($request->cart_id);
                if ($cartitem->children_count) {
                    $ages = explode(",", $cartitem->ages);

                    for ($i = 0; $i < $cartitem->children_count; $i++) {
                        if ($ages[$i] >= $room->child_free_age_from && $ages[$i] <= $room->child_free_age_to) {
                            $FreeChildren++;
                        } else {
                            $PaidChildren++;
                        }
                    }
                }
                if ($request->room_cap == 1) {
                    $Cost = $room->single_cost;
                } else if ($request->room_cap == 2) {
                    $Cost = $room->double_cost;
                } elseif ($request->room_cap == 3) {
                    $Cost = $room->triple_cost;
                }
                $orderDetails = new OrderDetails();
                $orderDetails->order_id = $order->id;
                $orderDetails->holder_salutation = $request->adultsSal[0];
                $orderDetails->holder_name = $request->adultsNames[0];
                $orderDetails->holder_mobile = $request->adultsMobile[0];
                $orderDetails->notes = $request->notes;
                $orderDetails->detail_type = 0;
                                    //add status column
                                    $orderDetails->status_id = 1;
                $orderDetails->save();

                $RoomDetail = new RoomDetails();
                $RoomDetail->order_details_id = $orderDetails->id;
                $RoomDetail->room_type = $request->room_type;
                $RoomDetail->room_view = $request->room_view;
                $RoomDetail->food_bev_type = $request->food_bev_type;
                $RoomDetail->room_cost = $Cost;

                $RoomDetail->total_cost = $request->nights * ($cartitem->rooms_count * $Cost + $PaidChildren * $room->child_age_cost);

                $RoomDetail->hotel_id = $request->hotel_id;
                $RoomDetail->to_date = $request->to_date;
                $RoomDetail->from_date = $request->from_date;
                $RoomDetail->nights = $request->nights;
                $RoomDetail->adults_count = $request->adults_count;
                $RoomDetail->children_count = $request->children_count;
                $RoomDetail->rooms_count = $cartitem->rooms_count;
                $RoomDetail->save();

                //Adult Loop
                if ($request->adultsSal && count($request->adultsSal) > 1) {
                    for ($i = 1; $i < count($request->adultsSal); $i++) {
                        $person = new OrderPersons();
                        $person->order_details_id = $orderDetails->id;
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
                        $person->order_details_id = $orderDetails->id;
                        $person->person_type = 1; // child bit
                        $person->person_salutation = "";
                        $person->person_mobile = "";
                        $person->age = $request->childrenAges[$i];
                        $person->person_name = $request->childrenNames[$i];
                        if ($request->childrenAges[$i] <= $request->child_free_age_to && $request->childrenAges[$i] >= $request->child_free_age_from) {
                            $person->person_cost = 0;
                        } else {
                            $person->person_cost = $request->child_age_cost;
                        }
                        $person->save();
                    }
                }
            }
            /**
             *
             *  Tours Section
             *
             */
            if ($request->tour_adults_count && count($request->tour_id) > 0) {
                for ($i = 0; $i < count($request->tour_id); $i++) {
                    $orderDetails = new OrderDetails();
                    $orderDetails->order_id = $order->id;
                    $orderDetails->holder_salutation = $request->tour_adults_sal[$i][0];
                    $orderDetails->holder_name = $request->tour_adults_name[$i][0];
                    $orderDetails->holder_mobile = $request->tour_adults_mobile[$i][0];
                    $orderDetails->notes = $request->tour_notes[$i];
                    $orderDetails->detail_type = 1; // Tour Type Option [1]
                    $orderDetails->pickup_point = $request->tour_pickup_point[$i];
                    $orderDetails->holder_email = $request->tour_adults_email[$i][0];
                                        //add status column
                                        $orderDetails->status_id = 1;
                    $orderDetails->save();

                    $refTour = Tour::find((int) $request->tour_id[$i]);
                    $TotalPaidPersons = $request->tour_adults_count[$i];
                    for ($j = 0; $j < $request->tour_children_count[$i]; $j++) {
                        if ($request->tour_ages[$i] && explode(",", $request->tour_ages[$i])[$j] > 2) {
                            $TotalPaidPersons++;
                        }
                    }

                    $TourElem = new TourDetails();
                    $TourElem->order_details_id = $orderDetails->id;
                    $TourElem->tour_id = (int) $request->tour_id[$i];
                    $TourElem->tour_name = $refTour->en_name;
                    $TourElem->tour_banner = $refTour->banner;
                    $TourElem->tour_type = ($refTour->type->id == 1) ? 0 : 1;
                    $TourElem->total_cost = ((float) $refTour->tour_person_cost * $TotalPaidPersons); // Before Tax
                    $TourElem->tour_cost = ((float) $request->tour_cost[$i]); // Before Tax
                    $TourElem->tour_date = $request->tour_date[$i];
                    $TourElem->adults_count = (int) $request->tour_adults_count[$i];
                    $TourElem->children_count = (int) $request->tour_children_count[$i];
                    $TourElem->save();
                    //Adult Loop
                    if ($request->tour_adults_count[$i] && (int) $request->tour_adults_count[$i] > 1) {
                        for ($j = 1; $j < (int) $request->tour_adults_count[$i]; $j++) {
                            $person = new OrderPersons();
                            $person->order_details_id = $orderDetails->id;
                            $person->person_type = 0; // Adult byte
                            $person->person_salutation = $request->tour_adults_sal[$i][$j];
                            $person->person_name = $request->tour_adults_name[$i][$j];
                            $person->person_mobile = $request->tour_adults_mobile[$i][$j];
                            $person->person_cost = $refTour->tour_person_cost;
                            $person->person_email = $request->tour_adults_email[$i][$j];
                            $person->save();
                        }
                    }

                    //Children Loop
                    if ($request->tour_children_count[$i] && (int) $request->tour_children_count[$i] > 0) {
                        for ($j = 0; $j < (int) $request->tour_children_count[$i]; $j++) {
                            $person = new OrderPersons();
                            $person->order_details_id = $orderDetails->id;
                            $person->person_type = 1; // child bit
                            $person->person_salutation = "";
                            $person->person_mobile = "";
                            $person->age = $request->tour_child_age[$i][$j];
                            $person->person_name = $request->tour_child_name[$i][$j];
                            $person->person_cost = ((int) $request->tour_child_age[$i][$j] > 2) ? $refTour->tour_person_cost : 0;
                            $person->save();
                        }
                    }
                }

            }

            if ($request->transfer_id) {
                $User = SiteUser::find(session()->get("SiteUser")["ID"]);
                $orderDetails = new OrderDetails();
                $orderDetails->order_id = $order->id;
                $orderDetails->holder_salutation = $request->transferSal;
                $orderDetails->holder_name = $request->transferName;
                $orderDetails->holder_mobile = $request->transferMobile;
                $orderDetails->holder_email = $request->transferEmail;
                $orderDetails->holder_job = $request->transferJob;
                $orderDetails->notes = $request->transferNotes;
                $orderDetails->detail_type = 2; // Transfer
                //add status column
                $orderDetails->status_id = 1;
                $orderDetails->save();

                $TransferDetail = new TransferDetails();
                $TransferDetail->order_details_id = $orderDetails->id;
                $TransferDetail->transfer_id = $request->transfer_id;
                $TransferDetail->transfer_date = $request->transfer_date;
                $TransferDetail->transfer_from = $request->from_loc;
                $TransferDetail->transfer_to = $request->to_loc;
                $TransferDetail->car_model = $request->car_model;
                $TransferDetail->car_class = $request->car_class;
                $TransferDetail->car_image = $request->image;
                $TransferDetail->hotel_name = $request->hotel_name;
                $TransferDetail->car_capacity = $request->capacity;
                $TransferDetail->is_return = ($request->default_holder) ? true : false;
                $TransferDetail->return_date = ($request->default_holder) ? $request->return : null;
                $TransferDetail->transfer_person_price = $request->fees;
                $TransferDetail->transfer_total_cost = (($request->default_holder) ? 2 : 1) * ((float) $request->fees);
                $TransferDetail->save();
            }

            if ($request->visa_id && count($request->visa_id) > 0) {
                for ($i = 0; $i < count($request->visa_id); $i++) {
                    $orderDetails = new OrderDetails();
                    $orderDetails->order_id = $order->id;
                    /**
                     * Holder Here is the Visa holder (Phone, Name, Email) ---- Visa_Details contains -> (name, phone, email)
                     */
                    $orderDetails->holder_salutation = "";
                    $orderDetails->holder_name = $request->visa_name[$i];
                    $orderDetails->holder_mobile = $request->visa_phone[$i];
                    $orderDetails->holder_email = $request->visa_email[$i];
                    $orderDetails->notes = " ";
                    $orderDetails->detail_type = 3; // Visa option
                    //add status column
                    $orderDetails->status_id = 1;
                    $orderDetails->save();

                    $VisaDetail = new VisaDetails();
                    $VisaDetail->visa_id = $request->visa_id[$i];
                    $VisaDetail->order_details_id = $orderDetails->id;
                    $VisaDetail->visa_cost = $request->visa_cost[$i];
                    $VisaDetail->visa_personal_photo = $request->visa_personal_photo[$i];
                    $VisaDetail->visa_passport_photo = $request->visa_passport_photo[$i];
                    $VisaDetail->visa_date = date_format(now(), "Y-m-d");
                    $VisaDetail->save();

                }
            }
            // return "passed";

            $Cart = Cart::where("user_id", "=", session()->get("SiteUser")["ID"]);
            $Cart->delete();
            session()->forget("hasCart");

            DB::commit();

            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            throw $e;
            return redirect()->back()->with("session-danger", Lang::get('links.contpurchase'));
        }

        return redirect()->to("/Safer/OrderPlacement/$order->id");
    }

    public function SuccessOrder(int $id)
    {
        $order = Orders::find($id);
        // return $order->order_details[1]->tours_details[0];
        $Cost = 0;
        foreach ($order->order_details as $index => $item) {
            if ($item->detail_type == 0) // Room
            {
            $Cost += $item->room_details[0]->total_cost;
        } else if ($item->detail_type == 1) { // Tour
            $Cost += $item->tours_details[0]->total_cost;
        } else if ($item->detail_type == 2) { // Transfer
            $Cost += $item->transfer_details[0]->transfer_total_cost;
        } else if ($item->detail_type == 3) { // Visa
            $Cost += $item->visa_details[0]->visa_cost; // To be completed
        }
    }
    $BreadCrumb = [];
    $Company = Company::first();

    $Counters = Counter::get();
    return view(
        "website.bookingSuccess",
        [
            "Company" => $Company,
            "Counters" => $Counters,
            "BreadCrumb" => $BreadCrumb,
            "Order" => $order,
            "Cost" => $Cost, // Before Tax
        ]
    );
}
}
