<?php

namespace App\Http\Controllers;

use App\Models\Food_beverage;
use App\Http\Requests\StoreFood_beverageRequest;
use App\Http\Requests\UpdateFood_beverageRequest;

class FoodBeverageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreFood_beverageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFood_beverageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food_beverage  $food_beverage
     * @return \Illuminate\Http\Response
     */
    public function show(Food_beverage $food_beverage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Food_beverage  $food_beverage
     * @return \Illuminate\Http\Response
     */
    public function edit(Food_beverage $food_beverage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFood_beverageRequest  $request
     * @param  \App\Models\Food_beverage  $food_beverage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFood_beverageRequest $request, Food_beverage $food_beverage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Food_beverage  $food_beverage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food_beverage $food_beverage)
    {
        //
    }
}
