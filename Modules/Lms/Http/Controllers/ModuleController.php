<?php

namespace Modules\Lms\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Lms\Entities\Module;
use Yajra\DataTables\DataTables;

class ModuleController extends Controller
{
    public function datatable()
    {
        return DataTables::of(Module::where([
            'user_id' => auth()->id(),
            'school_id' => auth()->user()->school_id
        ])->get())->toJson();
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('lms::module.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('lms::module.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'body' => 'required'
        ]);

        Module::create([
            'title' => $request->title,
            'description' => $request->description,
            'body' => $request->body,
            'user_id' => auth()->id(),
            'school_id' => auth()->user()->school_id
        ]);

        return redirect()->route('lms.module.index')->with('message', 'New module addedd successfully');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Module $module)
    {
        return view('lms::module.show', compact('module'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Module $module)
    {
        return view('lms::module.edit', compact('module'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \lluminate\Http\RedirectResponse
     */
    public function update(Request $request, Module $module)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'body' => 'required'
        ]);

        $module->update([
            'title' => $request->title,
            'description' => $request->description,
            'body' => $request->body,
        ]);

        return redirect()->back()->with('message', "Module \"$module->title\" updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     * @param Module $module
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Module $module)
    {
        $module->delete();

        return redirect()->back()->with('message', "Module \"$module->title\" has been deleted.");
    }
}