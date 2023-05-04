<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHotelRequest;
use App\Http\Requests\UpdateHotelRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Feature;
use App\Models\Hotel;
use App\Models\Hotel_room;
use App\Models\Hotel_tag;
use App\Models\Hotel_type;
use App\Models\Room_type;
use App\Models\Room_type_cost;
use App\Models\Tag;
use App\Models\Zone;
use File;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
        $rooms = Room_type::all();
        $zones = Zone::all();
        $tags = Tag::get();
        // $eventSpecialzation=[];
        $types = Room_type::all();
        return view($this->viewName . 'add', compact(['types', 'tags', 'rooms', 'cities', 'types', 'features', 'countries', 'zones']));
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
            $input = $request->except(['_token', 'hotel_logo', 'hotel_banner', 'google_place']);
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
            $input['keywords'] = str_replace('"', '', $request->keywords);

            //place url

            $data = $request->get('google_place');
            $last_index_of_i = strripos($data, ':');

            $whatIWant = substr($data, $last_index_of_i + 1);
            $first_index_of_i = stripos($whatIWant, '!');

            $whatIWant2 = substr($whatIWant, 0, $first_index_of_i);

            $input['google_place'] = $whatIWant2;

            $hotel = Hotel::create($input);
            if (!empty($request->get('features'))) {

                $hotel->features()->attach($request->features);

            }
            if (!empty($request->get('tags'))) {

                $hotel->tags()->attach($request->tags);

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
        return view($this->viewName . 'price');
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
        $rooms = Room_type::all();
        $zones = Zone::all();

        $hotelFeatures = $hotel->features->all();
        $hotelRooms = [];
        if ($hotel->rooms) {
            $hotelRooms = $hotel->rooms->all();
        }

        $countries = Country::all();
        $roomsTypes = Hotel_room::where('hotel_id', $hotel->id)->get();
        $tags = Tag::get();
        $tagsHotel = Hotel_tag::where('hotel_id', $hotel->id)->get();
        $hotelRoomsCost = Room_type_cost::whereHas('hotelRooms', function ($q) use ($hotel) {
            $q->where('hotel_id', '=', $hotel->id);
        })->get();
        return view($this->viewName . 'edit', compact(['roomsTypes', 'tags', 'tagsHotel', 'rooms', 'hotelRooms', 'zones', 'hotelRoomsCost', 'hotel', 'cities', 'countries', 'types', 'features', 'hotelFeatures']));
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
            $input = $request->except(['_token', 'hotel_logo', 'hotel_banner', 'google_place']);
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
            $data = $request->get('google_place');
            $last_index_of_i = strripos($data, ':');

            $whatIWant = substr($data, $last_index_of_i + 1);
            $first_index_of_i = stripos($whatIWant, '!');

            $whatIWant2 = substr($whatIWant, 0, $first_index_of_i);

            $input['google_place'] = $whatIWant2;

            $hotel->update($input);
            // $hotel=Hotel::create($input);
            if (!empty($request->get('features'))) {

                $hotel->features()->sync($request->features);

            }
            if (!empty($request->get('tags'))) {

                $hotel->tags()->sync($request->tags);

            }
            //repeat data
            $pageList = $request->kt_ecommerce_add_product_options;

            $roomsIds = [];
            if ($pageList) {
                foreach ($pageList as $index => $opt) {

                    $room_id = (int) $pageList[$index]['room_type_id'];
                    if ($room_id != 0) {
                        array_push($roomsIds, $room_id);
                    }

                }
            }

            $hotelIds = [];
            if ($pageList) {
                foreach ($pageList as $index => $opt) {

                    $hotel_id = (int) $pageList[$index]['hotel_id'];
                    if ($hotel_id != 0) {
                        array_push($hotelIds, $hotel_id);
                    }

                }
            }

            //if delete
            $hotelRoomsCost = Room_type_cost::get();
            if ($hotelRoomsCost) {
                foreach ($hotelRoomsCost as $rCost) {
                    if ($pageList) {
                        foreach ($pageList as $index => $opt) {

                            $hotelRoomsId = Hotel_room::where('hotel_id', (int) $pageList[0]['hotel_id'])->
                                where('room_type_id', $roomsIds)->first();
                            if ($hotelRoomsId) {
                                if ($rCost->hotel_room_id != $hotelRoomsId->id) {

                                    $rCost->delete();

                                }
                            }

                        }
                    }
                }
            }
            $hotelRoomsIds = Hotel_room::where('hotel_id', (int) $pageList[0]['hotel_id'])->
                whereIN('room_type_id', $roomsIds)->pluck('id');
            if ($pageList) {
                foreach ($pageList as $index => $opt) {

                    $hotelRoomsId = Hotel_room::where('hotel_id', (int) $pageList[0]['hotel_id'])->
                        where('room_type_id', (int) $pageList[$index]['room_type_id'])->first();
                    if ($hotelRoomsId) {
                        $evDay = Room_type_cost::firstOrNew([
                            'from_date' => $pageList[$index]['from_date'],
                            'end_date' => $pageList[$index]['end_date'],
                            'cost' => $pageList[$index]['cost'],
                            'hotel_room_id' => $hotelRoomsId->id,

                        ]);

                        $evDay->from_date = $pageList[$index]['from_date'];
                        $evDay->end_date = $pageList[$index]['end_date'];
                        $evDay->cost = $pageList[$index]['cost'];
                        $evDay->hotel_room_id = $hotelRoomsId->id;

                        $evDay->save();

                    }
                }
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
             return redirect()->back()->withInput()->with('flash_danger', $q->getMessage());
            // return redirect()->back()->withInput()->with('flash_danger', 'Can’t delete This Row
            // Because it related with another table');
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
        if (LaravelLocalization::getCurrentLocale() === 'en')
        {

            $output = '<option value=""> Select City</option>';
        foreach ($data as $row) {
            if(session()->has('sessionArr')){
                $output = '<option value="'.Session::get('sessionArr')['city_id'].'" selected >' . $row->en_city . '</option>';
            }
            $output .= '<option value="' . $row->id . '" >' . $row->en_city . '</option>';
        }


        }else{
            $output = '<option value="">اختر المدينة</option>';
        foreach ($data as $row) {
            if(session()->has('sessionArr')){
                $output = '<option value="'.Session::get('sessionArr')['city_id'].'" selected >' . $row->ar_city . '</option>';
            }
            $output .= '<option value="' . $row->id . '">' . $row->ar_city . '</option>';
        }
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

    public function autocompleteSearch(Request $request)
    {
        $data = Hotel::select("keywords as value", "id")
            ->where('keywords', 'LIKE', '%' . $request->get('search') . '%')
            ->get();
        \Log::info('test');

        return response()->json($data);
    }

}
