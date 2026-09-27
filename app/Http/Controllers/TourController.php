<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Http\Requests\StoreTourRequest;
use App\Http\Requests\UpdateTourRequest;
use App\Models\City;
use App\Models\Tour_type;
use App\Models\Feature;
use App\Models\Country;
use App\Models\Tag;
use App\Models\Tour_tag;
use Illuminate\Database\QueryException;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TourController extends Controller
{
    protected $object;
    protected $viewName;
    protected $routeName;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Tour $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'admin.tours.';
        $this->routeName = 'tours.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ordered by the drag-and-drop `order` column so the table reflects
        // whatever sequence was last saved from the admin UI.
        $rows = Tour::orderBy("order", "asc")->orderBy("created_at", "Desc")->get();
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
        $types = Tour_type::get();
        $features = Feature::all();
        $countries =Country::where('flag',1)->get();

        $tags = Tag::get();
        // $eventSpecialzation=[];

        return view($this->viewName . 'add', compact(['types', 'tags', 'cities', 'types', 'features', 'countries']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTourRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTourRequest $request)
    {

    //new
    DB::beginTransaction();
        try {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $input = $request->except(['_token', 'thumbnail', 'banner']);
            if ($request->hasFile('thumbnail')) {
                $attach_image = $request->file('thumbnail');

                $input['thumbnail'] = $this->UplaodImage($attach_image);
            }

            if ($request->hasFile('banner')) {
                $attach_banner = $request->file('banner');

                $input['banner'] = $this->UplaodBanner($attach_banner);
            }
            if ($request->has('active')) {

                $input['active'] = '1';
            } else {
                $input['active'] = '0';
            }

            if (!isset($input['order']) || $input['order'] === '') {
                // No order given: append it to the end of the current list.
                $input['order'] = (int) Tour::max('order') + 1;
            }

            $tour = Tour::create($input);
            if (!empty($request->get('features'))) {

                $tour->features()->attach($request->features);

            }
            if (!empty($request->get('tags'))) {

                $tour->tags()->attach($request->tags);

            }
            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            return redirect()->route($this->routeName . 'index')->with('flash_success', 'تم الحفظ بنجاح');

        } catch (\Throwable$e) {
            // throw $th;
            DB::rollback();
            return redirect()->route($this->routeName . 'index')->with('flash_danger', $e->getMessage());
            return redirect()->back()->withInput()->withErrors($e->getMessage());

        }







    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function edit(Tour $tour)
    {
        $cities = City::get();
        $types = Tour_type::get();
        $features = Feature::all();


        $tourFeatures = $tour->features->all();


        $countries = Country::where('flag',1)->get();
        $tags = Tag::get();
        $tagsTour = Tour_tag::where('tour_id', $tour->id)->get();
        //  dd($tagsTour);
        return view($this->viewName . 'edit', compact([ 'tags', 'tagsTour', 'tour', 'cities', 'countries', 'types', 'features', 'tourFeatures']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTourRequest  $request
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTourRequest $request, Tour $tour)
    {

    //new
    DB::beginTransaction();
        try {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $input = $request->except(['_token', 'thumbnail', 'banner']);
            if ($request->hasFile('thumbnail')) {
                $attach_image = $request->file('thumbnail');

                $input['thumbnail'] = $this->UplaodImage($attach_image);
            }

            if ($request->hasFile('banner')) {
                $attach_banner = $request->file('banner');

                $input['banner'] = $this->UplaodBanner($attach_banner);
            }
            if ($request->has('active')) {

                $input['active'] = '1';
            } else {
                $input['active'] = '0';
            }

            if (!isset($input['order']) || $input['order'] === '') {
                // No order given: append it to the end of the current list.
                $input['order'] = (int) Tour::max('order') + 1;
            }

            $tour->update($input);
            if (!empty($request->get('features'))) {

                $tour->features()->sync($request->features);

            }
            if (!empty($request->get('tags'))) {
                $tour->tags()->sync($request->tags);

            }
            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            return redirect()->route($this->routeName . 'index')->with('flash_success', 'تم الحفظ بنجاح');

        } catch (\Throwable$e) {
            // throw $th;
            DB::rollback();
            return redirect()->route($this->routeName . 'index')->with('flash_danger', $e->getMessage());
            return redirect()->back()->withInput()->withErrors($e->getMessage());

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tour = Tour::where('id', $id)->first();
        // Delete File ..
        $file = $tour->banner;
        $file_name = public_path('uploads/tours/' . $file);
        try {
            File::delete($file_name);
            $tour->features()->detach();
            $tour->tags()->detach();
            $tour->delete();
            return redirect()->back()->with('flash_del', 'Successfully Delete!');

        } catch (QueryException $q) {
            //  return redirect()->back()->withInput()->with('flash_danger', $q->getMessage());
            return redirect()->back()->withInput()->with('flash_danger', 'Can’t delete This Row
            Because it related with another table');
        }
    }

    /**
     * Bulk-persist a new drag-and-drop display order for tours.
     *
     * Expects { order: [id1, id2, id3, ...] } — the tour ids in their new
     * top-to-bottom sequence. Position in the array (1-based) becomes each
     * tour's new `order` value, applied in one query inside a transaction.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'order' => ['required', 'array', 'min:1'],
            'order.*' => ['integer', 'distinct', 'exists:tours,id'],
        ]);

        try {
            DB::transaction(function () use ($validated) {
                $ids = $validated['order'];

                $caseParts = [];
                $bindings = [];
                foreach ($ids as $position => $id) {
                    $caseParts[] = 'WHEN ? THEN ?';
                    $bindings[] = $id;
                    $bindings[] = $position + 1;
                }

                $placeholders = implode(',', array_fill(0, count($ids), '?'));
                $sql = 'UPDATE tours SET `order` = CASE id ' . implode(' ', $caseParts) . ' END WHERE id IN (' . $placeholders . ')';

                DB::statement($sql, array_merge($bindings, $ids));
            });
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Could not save the new order. Please try again.',
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Tour order updated successfully',
        ]);
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
          $uploadPath = public_path('uploads/tours');

          // Move The image..
          $file->move($uploadPath, $imageName);

          return $imageName;
      }

      public function UplaodBanner($file_request)
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
          $uploadPath = public_path('uploads/tours');

          // Move The image..
          $file->move($uploadPath, $imageName);

          return $imageName;
      }

       /**
     * dependace sub category
     */
    public function fetchCat(Request $request)
    {

        $select = $request->get('select');
        $value = $request->get('value');

        $data = City::where('country_id', $value)->get();


            $output = '<option value=""> Select City</option>';
        foreach ($data as $row) {

            $output .= '<option value="' . $row->id . '" >' . $row->en_city . '</option>';
        }




        echo $output;
    }
}
