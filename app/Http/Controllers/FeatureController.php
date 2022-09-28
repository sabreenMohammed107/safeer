<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Http\Requests\StoreFeatureRequest;
use App\Http\Requests\UpdateFeatureRequest;
use App\Models\Features_category;
use Illuminate\Database\QueryException;
use File;
class FeatureController extends Controller
{
    protected $object;
    protected $viewName;
    protected $routeName;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Feature $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'admin.features.';
        $this->routeName = 'features.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Feature::orderBy("created_at", "Desc")->get();
        $categories = Features_category::get();

        return view($this->viewName . 'index', compact(['rows', 'categories']));
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
     * @param  \App\Http\Requests\StoreFeatureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFeatureRequest $request)
    {
        $input = $request->except(['_token','icon']);
        if ($request->hasFile('icon')) {
            $attach_image = $request->file('icon');

            $input['icon'] = $this->UplaodImage($attach_image);
        }

        Feature::create($input);
        return redirect()->route($this->routeName.'index')->with('flash_success', 'Successfully Saved!');    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function show(Feature $feature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function edit(Feature $feature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFeatureRequest  $request
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFeatureRequest $request, Feature $feature)
    {
        $input = $request->except(['_token','feature_id','icon']);
        if ($request->hasFile('icon')) {
            $attach_image = $request->file('icon');

            $input['icon'] = $this->UplaodImage($attach_image);
        }


        // Tour::findOrFail($request->get('tour_id'))->update($input);
        $feature->update($input);
        return redirect()->route($this->routeName.'index')->with('flash_success', 'Successfully Saved!');    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feature = Feature::where('id', $id)->first();
         // Delete File ..
         $file = $feature->icon;
         $file_name = public_path('uploads/features/' . $file);
         try {
             File::delete($file_name);

            $feature->delete();
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
          $uploadPath = public_path('uploads/features');

          // Move The image..
          $file->move($uploadPath, $imageName);

          return $imageName;
      }
}
