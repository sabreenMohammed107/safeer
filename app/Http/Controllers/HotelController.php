<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Http\Requests\StoreHotelRequest;
use App\Http\Requests\UpdateHotelRequest;
use App\Models\City;
use App\Models\Feature;
use App\Models\Room_type;

use File;
use Illuminate\Database\QueryException;
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


        return view($this->viewName . 'index', compact(['rows']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::get();
        $types = Room_type::get();
        $features = Feature::all();
        return view($this->viewName . 'add', compact(['cities','types','features']));
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
        $input = $request->except(['_token','hotel_logo','']);
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

        $hotel=Hotel::create($input);
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
        return redirect()->route($this->routeName . 'index')->with('flash_danger',$e->getMessage());
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
        $types = Room_type::get();
        $features = Feature::all();
        $hotelFeatures = $hotel->features->all();
        return view($this->viewName . 'edit', compact(['hotel','cities','types','features','hotelFeatures']));
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
        $input = $request->except(['_token','hotel_logo','']);
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
        $hotel->update($input);
        // $hotel=Hotel::create($input);
        if (!empty($request->get('features'))) {

            $hotel->features()->sync($request->features);

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
        $Hotel = Hotel::where('id', $id)->first();
        try {

            $Hotel->delete();
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
}
