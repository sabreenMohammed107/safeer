<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Http\Requests\StoreTourRequest;
use App\Http\Requests\UpdateTourRequest;
use App\Models\City;
use Illuminate\Database\QueryException;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTourRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTourRequest $request)
    {
        $input = $request->except(['_token','banner']);
        if ($request->hasFile('banner')) {
            $attach_image = $request->file('banner');

            $input['banner'] = $this->UplaodImage($attach_image);
        }
        if ($request->has('active')) {

            $input['active'] = '1';
        } else {
            $input['active'] = '0';
        }
        Tour::create($input);
        return redirect()->route($this->routeName.'index')->with('flash_success', 'Successfully Saved!');    }

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
        //
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
        $input = $request->except(['_token','tour_id','banner']);
        if ($request->hasFile('banner')) {
            $attach_image = $request->file('banner');

            $input['banner'] = $this->UplaodImage($attach_image);
        }
        if ($request->has('active')) {

            $input['active'] = '1';
        } else {
            $input['active'] = '0';
        }

        // Tour::findOrFail($request->get('tour_id'))->update($input);
        $tour->update($input);
        return redirect()->route($this->routeName.'index')->with('flash_success', 'Successfully Saved!');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tour = Tour::where('id', $id)->first();
        try {

            $tour->delete();
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
          $uploadPath = public_path('uploads/tours');

          // Move The image..
          $file->move($uploadPath, $imageName);

          return $imageName;
      }
}
