<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\PicksServerImages;
use App\Models\Team;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use File;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    use PicksServerImages;

    protected $viewName;
    protected $routeName;

    public function __construct()
    {
        $this->middleware('auth');

        $this->viewName = 'admin.teams.';
        $this->routeName = 'teams.';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ordered by the drag-and-drop `order` column, same convention as Tours.
        $rows = Team::orderBy('order', 'asc')->orderBy('created_at', 'desc')->get();

        return view($this->viewName . 'index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->viewName . 'add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTeamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeamRequest $request)
    {
        $input = $request->except(['_token', 'image', 'library_image']);

        // New upload, or an existing image picked from the server library.
        if ($image = $this->resolveImage($request, 'teams')) {
            $input['image'] = $image;
        }

        $input['featured'] = $request->has('featured') ? 1 : 0;
        $input['active'] = $request->has('active') ? 1 : 0;

        if (!isset($input['order']) || $input['order'] === '') {
            // No order given: append it to the end of the current list.
            $input['order'] = (int) Team::max('order') + 1;
        }

        Team::create($input);

        return redirect()->route($this->routeName . 'index')->with('flash_success', 'Successfully Saved!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Team::findOrFail($id);

        return view($this->viewName . 'edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTeamRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeamRequest $request, $id)
    {
        $row = Team::findOrFail($id);
        // `order` is managed exclusively from the index page's reorder controls
        // (see reorder() below) — never touched from the edit form.
        $input = $request->except(['_token', '_method', 'image', 'library_image', 'order']);

        // New upload, or an existing image picked from the server library.
        if ($image = $this->resolveImage($request, 'teams')) {
            $input['image'] = $image;
        }

        $input['featured'] = $request->has('featured') ? 1 : 0;
        $input['active'] = $request->has('active') ? 1 : 0;

        $row->update($input);

        return redirect()->route($this->routeName . 'index')->with('flash_success', 'Successfully Saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Team::findOrFail($id);

        try {
            if ($row->image) {
                File::delete(public_path('uploads/teams/' . $row->image));
            }
            $row->delete();

            return redirect()->back()->with('flash_del', 'Successfully Delete!');
        } catch (QueryException $q) {
            return redirect()->back()->withInput()->with('flash_danger', 'Can’t delete This Row
            Because it related with another table');
        }
    }

    /**
     * Bulk-persist a new drag-and-drop display order for team members.
     *
     * Expects { order: [id1, id2, id3, ...] } — the team ids in their new
     * top-to-bottom sequence. Position in the array (1-based) becomes each
     * member's new `order` value, applied in one query inside a transaction.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'order' => ['required', 'array', 'min:1'],
            'order.*' => ['integer', 'distinct', 'exists:teams,id'],
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
                $sql = 'UPDATE teams SET `order` = CASE id ' . implode(' ', $caseParts) . ' END WHERE id IN (' . $placeholders . ')';

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
            'message' => 'Team order updated successfully',
        ]);
    }
}
