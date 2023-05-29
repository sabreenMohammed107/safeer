<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Country;
use Illuminate\Database\QueryException;

class SiteContriesController extends Controller
{

    protected $object;
    protected $viewName;
    protected $routeName;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Country $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'admin.site-countries.';
        $this->routeName = 'site-countries.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Country::where('flag', 1)->orderBy("created_at", "Desc")->get();

        return view($this->viewName . 'index', compact(['rows']));
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
     * @param  \App\Http\Requests\StoreCountryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCountryRequest $request)
    {
        $input = $request->except(['_token']);
        $input['flag'] = 1;
        Country::create($input);
        return redirect()->route($this->routeName . 'index')->with('flash_success', 'Successfully Saved!');}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCountryRequest  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        $input = $request->except(['_token']);

        $country->update($input);
        // $specialzation->update($input);

        return redirect()->route($this->routeName . 'index')->with('flash_success', 'Successfully Saved!');}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {

        try {

            $country->delete();
            return redirect()->back()->with('flash_del', 'Successfully Delete!');

        } catch (QueryException $q) {
            // return redirect()->back()->withInput()->with('flash_danger', $q->getMessage());
            return redirect()->back()->withInput()->with('flash_danger', 'Can’t delete This Row
            Because it related with another table');
        }
    }
}
