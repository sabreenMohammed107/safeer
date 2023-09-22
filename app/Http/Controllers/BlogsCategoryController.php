<?php

namespace App\Http\Controllers;

use App\Models\Blogs_category;
use App\Http\Requests\StoreBlogs_categoryRequest;
use App\Http\Requests\UpdateBlogs_categoryRequest;
use Illuminate\Database\QueryException;

class BlogsCategoryController extends Controller
{
    protected $object;
    protected $viewName;
    protected $routeName;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Blogs_category $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'admin.blog-categories.';
        $this->routeName = 'blog-categories.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Blogs_category::where('id','!=',100)->orderBy("created_at", "Desc");


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
     * @param  \App\Http\Requests\StoreBlogs_categoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogs_categoryRequest $request)
    {
        $input = $request->except(['_token']);

        Blogs_category::create($input);
        return redirect()->route($this->routeName.'index')->with('flash_success', 'Successfully Saved!');
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blogs_category  $blogs_category
     * @return \Illuminate\Http\Response
     */
    public function show(Blogs_category $blogs_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blogs_category  $blogs_category
     * @return \Illuminate\Http\Response
     */
    public function edit(Blogs_category $blogs_category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogs_categoryRequest $request
     * @param  \App\Models\Blogs_category  $blogs_category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogs_categoryRequest $request, Blogs_category $blogs_category)
    {
        $input = $request->except(['_token','blogs_category_id']);

        blogs_category::findOrFail($request->get('blogs_category_id'))->update($input);
        // $specialzation->update($input);

        return redirect()->route($this->routeName.'index')->with('flash_success', 'Successfully Saved!');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blogs_category  $blogs_category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blogs_category = Blogs_category::where('id', $id)->first();
        try {

            $blogs_category->delete();
            return redirect()->back()->with('flash_del', 'Successfully Delete!');

        } catch (QueryException $q) {
            // return redirect()->back()->withInput()->with('flash_danger', $q->getMessage());
            return redirect()->back()->withInput()->with('flash_danger', 'Can’t delete This Row
            Because it related with another table');
        }
    }
}
