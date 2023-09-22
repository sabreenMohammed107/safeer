<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\Models\City;
use Illuminate\Database\QueryException;
use File;
class OfferController extends Controller
{
    protected $object;
    protected $viewName;
    protected $routeName;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Offer $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'admin.offers.';
        $this->routeName = 'offers.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Offer::orderBy("created_at", "Desc")->get();
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
        return view($this->viewName . 'add',compact(['cities']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOfferRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOfferRequest $request)
    {
        $input = $request->except(['_token','image']);
        if ($request->hasFile('image')) {
            $attach_image = $request->file('image');

            $input['image'] = $this->UplaodImage($attach_image);
        }
        if ($request->has('active')) {

            $input['active'] = '1';
        } else {
            $input['active'] = '0';
        }
        if ($request->has('status')) {

            $input['status'] = 'main';
        } else {
            $input['status'] = 'basic';
        }
        Offer::create($input);
        return redirect()->route($this->routeName.'index')->with('flash_success', 'Successfully Saved!');    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        $cities = City::get();
        return view($this->viewName . 'edit', compact(['offer','cities']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOfferRequest  $request
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOfferRequest $request, Offer $offer)
    {
        $input = $request->except(['_token','offer_id','image']);
        if ($request->hasFile('image')) {
            $attach_image = $request->file('image');

            $input['image'] = $this->UplaodImage($attach_image);
        }
        if ($request->has('active')) {

            $input['active'] = '1';
        } else {
            $input['active'] = '0';
        }
        if ($request->has('status')) {

            $input['status'] = 'main';
        } else {
            $input['status'] = 'basic';
        }
        // Tour::findOrFail($request->get('tour_id'))->update($input);
        $offer->update($input);
        return redirect()->route($this->routeName.'index')->with('flash_success', 'Successfully Saved!');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tour = Offer::where('id', $id)->first();
        // Delete File ..
        $file = $tour->banner;
        $file_name = public_path('uploads/ofers/' . $file);
        try {
            File::delete($file_name);

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
          $uploadPath = public_path('uploads/offers');

          // Move The image..
          $file->move($uploadPath, $imageName);

          return $imageName;
      }
}
