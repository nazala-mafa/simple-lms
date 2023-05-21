<?php

namespace Modules\Lms\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Lms\Entities\Answer;
use Modules\Lms\Entities\Question;
use Modules\Lms\Entities\Quiz;
use Yajra\DataTables\DataTables;

class QuestionController extends Controller
{
    public function datatable()
    {
        // just show your own questions
        return DataTables::of(Question::where([
            'school_id' => auth()->user()->school_id,
            'user_id' => auth()->id()
        ])->get())->toJson();
    }

    /**
     * Display question from quiz
     * @param Quiz $quiz
     */
    public function quiz_datatable($quiz)
    {
        return DataTables::of($quiz->questions()->where([
            'school_id' => auth()->user()->school_id,
            'user_id' => auth()->id()
        ])->get())->toJson();
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
        return view('lms::question.index');
    }

    public function create()
    {
        return view('lms::question.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse 
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
        ]);

        $question = new Question();
        $question->school_id = auth()->user()->school_id;
        $question->user_id = auth()->id();
        $question->question = $request->question;
        $question->save();

        return redirect()->route('lms.question.edit', $question->id)->with('message', 'New question added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Question
     * @return Renderable
     */
    public function edit(Question $question)
    {
        return view('lms::question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Question $question
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'question' => 'required'
        ]);

        $question->update([
            'question' => $request->question
        ]);

        return redirect()->back()->with('message', "Question \"$question->question\" updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     * @param Question
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return response()->json([
            'message' => "Question \"$question->question\" has been deleted."
        ], 200);
    }
}