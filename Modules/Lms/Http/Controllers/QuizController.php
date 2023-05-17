<?php

namespace Modules\Lms\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Lms\Entities\Question;
use Modules\Lms\Entities\Quiz;
use Yajra\DataTables\DataTables;

class QuizController extends Controller
{
    public function datatable()
    {
        return DataTables::of(Quiz::select('*'))->toJson();
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('lms::quiz.index');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        Quiz::create([
            'school_id' => auth()->user()->school_id,
            'user_id' => auth()->id(),
            'title' => $request->title
        ]);

        return response()->json([
            'message' => 'New Quiz Added',
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function edit(Quiz $quiz)
    {
        return view('lms::quiz.edit', compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $quiz = Quiz::find($id);

        $quiz->update([
            'title' => $request->title
        ]);

        return response()->json([
            'message' => "Update Quiz \"$request->title\" Successfully",
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return response()->json([
            'message' => "\"$quiz->title\" quiz has been deleted"
        ]);
    }
}