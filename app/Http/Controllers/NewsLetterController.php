<?php

namespace App\Http\Controllers;

use App\Models\News_letter;
use App\Http\Requests\StoreNews_letterRequest;
use App\Http\Requests\UpdateNews_letterRequest;

class NewsLetterController extends Controller
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
     * @param  \App\Http\Requests\StoreNews_letterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNews_letterRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News_letter  $news_letter
     * @return \Illuminate\Http\Response
     */
    public function show(News_letter $news_letter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News_letter  $news_letter
     * @return \Illuminate\Http\Response
     */
    public function edit(News_letter $news_letter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNews_letterRequest  $request
     * @param  \App\Models\News_letter  $news_letter
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNews_letterRequest $request, News_letter $news_letter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News_letter  $news_letter
     * @return \Illuminate\Http\Response
     */
    public function destroy(News_letter $news_letter)
    {
        //
    }
}
