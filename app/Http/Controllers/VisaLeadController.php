<?php

namespace App\Http\Controllers;

use App\Models\VisaLead;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class VisaLeadController extends Controller
{
    protected $viewName;
    protected $routeName;

    public function __construct()
    {
        $this->middleware('auth');

        $this->viewName = 'admin.visa-leads.';
        $this->routeName = 'visa-leads.';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = VisaLead::orderBy('created_at', 'desc')->get();

        return view($this->viewName . 'index', compact('rows'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = VisaLead::with(['country', 'visaType', 'nationality'])->findOrFail($id);

        return view($this->viewName . 'show', compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = VisaLead::with(['country', 'visaType', 'nationality'])->findOrFail($id);

        return view($this->viewName . 'edit', compact('row'));
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
        $validated = $request->validate([
            'status' => ['required', 'in:pending,contacted,closed'],
            'notes' => ['nullable', 'string'],
        ]);

        $row = VisaLead::findOrFail($id);
        $row->update($validated);

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
        $row = VisaLead::findOrFail($id);

        try {
            $row->delete();

            return redirect()->back()->with('flash_del', 'Successfully Delete!');
        } catch (QueryException $q) {
            return redirect()->back()->withInput()->with('flash_danger', 'Can’t delete This Row
            Because it related with another table');
        }
    }
}
