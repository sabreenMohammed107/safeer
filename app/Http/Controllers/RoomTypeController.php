<?php

namespace App\Http\Controllers;

use App\Models\Room_type;
use App\Http\Requests\StoreRoom_typeRequest;
use App\Http\Requests\UpdateRoom_typeRequest;
use Illuminate\Database\QueryException;

class RoomTypeController extends Controller
{
    protected $object;
    protected $viewName;
    protected $routeName;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Room_type $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'admin.room-types.';
        $this->routeName = 'room-types.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Room_type::orderBy("created_at", "Desc")->get();


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
     * @param  \App\Http\Requests\StoreRoom_typeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoom_typeRequest $request)
    {
        $input = $request->except(['_token']);

        Room_type::create($input);
        return redirect()->route($this->routeName.'index')->with('flash_success', 'Successfully Saved!');
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room_type  $room_type
     * @return \Illuminate\Http\Response
     */
    public function show(Room_type $room_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room_type  $room_type
     * @return \Illuminate\Http\Response
     */
    public function edit(Room_type $room_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoom_typeRequest  $request
     * @param  \App\Models\Room_type  $room_type
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoom_typeRequest $request, Room_type $room_type)
    {
        $input = $request->except(['_token','Room_type_id']);

        Room_type::findOrFail($request->get('Room_type_id'))->update($input);
        // $specialzation->update($input);

        return redirect()->route($this->routeName.'index')->with('flash_success', 'Successfully Saved!');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room_type  $room_type
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room_type = Room_type::where('id', $id)->first();
        try {

            $room_type->delete();
            return redirect()->back()->with('flash_del', 'Successfully Delete!');

        } catch (QueryException $q) {
            // return redirect()->back()->withInput()->with('flash_danger', $q->getMessage());
            return redirect()->back()->withInput()->with('flash_danger', 'Can’t delete This Row
            Because it related with another table');
        }
    }
}
