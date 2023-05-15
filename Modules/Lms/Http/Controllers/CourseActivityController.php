<?php

namespace Modules\Lms\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use Modules\Lms\Entities\CourseActivity;
use Modules\Lms\Entities\Module;
use Modules\Lms\Entities\Quiz;

class CourseActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $type = request()->type;
        $q = request()->q;

        switch ($type) {
            case 'quizzes':
                $activities = Quiz::where('title', 'like', "%$q%")
                    ->with(['users' => fn($query) => $query->where('school_id', 2)])
                    ->get()->map(function ($q) {
                        return [
                            'id' => $q->id,
                            'text' => $q->title,
                            'model_id' => $q->id
                        ];
                    });
                break;

            case 'modules':
                $activities = Module::where('title', 'like', "%$q%")->get()->map(function ($q) {
                    return [
                        'id' => $q->id,
                        'text' => $q->title,
                        'model_id' => $q->id
                    ];
                });
                break;

            default:
                $activities = [];
                break;
        }

        return response()->json([
            'results' => $activities,
            'pagination' => false
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse 
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'model_type' => 'required',
            'model_id' => 'required',
        ]);

        $reqData = [
            'course_id' => $request->course_id,
            'model_type' => $this->getModelType(),
            'model_id' => $request->model_id
        ];
        if (!CourseActivity::where($reqData)->exists()) {
            CourseActivity::create($reqData);
        } else {
            return redirect()->back()->with('error', "You cannot add the same activities");
        }

        return redirect()->back()->with('message', "Activity added successfully");
    }

    public function getModelType()
    {
        switch (request()->model_type) {
            case 'Quiz':
                return Quiz::class;
            case 'Module':
                return Module::class;
            default:
                throw ValidationException::withMessages(['Invalid model type']);
        }
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
        return view('lms::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}