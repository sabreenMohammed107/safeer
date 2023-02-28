<?php

namespace App\Http\Controllers;

use App\Models\OrderDetails;
use App\Models\OrderPersons;
use App\Models\Orders;
use App\Models\RoomDetails;
use App\Models\TourDetails;
use App\Models\TransferDetails;
use App\Models\VisaDetails;
use Illuminate\Http\Request;

class UsersOrderController extends Controller
{
    protected $object;
    protected $viewName;
    protected $routeName;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->viewName = 'admin.users-orders.';
        $this->routeName = 'users-orders.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = OrderDetails::orderBy("created_at", "Desc")->get();

        return view($this->viewName . 'index', compact(['rows']));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

            $order = OrderDetails::where('id', $id)->first();
            if($order->detail_type==0){
                $roomDetails = RoomDetails::
                join("order_details", "rooms_details.order_details_id", "=", "order_details.id")
                ->where('order_details.detail_type',0)->where('order_details.id',$id)->select('rooms_details.*')->get();
                $persons = OrderPersons::where('order_details_id', $id)->get();

                            $totalCost=50;
                return view($this->viewName . 'showroomDetails', compact(['order', 'roomDetails'
               , 'persons','totalCost']));
            }
            if($order->detail_type==1){

                $persons = OrderPersons::where('order_details_id', $id)->get();
                $tourDetails = TourDetails::join("order_details", "tours_details.order_details_id", "=", "order_details.id")
                ->where('order_details.detail_type',1)->where('order_details.id',$id)->select('tours_details.*')->get();

                            $totalCost=50;
                return view($this->viewName . 'showtoursDetails', compact(['order'
               , 'tourDetails', 'persons','totalCost']));
            }
            if($order->detail_type==2){
                $persons = OrderPersons::where('order_details_id', $id)->get();

                $transDetails = TransferDetails:: join("order_details", "transfer_details.order_details_id", "=", "order_details.id")
                ->where('order_details.detail_type',2)->where('order_details.id',$id)->select('transfer_details.*')->get();

                            $totalCost=50;
                return view($this->viewName . 'showtransDetails', compact(['order','transDetails', 'persons','totalCost']));
            }
            if($order->detail_type==3){
                $persons = OrderPersons::where('order_details_id', $id)->get();

                $visaDetails = VisaDetails:: join("order_details", "visa_details.order_details_id", "=", "order_details.id")
                ->where('order_details.detail_type',3)->where('order_details.id',$id)->select('visa_details.*')->get();
                            $totalCost=50;
                return view($this->viewName . 'showvisaDetails', compact(['order','visaDetails', 'persons','totalCost']));
            }


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
