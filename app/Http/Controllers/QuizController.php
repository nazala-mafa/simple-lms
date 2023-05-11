<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class QuizController extends Controller
{
    public function datatable()
    {
        return DataTables::of(Quiz::select('*'))->toJson();
    }

    public function index()
    {
        return view('private.quiz.index');
    }

    public function store(Request $request)
    {
        Quiz::create([
            'user_id' => auth()->id(),
            'title' => $request->title
        ]);

        return response()->json([
            'message' => 'New Quiz Added',
        ], 200);
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return response()->json([
            'message' => "\"$quiz->title\" quiz has been deleted"
        ]);
    }
}