<?php

namespace App\Http\Controllers;

use App\Models\Favorite_hotels_tour;
use App\Http\Requests\StoreFavorite_hotels_tourRequest;
use App\Http\Requests\UpdateFavorite_hotels_tourRequest;

class FavoriteHotelsTourController extends Controller
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
     * @param  \App\Http\Requests\StoreFavorite_hotels_tourRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFavorite_hotels_tourRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Favorite_hotels_tour  $favorite_hotels_tour
     * @return \Illuminate\Http\Response
     */
    public function show(Favorite_hotels_tour $favorite_hotels_tour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Favorite_hotels_tour  $favorite_hotels_tour
     * @return \Illuminate\Http\Response
     */
    public function edit(Favorite_hotels_tour $favorite_hotels_tour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFavorite_hotels_tourRequest  $request
     * @param  \App\Models\Favorite_hotels_tour  $favorite_hotels_tour
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFavorite_hotels_tourRequest $request, Favorite_hotels_tour $favorite_hotels_tour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Favorite_hotels_tour  $favorite_hotels_tour
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favorite_hotels_tour $favorite_hotels_tour)
    {
        //
    }
}
