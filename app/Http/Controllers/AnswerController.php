<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store(Request $request)
    {
        Answer::create([
            'user_id' => auth()->id(),
            'quiz_id' => $request->quiz_id,
            'question_id' => $request->question_id,
            'answer' => $request->answer,
            'is_true' => $request->is_true
        ]);

        $question = Question::find($request->question_id);
        return response()->json([
            'message' => "Answer added to \"$question->question\" question"
        ], 200);
    }
}