<?php

namespace Modules\Master\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Modules\Master\Entities\School;
use Modules\Master\Entities\SchoolStatuses;
use Yajra\DataTables\DataTables;

class SchoolController extends Controller
{
    public function Datatable()
    {
        return DataTables::of(School::all())->toJson();
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('master::school.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('master::school.create', [
            'statuses' => SchoolStatuses::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4|max:100|unique:schools,name',
            'email' => 'required|unique:schools,email|email',
            'address' => 'required|min:4',
            'status' => 'required'
        ]);

        $school = School::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'status' => $request->status
        ]);

        return redirect()->route('master.school.index')->with('message', "School \"$school->name\" added successfully");
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('master::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('master::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $school = School::find($id);

        $request->validate([
            'name' => [
                'required',
                'min:4',
                'max:100', Rule::unique('schools')->ignore($school->id),
            ],
            'email' => [
                'required',
                'email', Rule::unique('schools')->ignore($school->id),
            ],
            'address' => 'required|min:4',
            'status' => 'required'
        ]);

        $school->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'status' => $request->status
        ]);

        return redirect()->route('master.school.index')->with('message', "School \"$school->name\" updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     * @param School $school
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(School $school)
    {
        // $school->delete();

        return redirect()->back()->with('message', "School with name \"$school->name\", has been deleted.");
    }
}