<?php

namespace App\Http\Controllers;

use App\Models\Car_class;
use App\Models\Car_model;
use App\Models\Currency;
use App\Models\Transfer;
use App\Models\Transfer_location;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    protected $object;
    protected $viewName;
    protected $routeName;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Transfer $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'admin.transfer.';
        $this->routeName = 'transfer.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Transfer::orderBy("created_at", "Desc")->get();

        return view($this->viewName . 'index', compact(['rows']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transferFrom = Transfer_location::all();
        $transferTo = Transfer_location::all();
        $carModel = Car_model::all();
        $carClass = Car_class::all();
        $currancies = Currency::all();
        return view($this->viewName . 'add', compact(['transferFrom', 'transferTo', 'carModel', 'carClass', 'currancies']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except(['_token']);

        Transfer::create($input);
        return redirect()->route($this->routeName . 'index')->with('flash_success', 'Successfully Saved!');}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Transfer::where('id', $id)->first();
        $transferFrom = Transfer_location::all();
        $transferTo = Transfer_location::all();
        $carModel = Car_model::all();
        $carClass = Car_class::all();
        $currancies = Currency::all();
        return view($this->viewName . 'edit', compact(['row', 'transferFrom', 'transferTo', 'carModel', 'carClass', 'currancies']));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->except(['_token']);

        Transfer::findOrFail($id)->update($input);
        return redirect()->route($this->routeName . 'index')->with('flash_success', 'Successfully Saved!');}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = Transfer::where('id', $id)->first();

        try {

            $car->delete();
            return redirect()->back()->with('flash_del', 'Successfully Delete!');

        } catch (QueryException $q) {
             return redirect()->back()->withInput()->with('flash_danger', $q->getMessage());
            // return redirect()->back()->withInput()->with('flash_danger', 'Can’t delete This Row
            // Because it related with another table');
        }
    }
}
