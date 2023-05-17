<?php

namespace Modules\Lms\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Lms\Entities\Answer;

class AnswerController extends Controller
{
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
    public function create(Request $request)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id'
        ]);

        return view('lms::answer.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'question_id' => 'required|exists:answers,id',
            'answer' => 'required',
            'is_true' => 'required'
        ]);

        Answer::create([
            'user_id' => auth()->id(),
            'question_id' => $request->question_id,
            'answer' => $request->answer,
            'is_true' => $request->is_true
        ]);

        return redirect()->route('lms.question.edit', $request->question_id)->with('message', 'New answer added successfully.');
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
     * @param Answer $answer
     * @return Renderable
     */
    public function edit(Answer $answer)
    {
        return view('lms::answer.edit', compact('answer'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Answer $answer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Answer $answer)
    {
        $request->validate([
            'answer' => 'required',
            'is_true' => 'required'
        ]);

        $answer->update([
            'answer' => $request->answer,
            'is_true' => $request->is_true
        ]);

        return redirect()->route('lms.question.edit', $answer->question_id)->with('message', "Answer \"$answer->answer\" updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Answer $answer)
    {
        $answer->delete();

        return redirect()->back()->with('message', "Answer \"$answer->answer\" deleted successfully.");
    }
}