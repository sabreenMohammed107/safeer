<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHotelRequest;
use App\Http\Requests\UpdateHotelRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Feature;
use App\Models\Hotel;
use App\Models\Hotel_room;
use App\Models\Hotel_type;
use App\Models\Room_type;
use App\Models\Room_type_cost;
use File;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
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
        $rows = Hotel::orderBy("created_at", "Desc")->get();
        $rooms = Room_type::all();

        return view($this->viewName . 'index', compact(['rows', 'rooms']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::get();
        $types = Hotel_type::get();
        $features = Feature::all();
        $countries = Country::all();
        // $eventSpecialzation=[];
        $types = Room_type::all();
        return view($this->viewName . 'add', compact(['types', 'cities', 'types', 'features', 'countries']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHotelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHotelRequest $request)
    {
        DB::beginTransaction();
        try {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $input = $request->except(['_token', 'hotel_logo', 'hotel_banner']);
            if ($request->hasFile('hotel_logo')) {
                $attach_image = $request->file('hotel_logo');

                $input['hotel_logo'] = $this->UplaodImage($attach_image);
            }

            if ($request->hasFile('hotel_banner')) {
                $attach_banner = $request->file('hotel_banner');

                $input['hotel_banner'] = $this->UplaodBanner($attach_banner);
            }
            if ($request->has('active')) {

                $input['active'] = '1';
            } else {
                $input['active'] = '0';
            }

            $hotel = Hotel::create($input);
            if (!empty($request->get('features'))) {

                $hotel->features()->attach($request->features);

            }
            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            return redirect()->route($this->routeName . 'index')->with('flash_success', 'تم الحفظ بنجاح');

        } catch (\Throwable$e) {
            // throw $th;
            DB::rollback();
            return redirect()->route($this->routeName . 'index')->with('flash_danger', $e->getMessage());
            return redirect()->back()->withInput()->withErrors($e->getMessage());

        }
    }

    // return redirect()->route($this->routeName.'index')->with('flash_success', 'Successfully Saved!');    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel $hotel)
    {
        $cities = City::get();
        $types = Hotel_type::get();
        $features = Feature::all();
        $hotelFeatures = $hotel->features->all();
        $countries = Country::all();
        $roomsTypes = Hotel_room::where('hotel_id', $hotel->id)->get();
        $hotelRoomsCost = Room_type_cost::whereHas('hotelRooms', function ($q) use ($hotel) {
            $q->where('hotel_id', '=', $hotel->id);
        })->get();
        return view($this->viewName . 'edit', compact(['roomsTypes', 'hotelRoomsCost', 'hotel', 'cities', 'countries', 'types', 'features', 'hotelFeatures']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHotelRequest  $request
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHotelRequest $request, Hotel $hotel)
    {

        DB::beginTransaction();
        try {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $input = $request->except(['_token', 'hotel_logo', 'hotel_banner']);
            if ($request->hasFile('hotel_logo')) {
                $attach_image = $request->file('hotel_logo');

                $input['hotel_logo'] = $this->UplaodImage($attach_image);
            }

            if ($request->hasFile('hotel_banner')) {
                $attach_banner = $request->file('hotel_banner');

                $input['hotel_banner'] = $this->UplaodImage($attach_banner);
            }


            if ($request->has('active')) {

                $input['active'] = '1';
            } else {
                $input['active'] = '0';
            }

            $hotel->update($input);
            // $hotel=Hotel::create($input);
            if (!empty($request->get('features'))) {

                $hotel->features()->sync($request->features);

            }
            //repeat data
            $pageList = $request->kt_ecommerce_add_product_options;

            $roomsIds = [];
            foreach ($pageList as $index => $opt) {

                $room_id = (int) $pageList[$index]['room_type_id'];
                if ($room_id != 0) {
                    array_push($roomsIds, $room_id);
                }

            }
            $hotelIds = [];
            foreach ($pageList as $index => $opt) {

                $hotel_id = (int) $pageList[$index]['hotel_id'];
                if ($hotel_id != 0) {
                    array_push($hotelIds, $hotel_id);
                }

            }

            //if delete
            $hotelRoomsCost = Room_type_cost::get();
            foreach ($hotelRoomsCost as $rCost) {
                foreach ($pageList as $index => $opt) {
                    $hotelRoomsId = Hotel_room::where('hotel_id', (int) $pageList[0]['hotel_id'])->
                        where('room_type_id', $roomsIds)->first();

                    if ($rCost->hotel_room_id != $hotelRoomsId->id) {


                        $rCost->delete();

                }
            }
        }
            $hotelRoomsIds = Hotel_room::where('hotel_id', (int) $pageList[0]['hotel_id'])->
                whereIN('room_type_id', $roomsIds)->pluck('id');

            foreach ($pageList as $index => $opt) {

                $hotelRoomsId = Hotel_room::where('hotel_id', (int) $pageList[0]['hotel_id'])->
                    where('room_type_id', (int) $pageList[$index]['room_type_id'])->first();

                    $evDay = Room_type_cost::firstOrNew([
                        'from_date' => $pageList[$index]['from_date'],
                        'end_date' => $pageList[$index]['end_date'],
                        'cost' => $pageList[$index]['cost'],
                        'hotel_room_id' => $hotelRoomsId->id,


                    ]);

                    $evDay->from_date = $pageList[$index]['from_date'];
                    $evDay->end_date =$pageList[$index]['end_date'];
                    $evDay->cost = $pageList[$index]['cost'];
                    $evDay->hotel_room_id = $hotelRoomsId->id;


                    $evDay->save();
                // foreach($hotelRoomsIds as $hotelRoomsId){
                // $obj = Room_type_cost::where('hotel_room_id', $hotelRoomsId)
                // ->where('from_date','=', $pageList[$index]['from_date'])
                // ->where('end_date','=', $pageList[$index]['end_date'])
                // ->where('cost','=', $pageList[$index]['cost'])
                // ->first();
                // if ($obj) {
                //     $obj->from_date = $pageList[$index]['from_date'];
                //     $obj->end_date = $pageList[$index]['end_date'];
                //     $obj->cost = $pageList[$index]['cost'];
                //     $obj->update();

                // }
                // else {

                //     $newId = Hotel_room::where('hotel_id', (int) $pageList[0]['hotel_id'])->
                //         where('room_type_id', (int) $pageList[$index]['room_type_id'])->first();
                //     if ($newId) {

                //         $newObj = new Room_type_cost();
                //         $newObj->from_date = $pageList[$index]['from_date'];
                //         $newObj->end_date = $pageList[$index]['end_date'];
                //         $newObj->cost = $pageList[$index]['cost'];
                //         $newObj->hotel_room_id = $newId->id;
                    //     $newObj->save();
                    // }

                // }
            }

            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            return redirect()->route($this->routeName . 'index')->with('flash_success', 'تم الحفظ بنجاح');

        } catch (\Throwable$e) {
            // throw $th;
            DB::rollback();
            return redirect()->back()->withInput()->withErrors($e->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hotel = Hotel::where('id', $id)->first();
        // Delete File ..
        $file = $hotel->hotel_logo;
        $file_name = public_path('uploads/hotels/' . $file);
        $file2 = $hotel->hotel_banner;
        $file_name2 = public_path('uploads/hotels/' . $file2);
        try {
            File::delete($file_name);
            File::delete($file_name2);

            $hotel->delete();
            return redirect()->back()->with('flash_del', 'Successfully Delete!');

        } catch (QueryException $q) {
            // return redirect()->back()->withInput()->with('flash_danger', $q->getMessage());
            return redirect()->back()->withInput()->with('flash_danger', 'Can’t delete This Row
            Because it related with another table');
        }
    }

    /* uplaud image
     */
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
        $uploadPath = public_path('uploads/hotels');

        // Move The image..
        $file->move($uploadPath, $imageName);

        return $imageName;
    }

    /* uplaud image
     */
    public function UplaodBanner($file_request)
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
        $uploadPath = public_path('uploads/hotels');

        // Move The image..
        $file->move($uploadPath, $imageName);

        return $imageName;
    }

    /**
     * dependace sub category
     */
    public function fetchCat(Request $request)
    {

        $select = $request->get('select');
        $value = $request->get('value');

        $data = City::where('country_id', $value)->get();
        $output = '<option value="">Select City</option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->en_city . '</option>';
        }
        echo $output;
    }
/**
 *
 * editingRooms
 */
    public function editingRooms(Request $request)
    {

        $input = [
            'no_rooms' => $request->get('no_rooms'),
            'room_type_id' => $request->get('room_type_id'),
            'hotel_id' => $request->get('hotel_id'),
        ];
        Hotel_room::create($input);
        return redirect()->route($this->routeName . 'index')->with('flash_success', 'Successfully Saved!');}
}
