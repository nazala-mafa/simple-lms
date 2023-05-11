<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class QuestionController extends Controller
{
    public function datatable()
    {
        return DataTables::of(Question::with('answers')->select('*'))->toJson();
    }
    public function index()
    {
        return view('private.question.index');
    }

    public function store(Request $request)
    {
        Question::create([
            'user_id' => auth()->id(),
            'quiz_id' => $request->quiz_id,
            'question' => $request->question
        ]);

        return response()->json([
            'message' => 'Question has been addded'
        ], 200);
    }
}