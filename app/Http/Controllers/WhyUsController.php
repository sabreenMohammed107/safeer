<?php

namespace App\Http\Controllers;

use App\Models\Why_us;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use File;
class WhyUsController extends Controller
{
    protected $object;
    protected $viewName;
    protected $routeName;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Why_us $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'admin.why-us.';
        $this->routeName = 'why-us.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Why_us::orderBy("created_at", "Desc")->get();


        return view($this->viewName . 'index', compact(['rows']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view($this->viewName . 'add');

    }

    /**
     * Store a newly created resource in storage.
     *

     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except(['_token','image']);
        if ($request->hasFile('image')) {
            $attach_image = $request->file('image');

            $input['icon'] = $this->UplaodImage($attach_image);
        }

        Why_us::create($input);
        return redirect()->route($this->routeName.'index')->with('flash_success', 'Successfully Saved!');    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Why_us::where('id',$id)->first();

        return view($this->viewName . 'edit', compact(['row']));
    }

    /**
     * Update the specified resource in storage.
     *


     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $row = Why_us::where('id',$id)->first();
        $input = $request->except(['_token','why_id','image']);
        if ($request->hasFile('image')) {
            $attach_image = $request->file('image');

            $input['icon'] = $this->UplaodImage($attach_image);
        }


        // Tour::findOrFail($request->get('tour_id'))->update($input);
        $row->update($input);
        return redirect()->route($this->routeName.'index')->with('flash_success', 'Successfully Saved!');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $row = Why_us::where('id',$id)->first();
        // Delete File ..
        $file = $row->icon;
        $file_name = public_path('uploads/whyUs/' . $file);
        try {
            File::delete($file_name);

            $row->delete();
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
          $uploadPath = public_path('uploads/whyUs');

          // Move The image..
          $file->move($uploadPath, $imageName);

          return $imageName;
      }
}

