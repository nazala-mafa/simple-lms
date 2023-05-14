<?php

namespace Modules\Master\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Modules\Master\Entities\School;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function datatable()
    {
        return DataTables::of(User::with('school', 'roles')->get())->toJson();
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('master::user.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $roles = Role::where('name', '!=', 'Super Admin')->get();
        $schools = School::all();
        return view('master::user.create', compact('roles', 'schools'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4|max:100|unique:users,name',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:4',
            'password_confirm' => 'required|min:4|same:password',
            'role' => 'required|exists:roles,id'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'school_id' => $request->school_id
        ]);

        $user->assignRole($request->role);

        return redirect()->route('master.user.index')->with('message', "User \"$user->name\" added successfully");
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
    public function edit(User $user)
    {
        $roles = Role::where('name', '!=', 'Super Admin')->get();
        $schools = School::all();
        return view('master::user.edit', compact('roles', 'user', 'schools'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'name' => [
                'required',
                'min:4',
                'max:100', Rule::unique('users')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email', Rule::unique('users')->ignore($user->id),
            ],
            'password_confirm' => 'same:password',
            'role' => 'required|exists:roles,id'
        ]);

        $newData = [
            'name' => $request->name,
            'email' => $request->email,
            'school_id' => $request->school_id
        ];
        if ($request->password) {
            $newData['password'] = bcrypt($request->password);
        }

        $user->update($newData);

        $user->assignRole($request->role);

        return redirect()->route('master.user.index')->with('message', "User \"$user->name\" updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('message', "User with name \"$user->name\", has been deleted.");
    }
}