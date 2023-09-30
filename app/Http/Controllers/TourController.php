<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Http\Requests\StoreTourRequest;
use App\Http\Requests\UpdateTourRequest;
use App\Models\City;
use App\Models\Tour_type;
use App\Models\Feature;
use App\Models\Country;
use App\Models\Tag;
use App\Models\Tour_tag;
use Illuminate\Database\QueryException;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TourController extends Controller
{
    protected $object;
    protected $viewName;
    protected $routeName;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Tour $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'admin.tours.';
        $this->routeName = 'tours.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Tour::orderBy("created_at", "Desc")->get();
        $cities = City::get();

        return view($this->viewName . 'index', compact(['rows', 'cities']));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::get();
        $types = Tour_type::get();
        $features = Feature::all();
        $countries =Country::where('flag',1)->get();

        $tags = Tag::get();
        // $eventSpecialzation=[];

        return view($this->viewName . 'add', compact(['types', 'tags', 'cities', 'types', 'features', 'countries']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTourRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTourRequest $request)
    {

    //new
    DB::beginTransaction();
        try {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $input = $request->except(['_token', 'thumbnail', 'banner']);
            if ($request->hasFile('thumbnail')) {
                $attach_image = $request->file('thumbnail');

                $input['thumbnail'] = $this->UplaodImage($attach_image);
            }

            if ($request->hasFile('banner')) {
                $attach_banner = $request->file('banner');

                $input['banner'] = $this->UplaodBanner($attach_banner);
            }
            if ($request->has('active')) {

                $input['active'] = '1';
            } else {
                $input['active'] = '0';
            }


            $tour = Tour::create($input);
            if (!empty($request->get('features'))) {

                $tour->features()->attach($request->features);

            }
            if (!empty($request->get('tags'))) {

                $tour->tags()->attach($request->tags);

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function edit(Tour $tour)
    {
        $cities = City::get();
        $types = Tour_type::get();
        $features = Feature::all();


        $tourFeatures = $tour->features->all();


        $countries = Country::where('flag',1)->get();
        $tags = Tag::get();
        $tagsTour = Tour_tag::where('tour_id', $tour->id)->get();

        return view($this->viewName . 'edit', compact([ 'tags', 'tagsTour', 'tour', 'cities', 'countries', 'types', 'features', 'tourFeatures']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTourRequest  $request
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTourRequest $request, Tour $tour)
    {

    //new
    DB::beginTransaction();
        try {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $input = $request->except(['_token', 'thumbnail', 'banner']);
            if ($request->hasFile('thumbnail')) {
                $attach_image = $request->file('thumbnail');

                $input['thumbnail'] = $this->UplaodImage($attach_image);
            }

            if ($request->hasFile('banner')) {
                $attach_banner = $request->file('banner');

                $input['banner'] = $this->UplaodBanner($attach_banner);
            }
            if ($request->has('active')) {

                $input['active'] = '1';
            } else {
                $input['active'] = '0';
            }


            $tour->update($input);
            if (!empty($request->get('features'))) {

                $tour->features()->sync($request->features);

            }
            if (!empty($request->get('tags'))) {

                $tour->tags()->sync($request->tags);

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tour = Tour::where('id', $id)->first();
        // Delete File ..
        $file = $tour->banner;
        $file_name = public_path('uploads/tours/' . $file);
        try {
            File::delete($file_name);
            $tour->features()->detach();
            $tour->tags()->detach();
            $tour->delete();
            return redirect()->back()->with('flash_del', 'Successfully Delete!');

        } catch (QueryException $q) {
            //  return redirect()->back()->withInput()->with('flash_danger', $q->getMessage());
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
          $uploadPath = public_path('uploads/tours');

          // Move The image..
          $file->move($uploadPath, $imageName);

          return $imageName;
      }

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
          $uploadPath = public_path('uploads/tours');

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


            $output = '<option value=""> Select City</option>';
        foreach ($data as $row) {

            $output .= '<option value="' . $row->id . '" >' . $row->en_city . '</option>';
        }




        echo $output;
    }
}
