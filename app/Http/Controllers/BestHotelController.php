<?php

namespace App\Http\Controllers;

use App\Models\Best_hotel;
use App\Http\Requests\StoreBest_hotelRequest;
use App\Http\Requests\UpdateBest_hotelRequest;
use App\Models\Hotel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class BestHotelController extends Controller
{
    protected $object;
    protected $viewName;
    protected $routeName;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Best_hotel $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'admin.best-hotel.';
        $this->routeName = 'best-hotel.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Best_hotel::orderBy("created_at", "Desc")->get();

$hotels=Hotel::all();

        return view($this->viewName . 'index', compact(['rows','hotels']));
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
        $input = $request->except(['_token']);

        Best_hotel::create($input);
        return redirect()->route($this->routeName.'index')->with('flash_success', 'Successfully Saved!');    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Best_hotel  $best_hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Best_hotel $best_hotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Best_hotel  $best_hotel
     * @return \Illuminate\Http\Response
     */
    public function edit(Best_hotel $best_hotel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *

     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Best_hotel $best_hotel)
    {

        $input = $request->except(['_token']);

        Best_hotel::findOrFail($request->get('best_id'))->update($input);
        // $specialzation->update($input);

        return redirect()->route($this->routeName.'index')->with('flash_success', 'Successfully Saved!');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $best_hotel = Best_hotel::where('id', $id)->first();

         try {


            $best_hotel->delete();
            return redirect()->back()->with('flash_del', 'Successfully Delete!');

        } catch (QueryException $q) {
            // return redirect()->back()->withInput()->with('flash_danger', $q->getMessage());
            return redirect()->back()->withInput()->with('flash_danger', 'Can’t delete This Row
            Because it related with another table');
        }
    }



}
