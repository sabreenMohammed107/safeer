<?php

namespace App\Http\Controllers;

use App\Models\OrderDetails;
use App\Models\OrderPersons;
use App\Models\RoomDetails;
use App\Models\TourDetails;
use App\Models\TransferDetails;
use App\Models\VisaDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        if ($order->detail_type == 0) {
            $roomDetails = RoomDetails::
                join("order_details", "rooms_details.order_details_id", "=", "order_details.id")
                ->where('order_details.detail_type', 0)->where('order_details.id', $id)->select('rooms_details.*')->get();
            $persons = OrderPersons::where('order_details_id', $id)->get();

            $totalCost = 50;
            return view($this->viewName . 'showroomDetails', compact(['order', 'roomDetails'
                , 'persons', 'totalCost']));
        }
        if ($order->detail_type == 1) {

            $persons = OrderPersons::where('order_details_id', $id)->get();
            $tourDetails = TourDetails::join("order_details", "tours_details.order_details_id", "=", "order_details.id")
                ->where('order_details.detail_type', 1)->where('order_details.id', $id)->select('tours_details.*')->get();

            $totalCost = 50;
            return view($this->viewName . 'showtoursDetails', compact(['order'
                , 'tourDetails', 'persons', 'totalCost']));
        }
        if ($order->detail_type == 2) {
            $persons = OrderPersons::where('order_details_id', $id)->get();

            $transDetails = TransferDetails::join("order_details", "transfer_details.order_details_id", "=", "order_details.id")
                ->where('order_details.detail_type', 2)->where('order_details.id', $id)->select('transfer_details.*')->get();

            $totalCost = 50;
            return view($this->viewName . 'showtransDetails', compact(['order', 'transDetails', 'persons', 'totalCost']));
        }
        if ($order->detail_type == 3) {
            $persons = OrderPersons::where('order_details_id', $id)->get();

            $visaDetails = VisaDetails::join("order_details", "visa_details.order_details_id", "=", "order_details.id")
                ->where('order_details.detail_type', 3)->where('order_details.id', $id)->select('visa_details.*')->get();
            $totalCost = 50;
            return view($this->viewName . 'showvisaDetails', compact(['order', 'visaDetails', 'persons', 'totalCost']));
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
        $order = OrderDetails::where('id', $id)->first();

        // if($order->detail_type==1){

        $persons = OrderPersons::where('order_details_id', $id)->get();
        $tourDetails = TourDetails::join("order_details", "tours_details.order_details_id", "=", "order_details.id")
            ->where('order_details.detail_type', 1)->where('order_details.id', $id)->select('tours_details.*')->get();

        $totalCost = 50;
        return view($this->viewName . 'edittoursDetails', compact(['order'
            , 'tourDetails', 'persons', 'totalCost']));
        // }
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

    //updates
    public function EditTourDetails(Request $request)
    {

        TourDetails::findOrFail($request->detail_id)->update([
            'tour_date' => $request->tour_date,
        ]);
        return redirect()->back()->with('flash_del', 'Update tour Details!');

    }

    public function EditholderDetails(Request $request)
    {

        OrderDetails::findOrFail($request->order_id)->update([
            'holder_salutation' => $request->holder_salutation,
            'holder_name' => $request->holder_name,
            'holder_mobile' => $request->holder_mobile,
            'holder_email' => $request->holder_email,

        ]);
        return redirect()->back()->with('flash_del', 'Update Holder Details!');

    }

    public function EditTourPersons(Request $request)
    {
        dd($request->all());
    }

    public function deleteTourPersons(Request $request)
    {
        $person = OrderPersons::where('id', $request->preson_id)->first();
        $order = OrderDetails::where('id', $request->order_details_id)->first();

        //update data
        $details = TourDetails::where('order_details_id', $request->order_details_id)->first();
        if ($person->person_type == 0) {
            $details->update([
                'total_cost' => $details->total_cost - $person->person_cost,
                'adults_count' => $details->adults_count - 1,
            ]);
        } else {
            if ($person->age > 2) {
                $details->update([
                    'total_cost' => $details->total_cost - $person->person_cost,
                    'children_count' => $details->children_count - 1,
                ]);
            } else {
                $details->update([
                    'children_count' => $details->children_count - 1,
                ]);
            }

        }
        $person->delete();

        return redirect()->back()->with('flash_del', 'delete person !');

    }

    public function AddAdultTourPersons(Request $request)
    {
        DB::beginTransaction();
        try {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $details = TourDetails::where('order_details_id', $request->order_details_id)->first();
            $person = new OrderPersons();
            $person->order_details_id = $request->order_details_id;
            $person->person_type = 0; // Adult byte
            $person->person_salutation = $request->person_salutation;
            $person->person_name = $request->person_name;
            $person->person_mobile = $request->person_mobile;
            $person->person_cost = $details->tour_cost;
            $person->person_email = $request->person_email;
            $person->save();

            $details->update([
                'total_cost' => $details->total_cost + $person->person_cost,
                'adults_count' => $details->adults_count + 1,
            ]);

            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->back()->with('flash_del', 'add adult !');

        } catch (\Throwable $e) {
            // throw $th;
            DB::rollback();
        return redirect()->back()->with('flash_del', $e->getMessage());

        }

    }

    public function AddChildTourPersons(Request $request)
    {
        DB::beginTransaction();
        try {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $details = TourDetails::where('order_details_id', $request->order_details_id)->first();

            $person = new OrderPersons();
            $person->order_details_id = $request->order_details_id;
            $person->person_type = 1; // Child byte
            $person->person_salutation = "";
            $person->person_mobile = "";
            $person->person_name = $request->person_name;

            $person->person_cost =((int) $request->age > 2) ? $details->tour_cost : 0;
            $person->age = $request->age;
            $person->save();
if((int) $request->age > 2){
            $details->update([
                'total_cost' => $details->total_cost + $person->person_cost,
                'children_count' => $details->adults_count + 1,
            ]);
        } else {
            $details->update([
                'children_count' => $details->children_count +1 ,
            ]);
        }

            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->back()->with('flash_del', 'add child !');

        } catch (\Throwable $e) {
            // throw $th;
            DB::rollback();
        return redirect()->back()->with('flash_del', $e->getMessage());

        }

    }
}
