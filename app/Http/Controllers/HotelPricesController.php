<?php

namespace App\Http\Controllers;

use App\Models\Food_beverage;
use App\Models\Hotel;
use App\Models\Room_type;
use App\Models\Room_type_cost;
use Illuminate\Http\Request;

class HotelPricesController extends Controller
{
    protected $object;
    protected $viewName;
    protected $routeName;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Hotel $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'admin.hotels.';
        $this->routeName = 'hotels.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = Hotel::where('active', 1)->get();
        $roomTypes = Room_type::get();
        $foods = Food_beverage::get();
        $roomCosts = Room_type_cost::get();
        return view($this->viewName . 'price', compact('hotels', 'roomTypes', 'foods', 'roomCosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $pageList = $request->kt_docs_repeater_advanced;
        //if delete
        $existIds = [];
        $hotelRoomsCost = Room_type_cost::get();
        if ($hotelRoomsCost) {
            foreach ($hotelRoomsCost as $rCost) {

                if ($pageList) {

                    foreach ($pageList as $index => $opt) {
                        if ($pageList[$index]['room_type_costs_id'] != null) {

                            if ($rCost->id != $pageList[$index]['room_type_costs_id']) {


                            } else {

                                array_push($existIds, $rCost->id);
                            }

                        }

                    }
                }
            }
        }
        $delData = Room_type_cost::whereNotIn('id', $existIds)->get();
        if ($delData) {
            foreach ($delData as $del) {
                $del->delete();

            }
        }

        if ($pageList) {

            foreach ($pageList as $index => $opt) {
                if (isset($pageList[$index]['room_type_costs_id'])) {

                    $cost = Room_type_cost::where('id', (int) $pageList[$index]['room_type_costs_id'])->first();

                    $cost->from_date = $pageList[$index]['from_date'];
                    $cost->end_date = $pageList[$index]['end_date'];
                    if ($pageList[$index]['food_beverage_id']) {
                        $cost->food_beverage_id = (int) $pageList[$index]['food_beverage_id'];
                    }

                    $cost->single_cost = (double) $pageList[$index]['single_cost'];
                    $cost->double_cost = (double) $pageList[$index]['double_cost'];
                    $cost->triple_cost = (double) $pageList[$index]['triple_cost'];
                    $cost->extra_bed_cost = (double) $pageList[$index]['extra_bed_cost'];
                    $cost->child_free_age_to = $pageList[$index]['child_free_age_to'];
                    $cost->child_free_age_from = $pageList[$index]['child_free_age_from'];
                    $cost->child_age_from = $pageList[$index]['child_age_from'];
                    $cost->child_age_to = $pageList[$index]['child_age_to'];
                    $cost->child_age_cost = (double) $pageList[$index]['child_age_cost'];
                    if ($pageList[$index]['room_type_id']) {
                        $cost->room_type_id = (int) $pageList[$index]['room_type_id'];
                    }
                    if ($pageList[$index]['hotel_id']) {
                        $cost->hotel_id = (int) $pageList[$index]['hotel_id'];
                    }

                    $cost->update();
                } else {

                    //save data in room_type_costs
                    $cost = new Room_type_cost();
                    $cost->from_date = $pageList[$index]['from_date'];
                    $cost->end_date = $pageList[$index]['end_date'];
                    if ($pageList[$index]['food_beverage_id']) {
                        $cost->food_beverage_id = (int) $pageList[$index]['food_beverage_id'];
                    }

                    $cost->single_cost = (double) $pageList[$index]['single_cost'];
                    $cost->double_cost = (double) $pageList[$index]['double_cost'];
                    $cost->triple_cost = (double) $pageList[$index]['triple_cost'];
                    $cost->extra_bed_cost = (double) $pageList[$index]['extra_bed_cost'];
                    $cost->child_free_age_to = $pageList[$index]['child_free_age_to'];
                    $cost->child_free_age_from = $pageList[$index]['child_free_age_from'];

                    $cost->child_age_from = $pageList[$index]['child_age_from'];
                    $cost->child_age_to
                    = $pageList[$index]['child_age_to'];
                    $cost->child_age_cost = (double) $pageList[$index]['child_age_cost'];
                    if ($pageList[$index]['room_type_id']) {
                        $cost->room_type_id = (int) $pageList[$index]['room_type_id'];
                    }
                    if ($pageList[$index]['hotel_id']) {
                        $cost->hotel_id = (int) $pageList[$index]['hotel_id'];
                    }
                    $cost->save();

                }
            }
        }
        $roomCosts = Room_type_cost::get();
        $hotels = Hotel::where('active', 1)->get();
        $roomTypes = Room_type::get();
        $foods = Food_beverage::get();
        return view($this->viewName . 'price', compact('hotels', 'roomTypes', 'foods', 'roomCosts'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
