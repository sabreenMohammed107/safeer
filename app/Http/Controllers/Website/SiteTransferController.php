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
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\Lang as Lang;

class SiteTransferController extends Controller
{
    protected $orderByColumn;
    protected $orderByCity;
    public function __construct()
    {
        // Determine the column to order by based on the current locale
        $locale = App::getLocale();
        $this->orderByColumn = $locale === 'ar' ? 'ar_country' : 'en_country';
        $this->orderByCity = $locale === 'ar' ? 'ar_city' : 'en_city';
    }
     //
    public function all_transfer(Request $request)
    {

        $Company = Company::first();
        $BreadCrumb = [["url" => "/", "name" => Lang::get('links.home')]];
        $CarModels = Car_model::all();
        $CarClass = Car_class::all();
        // $Countries = Country::where('flag', 1)->orderBy($this->orderByColumn)->get();
        $Countries = Country::whereHas('cities', function ($query) {
            $query->whereHas('transferLocations', function ($query) {
                $query->whereHas('transfers');
            });
        })
        ->orderBy('en_country', 'asc')
        ->get();
        $Cities = [];
        if ($request->city_id) {
            $pickups = Transfer_location::where('city_id',$request->city_id)->get();
            $dropoff = Transfer_location::where('city_id',$request->city_id)->get();
            } else {
                $pickups = Transfer_location::all();
                $dropoff = Transfer_location::all();
            }
        $TransfersRecommended = Transfer::leftJoin('car_models', 'transfers.car_model_id', '=', 'car_models.id')->orderBy('transfers.person_price', 'asc')->select('transfers.*')->paginate(6);

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
            "Cities" => $Cities,
            "Countries" => $Countries,
        ]);
    }


    public function transfer(Request $request)
    {

        $Company = Company::first();
        $BreadCrumb = [["url" => "/", "name" => Lang::get('links.home')]];

        $CarModels = Car_model::all();
        $CarClass = Car_class::all();

        // $Countries = Country::where('flag', 1)->orderBy($this->orderByColumn)->get();
        $Countries = Country::whereHas('cities', function ($query) {
            $query->whereHas('transferLocations', function ($query) {
                $query->whereHas('transfers');
            });
        })
        ->orderBy('en_country', 'asc')
        ->get();
        if ($request->country_id) {
            $Cities = City::where('country_id', $request->country_id)->orderBy($this->orderByCity)->get();
        } else {
            $Cities = [];
        }
        if ($request->city_id) {
            $pickups = Transfer_location::where('city_id',$request->city_id)->get();
            $dropoff = Transfer_location::where('city_id',$request->city_id)->get();
            } else {
                $pickups = Transfer_location::all();
                $dropoff = Transfer_location::all();
            }
        $city_id = $request->city_id;
        $country_id = $request->country_id;

        $TransfersRecommended = Transfer::leftJoin('car_models', 'transfers.car_model_id', '=', 'car_models.id')
            ->whereHas('locationFrom', function ($q) use ($city_id) {
                $q->where('city_id', $city_id);
            })
            ->orwhereHas('locationTo', function ($q) use ($city_id) {
                $q->where('city_id', $city_id);
            })
            ->orderBy('transfers.person_price', 'asc')->select('transfers.*')->paginate(6);

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
            "Cities" => $Cities,
            "Countries" => $Countries,
            "city_id" => $city_id,
            "country_id" => $country_id,

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

            if ($request->searchCarCapacity) {
                $filterTour->where("car_models.capacity", '<=', $request->searchCarCapacity);
            }

            if ($request->city_id) {
                $city_id = $request->city_id;
                $filterTour->whereHas('locationFrom', function ($q) use ($city_id) {
                    $q->where('city_id', $city_id);
                })
                    ->orwhereHas('locationTo', function ($q) use ($city_id) {
                        $q->where('city_id', $city_id);
                    });
            }

            $TransfersRecommended = $filterTour->orderBy('transfers.person_price', 'asc')->select('transfers.*')->paginate(6);
            $TransfersByPrice = $TransfersRecommended->sortBy('person_price');
            $TransfersByAlpha = $TransfersRecommended->sortBy('car_models.model_enname');

            return view(
                "website.transfer.transferList",
                [

                    "TransfersRecommended" => $TransfersRecommended,
                    "TransfersByPrice" => $TransfersByPrice,
                    "TransfersByAlpha" => $TransfersByAlpha,
                    "Count" => $TransfersRecommended->count(),
                    "page_num" => $request->page_num,


                ]
            )->render();
        }
    }

    public function fetch(Request $request)
    {
        \Log::info($request->all());
    if ($request->ajax()) {
        $filterTour = Transfer::query();

        // Join the car_models table
        $filterTour->leftJoin('car_models', 'transfers.car_model_id', '=', 'car_models.id');

        // Apply filters
        if ($request->pickups_ids) {
            $filterTour->whereIn("from_location_id", explode(',', $request->pickups_ids));
        }

        if ($request->dropoff_ids) {
            $filterTour->whereIn("to_location_id", explode(',', $request->dropoff_ids));
        }

        if ($request->CarModels_ids) {
            $filterTour->whereIn("transfers.car_model_id", explode(',', $request->CarModels_ids)); // Specify transfers table
        }

        if ($request->CarClass_ids) {
            $filterTour->whereIn("class_id", explode(',', $request->CarClass_ids));
        }

        if ($request->searchCarCapacity) {
            $filterTour->where("car_models.capacity", '<=', $request->searchCarCapacity);
        }

        if ($request->city_id) {
            $city_id = $request->city_id;
            $filterTour->where(function ($query) use ($city_id) {
                $query->whereHas('locationFrom', function ($q) use ($city_id) {
                    $q->where('city_id', $city_id);
                })->orWhereHas('locationTo', function ($q) use ($city_id) {
                    $q->where('city_id', $city_id);
                });
            });
        }

        // Fetch the filtered data
        $TransfersRecommended = $filterTour->orderBy('transfers.person_price', 'asc')
            ->select('transfers.*', 'car_models.model_enname', 'car_models.capacity')
            ->paginate(6);

        // Sorting
        $TransfersByPrice = $TransfersRecommended->sortBy('person_price');
        $TransfersByAlpha = $TransfersRecommended->sortBy('model_enname');

        \Log::info($request->all());

        return view(
            "website.transfer.transferList",
            [
                "TransfersRecommended" => $TransfersRecommended,
                "TransfersByPrice" => $TransfersByPrice,
                "TransfersByAlpha" => $TransfersByAlpha,
                "Count" => $TransfersRecommended->count(),
                "page_num" => $request->page_num,
            ]
        )->render();
    }
}



    public function bookTransfer(Request $request)
    {
        // return $request->transfer_date;
        $capacity = Transfer::leftJoin('car_models', 'transfers.car_model_id', '=', 'car_models.id')->where('transfers.id', $request->transfer_id)
            ->select('car_models.capacity')->first();
        // dd($capacity->capacity);
        $validator = Validator::make(
            $request->all(),
            [
                'transfer_adult' => 'required|integer|min:1|between: 1,' . $capacity->capacity . '',

                'transfer_date' => 'required|date|after:today',

            ],

            [
                'transfer_adult.required' => Lang::get('links.transfer_adult.required'),

                'transfer_date.required' => Lang::get('links.transfer_date.required'),

                'transfer_date.after' => Lang::get('links.transfer_date.after'),

                'transfer_adult.between' => Lang::get('links.transfer_adult.between') . $capacity->capacity . ' ',


            ]
        );
        if ($validator->fails()) {

            return redirect()->back()->withInput()
                ->withErrors($validator->messages());
        }
        if (!session()->get("SiteUser")) {
            $sessionTransferBook = [
                'transfer_id' => $request->transfer_id,
                'transfer_date' => $request->transfer_date,
                'transfer_adult' => $request->transfer_adult,
                'itemType' => 2, // Transfer Type Option
            ];
            session(['cartItem' => $sessionTransferBook]);

            \Log::info(\Session::get('sessionTransferBook'));

            return redirect()->route("siteLogin");
        }

        $CartItem = Cart::where([["user_id", '=', session()->get("SiteUser")["ID"]], ["item_type", '=', 2]])->first();

        if ($CartItem) { // Has Transfer ?
            return redirect()->to("/transfers")->with("session-warning", Lang::get('links.transpurchase'));
        }

        $CartItem = new Cart();
        $CartItem->user_id = session()->get("SiteUser")["ID"];
        $CartItem->transfer_id = $request->transfer_id;
        $CartItem->transfer_date = $request->transfer_date;
        $CartItem->item_type = 2; // -> Transfer
        $CartItem->save();
        session()->put("hasCart", 1);

        return redirect()->to("/cart")->with("session-success", Lang::get('links.transCart'));
    }
}
