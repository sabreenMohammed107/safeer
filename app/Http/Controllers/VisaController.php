<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Currency;
use App\Models\Nationality;
use App\Models\Visa;
use App\Models\Visa_type;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class VisaController extends Controller
{

    protected $object;
    protected $viewName;
    protected $routeName;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Visa $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'admin.visa.';
        $this->routeName = 'visa.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Visa::orderBy("created_at", "Desc")->get();

        return view($this->viewName . 'index', compact(['rows']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Visa_type::all();
        $currancies = Currency::all();
        $nationalities =Nationality::all();
        return view($this->viewName . 'add', compact(['types','currancies','nationalities']));
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
        if ($request->has('active')) {

            $input['active'] = '1';
        } else {
            $input['active'] = '0';
        }
        Visa::create($input);
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
        $row=Visa::where('id',$id)->first();
        $types = Visa_type::all();
        $currancies = Currency::all();
        $nationalities =Nationality::all();
        return view($this->viewName . 'edit', compact(['row','types','currancies','nationalities']));
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
        if ($request->has('active')) {

            $input['active'] = '1';
        } else {
            $input['active'] = '0';
        }
        Visa::findOrFail($id)->update($input);
        return redirect()->route($this->routeName . 'index')->with('flash_success', 'Successfully Saved!');}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Visa::where('id', $id)->first();

        try {

            $row->delete();
            return redirect()->back()->with('flash_del', 'Successfully Delete!');

        } catch (QueryException $q) {
            // return redirect()->back()->withInput()->with('flash_danger', $q->getMessage());
            return redirect()->back()->withInput()->with('flash_danger', 'Can’t delete This Row
            Because it related with another table');
        }
    }
}
