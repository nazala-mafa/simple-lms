<?php

namespace Modules\Lms\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Lms\Entities\Course;
use Modules\Lms\Entities\CourseActivity;
use Yajra\DataTables\DataTables;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Super Admin|Teacher');
    }

    public function datatable()
    {
        //get courses that you are contributor
        return DataTables::of(Course::where([
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
        return view('lms::course.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('lms::course.create');
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
            'is_published' => 'required'
        ]);

        $user_id = auth()->user()->id;

        $course = Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $user_id,
            'school_id' => auth()->user()->school_id,
            'is_published' => $request->is_published
        ]);

        $course->contributors()->attach($user_id);

        return redirect()->route('lms.course.index')->with('message', "Course \"$course->title\" added successfully");
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('lms::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $users = User::all();
        $courseActivities = CourseActivity::where('course_id', $id)->get();

        return view('lms::course.edit', compact('course', 'users', 'courseActivities'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'is_published' => 'required'
        ]);

        $course = Course::find($id);

        $course->update([
            'title' => $request->title,
            'description' => $request->description,
            'is_published' => $request->is_published
        ]);

        $user_id = auth()->user()->id;
        if (!$course->contributors()->where('users.id', $user_id)->exists()) {
            $course->contributors()->attach($user_id);
        } else {
            $course->contributors()->where('users.id', $user_id)->update(['user_id' => $user_id]);
        }

        return redirect()->back()->with('message', "Course \"$course->title\" updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse returned
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->back()->with('message', "Course \"$course\" title deleted successfull");
    }

    public function add_partisipant(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $course = Course::find($request->course_id);
        if (!$course->partisipants()->where('users.id', $request->user_id)->exists()) {
            $course->partisipants()->attach($request->user_id);
        } else {
            $course->partisipants()->where('users.id', $request->user_id)->update(['user_id' => $request->user_id]);
            return redirect()->back()->with('error', "You cannot add the same partisipant.");
        }

        return redirect()->back()->with('message', "Partisipant added successfully.");
    }
}