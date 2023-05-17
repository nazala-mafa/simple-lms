<?php

namespace Modules\Lms\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Lms\Entities\Question;
use Modules\Lms\Entities\Quiz;
use Yajra\DataTables\DataTables;

class QuestionController extends Controller
{
    public function datatable()
    {
        return DataTables::of(Question::where('school_id', auth()->user()->school_id)->get())->toJson();
    }

    public function quiz_datatable($quiz_id)
    {
        return DataTables::of(Quiz::find($quiz_id)->questions()->where('school_id', auth()->user()->school_id)->get())->toJson();
    }

    public function add_quiz_question(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question_id' => 'required|exists:questions,id'
        ]);

        $quiz = Quiz::find($request->quiz_id);
        if (!$quiz->questions()->where('questions.id', $request->question_id)->exists()) {
            $quiz->questions()->attach($request->question_id);
        } else {
            $quiz->questions()->where('questions.id', $request->question_id)->update(['question_id' => $request->question_id]);
            return response()->json([
                'error' => "You cannot add the same question."
            ]);
        }

        return response()->json([
            'message' => "Partisipant added successfully."
        ]);
    }

    public function remove_quiz_question(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question_id' => 'required|exists:questions,id'
        ]);

        $quiz = Quiz::find($request->quiz_id);
        $quiz->questions()->detach($request->question_id);

        return response()->json([
            'message' => "Partisipant added successfully."
        ]);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('lms::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('lms::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
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