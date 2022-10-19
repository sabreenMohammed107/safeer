<?php

namespace App\Http\Controllers;

use App\Models\Explore_city;
use App\Http\Requests\StoreExplore_cityRequest;
use App\Http\Requests\UpdateExplore_cityRequest;
use App\Models\City;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use File;
class ExploreCityController extends Controller
{
    protected $object;
    protected $viewName;
    protected $routeName;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Explore_city $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'admin.explore.';
        $this->routeName = 'explore.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Explore_city::orderBy("created_at", "Desc")->get();
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
     * @param  \App\Http\Requests\StoreSpecialzationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except(['_token','image']);
        if ($request->hasFile('image')) {
            $attach_image = $request->file('image');

            $input['image'] = $this->UplaodImage($attach_image);
        }
        Explore_city::create($input);
        return redirect()->route($this->routeName.'index')->with('flash_success', 'Successfully Saved!');    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Specialzation  $specialzation
     * @return \Illuminate\Http\Response
     */
    public function show(Explore_city $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Specialzation  $specialzation
     * @return \Illuminate\Http\Response
     */
    public function edit(Explore_city $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *

     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Explore_city $explore)
    {

        $input = $request->except(['_token','image']);
        if ($request->hasFile('image')) {
            $attach_image = $request->file('image');

            $input['image'] = $this->UplaodImage($attach_image);
        }
        Explore_city::findOrFail($request->get('explore_id'))->update($input);
        // $specialzation->update($input);

        return redirect()->route($this->routeName.'index')->with('flash_success', 'Successfully Saved!');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Specialzation  $specialzation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $explore = Explore_city::where('id', $id)->first();
         // Delete File ..
         $file = $explore->image;
         $file_name = public_path('uploads/explore/' . $file);
         try {
             File::delete($file_name);


            $explore->delete();
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
          $uploadPath = public_path('uploads/explore');

          // Move The image..
          $file->move($uploadPath, $imageName);

          return $imageName;
      }
}
