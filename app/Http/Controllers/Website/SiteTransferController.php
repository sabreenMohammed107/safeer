<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Car_class;
use App\Models\Car_model;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\Gallery;
use App\Models\Tour;
use App\Models\Tour_type;
use App\Models\Transfer;
use App\Models\Transfer_location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteTransferController extends Controller
{
    //
    public function all_transfer(Request $request)
    {

        $Company = Company::first();
        $BreadCrumb = [["url" => "/", "name" => "Home"]];
        $pickups = Transfer_location::all();
        $dropoff = Transfer_location::all();

        $CarModels = Car_model::all();
        $CarClass = Car_class::all();

        $TransfersRecommended = Transfer::leftJoin('car_models', 'transfers.car_model_id', '=', 'car_models.id')->orderBy('transfers.id', 'desc')->select('transfers.*')->paginate(6);

        $TransfersByPrice = $TransfersRecommended->sortBy('person_price');
        $TransfersByAlpha = $TransfersRecommended->sortBy('car_models.model_enname');
        return view("website.transfer.transfer", [
            "Company" => $Company,
            "pickups" => $pickups,
            "dropoff" => $dropoff,
            "BreadCrumb" => $BreadCrumb,
            "CarModels" => $CarModels,
            "CarClass" => $CarClass,
            "TransfersRecommended" => $TransfersRecommended,
            "TransfersByPrice" => $TransfersByPrice,
            "TransfersByAlpha" => $TransfersByAlpha,
            "Count" => $TransfersRecommended->count(),

        ]);
    }

    public function fetch_data(Request $request)
    {
        \Log::info($request->all());
        if ($request->ajax()) {


            $filterTour = Transfer::leftJoin('car_models', 'transfers.car_model_id', '=', 'car_models.id');

            if ($request->pickups_ids) {
                $filterTour->whereIn("from_location_id", explode(',', $request->pickups_ids));
                //
            }
            if ($request->dropoff_ids) {
                $filterTour->whereIn("to_location_id", explode(',', $request->dropoff_ids));
                //
            }
            if ($request->CarModels_ids) {
                $filterTour->whereIn("car_model_id", explode(',', $request->CarModels_ids));
                //
            }
            if ($request->CarClass_ids) {
                $filterTour->whereIn("class_id", explode(',', $request->CarClass_ids));
                //
            }



            $TransfersRecommended = $filterTour->orderBy('transfers.id', 'desc')->select('transfers.*')->paginate(6);
            $TransfersByPrice = $TransfersRecommended->sortBy('person_price');
            $TransfersByAlpha = $TransfersRecommended->sortBy('car_models.model_enname');

            return view("website.transfer.transferList",
                [

                    "TransfersRecommended" => $TransfersRecommended,
                    "TransfersByPrice" => $TransfersByPrice,
                    "TransfersByAlpha" => $TransfersByAlpha,
                    "Count" => $TransfersRecommended->count(),
                    "page_num" => $request->page_num,

                ])->render();
        }
    }

    public function fetch(Request $request)
    {
        if ($request->ajax()) {

            $filterTour = Transfer::leftJoin('car_models', 'transfers.car_model_id', '=', 'car_models.id');

            if ($request->pickups_ids) {
                $filterTour->whereIn("from_location_id", explode(',', $request->pickups_ids));
                //
            }
            if ($request->dropoff_ids) {
                $filterTour->whereIn("to_location_id", explode(',', $request->dropoff_ids));
                //
            }
            if ($request->CarModels_ids) {
                $filterTour->whereIn("car_model_id", explode(',', $request->CarModels_ids));
                //
            }
            if ($request->CarClass_ids) {
                $filterTour->whereIn("class_id", explode(',', $request->CarClass_ids));
                //
            }


            $TransfersRecommended = $filterTour->orderBy('transfers.id', 'desc')->select('transfers.*')->paginate(6);
            $TransfersByPrice = $TransfersRecommended->sortBy('person_price');
            $TransfersByAlpha = $TransfersRecommended->sortBy('car_models.model_enname');

            return view("website.transfer.transferList",
                [

                    "TransfersRecommended" => $TransfersRecommended,
                    "TransfersByPrice" => $TransfersByPrice,
                    "TransfersByAlpha" => $TransfersByAlpha,
                    "Count" => $TransfersRecommended->count(),
                    "page_num" => $request->page_num,

                ])->render();
        }
    }

    public function bookTransfer(Request $request)
    {
        if(!session()->get("SiteUser")){
            $sessionTransferBook=[
                'transfer_id' => $request->transfer_id ,
                'transfer_date'=> $request->transfer_date ,
                'transfer_adult' => $request->transfer_adult,
                'itemType' => 2, // Transfer Type Option
            ];
            session(['cartItem' => $sessionTransferBook]);

            \Log::info(\Session::get('sessionTransferBook'));

            return redirect()->route("siteLogin");
        }

        $CartItem = Cart::where([["user_id", '=', session()->get("SiteUser")["ID"]], ["item_type", '=', 2]])->first();

        if ($CartItem) { // Has Transfer ?
            return redirect()->to("/transfers")->with("session-warning", "Can't Purchase multiple transfer items in one time");
        }

        $CartItem = new Cart();
        $CartItem->user_id = session()->get("SiteUser")["ID"];
        $CartItem->transfer_id = $request->transfer_id;
        $CartItem->transfer_date = date_format(date_create($request->transfer_date), "Y-m-d");
        $CartItem->item_type = 2; // -> Transfer
        $CartItem->save();
        session()->put("hasCart", 1);

        return redirect()->to("/cart")->with("session-success", "Transfer is added in your cart successfully");
    }
}

