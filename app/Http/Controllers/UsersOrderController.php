<?php

namespace App\Http\Controllers;

use App\Models\Assign_order;
use App\Models\Country;
use App\Models\Nationality;
use App\Models\OrderDetails;
use App\Models\OrderPersons;
use App\Models\RoomDetails;
use App\Models\Status;
use App\Models\TourDetails;
use App\Models\Transfer;
use App\Models\TransferDetails;
use App\Models\User;
use App\Models\Users_role;
use App\Models\Visa;
use App\Models\VisaDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

        $sellersIds = Users_role::where('role_id', 2)->pluck('user_id');
        $sellers = User::whereIn('id', $sellersIds)->get();
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            $rows = OrderDetails::orderBy("created_at", "Desc")->get();
        } else{
            $ordersIds = Assign_order::where('user_id', Auth::user()->id)->pluck('order_details_id');
            $rows = OrderDetails::whereIn('id', $ordersIds)->get();
        }

        return view($this->viewName . 'index', compact(['rows', 'sellers']));
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
        $statuses = Status::all();
        if ($order->detail_type == 1) {

            $persons = OrderPersons::where('order_details_id', $id)->get();
            $tourDetails = TourDetails::join("order_details", "tours_details.order_details_id", "=", "order_details.id")
                ->where('order_details.detail_type', 1)->where('order_details.id', $id)->select('tours_details.*')->get();

            $totalCost = 50;
            return view($this->viewName . 'edittoursDetails', compact(['order'
                , 'tourDetails', 'persons', 'totalCost', 'statuses']));
        }

        if ($order->detail_type == 2) {
            $persons = OrderPersons::where('order_details_id', $id)->get();
            $transfers = Transfer::all();
            $transDetails = TransferDetails::join("order_details", "transfer_details.order_details_id", "=", "order_details.id")
                ->where('order_details.detail_type', 2)->where('order_details.id', $id)->select('transfer_details.*')->get();

            $totalCost = 50;
            return view($this->viewName . 'edittransDetails', compact(['order', 'transfers', 'transDetails', 'persons', 'totalCost', 'statuses']));
        }

        if ($order->detail_type == 3) {
            $persons = OrderPersons::where('order_details_id', $id)->get();
            $countries = Country::all();
            $nationality_ids = Visa::pluck('nationality_id');
            $nationalities = Nationality::whereIn('id', $nationality_ids)->get();
            $visas = Visa::all();
            $visaDetails = VisaDetails::join("order_details", "visa_details.order_details_id", "=", "order_details.id")
                ->where('order_details.detail_type', 3)->where('order_details.id', $id)->select('visa_details.*')->get();
            $totalCost = 50;
            return view($this->viewName . 'editvisaDetails', compact(['order',
                'visaDetails', 'persons', 'totalCost'

                , 'countries', 'nationality_ids', 'nationalities', 'visas', 'statuses']));
        }
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
        // dd($request->all());
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

            $person->person_cost = ((int) $request->age > 2) ? $details->tour_cost : 0;
            $person->age = $request->age;
            $person->save();
            if ((int) $request->age > 2) {
                $details->update([
                    'total_cost' => $details->total_cost + $person->person_cost,
                    'children_count' => $details->adults_count + 1,
                ]);
            } else {
                $details->update([
                    'children_count' => $details->children_count + 1,
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
/***
 * trans editing
 */
    public function EditTransDetails(Request $request)
    {
        $transfer = Transfer::where('id', $request->transfer_id)->first();
        $capacity = $transfer->carModel->capacity;
        $validator = Validator::make($request->all(), [
            'capacity' => 'required|integer|min:1|between: 1,' . $capacity . '',
            'transfer_date' => ['required', 'after:today'],

        ]);

        if ($validator->fails()) {
            $data['autoOpenModal'] = true;
            return Redirect::back()->withErrors($validator)->withInput($data);
        }

        TransferDetails::findOrFail($request->detail_id)->update([
            'transfer_date' => $request->transfer_date,
            'transfer_from' => $transfer->locationFrom->location_enname ?? '',
            'transfer_to' => $transfer->locationTo->location_enname ?? '',
            'car_model' => $transfer->carModel->model_arname ?? '',
            'car_class' => $transfer->carClass->class_enname ?? '',
            'hotel_name' => $request->hotel_name,
            'car_capacity' => $capacity,

            'is_return' => ($request->default_holder) ? true : false,
            'return_date' => ($request->default_holder) ? $request->return : null,
            'transfer_person_price' => $transfer->person_price,
            'transfer_total_cost' => $transfer->person_price * $request->capacity,
        ]);
        return redirect()->back()->with('flash_del', 'Update transfer Details!');
    }

    public function EditVisaDetails(Request $request)
    {
        $obj = VisaDetails::findOrFail($request->detail_id);
        if (optional($obj->visa_personal_photo)->isNotEmpty()) {
            Storage::disk('public')->delete('uploads/visas/', $obj->visa_personal_photo);
        }
        if (optional($obj->visa_passport_photo)->isNotEmpty()) {
            Storage::disk('public')->delete('uploads/visas/', $obj->visa_passport_photo);
        }
        $passport = Storage::disk('public')->put('uploads/visas/', $request->passport);
        $personal = Storage::disk('public')->put('uploads/visas/', $request->personal);
        VisaDetails::findOrFail($request->detail_id)->update([
            'visa_id' => $request->visa_id,
            'visa_personal_photo' => basename($personal),
            'visa_passport_photo' => basename($passport),

        ]);
        $orderDetails = OrderDetails::where('id', $request->order_id)->update([
            'holder_name' => $request->name,
            'holder_mobile' => $request->phone,
            'holder_email' => $request->email,
        ]);

        return redirect()->back()->with('flash_del', 'Update Visa Details!');
    }

    public function updateStatus(Request $request)
    {

        $order = OrderDetails::where('id', $request->get('order'))->first();
        $input = ['status_id' => $request->get('value')];

        OrderDetails::where('id', $request->get('order'))->update($input);
        \Log::info($request->all());
        return true;
    }

    public function receiptSave(Request $request)
    {

        $input = $request->except(['_token', 'order_id', 'receipt_image']);
        $order = OrderDetails::where('id', $request->get('order_id'))->first();
        if ($request->hasFile('receipt_image')) {
            $attach_image = $request->file('receipt_image');

            $input['receipt_image'] = $this->UplaodImage($attach_image);
        }

        // Tour::findOrFail($request->get('tour_id'))->update($input);
        if ($order) {
            $order->update($input);

        }
        return redirect()->back()->with('flash_success', 'Successfully Saved!');
    }

    public function UplaodImage($file_request)
    {
        //  This is Image Info..
        $file = $file_request;
        $name = $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();
        $size = $file->getSize();
        $path = $file->getRealPath();
        $mime = $file->getMimeType();

        // Rename The Image ..
        $imageName = $name;
        $uploadPath = public_path('uploads/orders');

        // Move The image..
        $file->move($uploadPath, $imageName);

        return $imageName;
    }

    public function storeAssign(Request $request)
    {

        // $user = User::where('id', $request->get('seller_id'))->first();
        // $input = [
        //     'order_details_id' => $request->get('order_details_id'),
        //     'user_id' => $request->get('seller_id'),
        // ];
        // Assign_order::create($input);

        $user = Assign_order::firstOrCreate(
            ['order_details_id' => $request->get('order_details_id')],
            ['user_id' => $request->get('seller_id')]
        );

        return redirect()->back()->with('flash_del', 'Successfully Assign!');

    }
}
