<?php

namespace Modules\Lms\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Lms\Entities\Course;
use Modules\Lms\Entities\CourseActivity;
use Modules\Lms\Entities\Module;
use Modules\Lms\Entities\QuestionAnswerUser;
use Modules\Lms\Entities\Quiz;
use Modules\Lms\Entities\QuizScoreUser;
use Yajra\DataTables\DataTables;

class MyCourseController extends Controller
{
    // Datatables
    public function datatable()
    {
        return DataTables::of(User::find(auth()->id())->active_courses)->toJson();
    }

    public function activity_datatable($course_id)
    {
        return DataTables::of(Course::find($course_id)->activities->map(fn($a) => [
            'activity' => $a,
            'data' => $a->activities
        ]))->toJson();
    }

    // Show Courses
    public function index()
    {
        return view('lms::my.course.index');
    }

    // Show Activities
    public function show($id)
    {
        return view('lms::my.course.show');
    }
    public function do_activity(Request $request)
    {
        $activity = CourseActivity::find($request->activity_id);
        if ($activity->model_type == Quiz::class) {
            $quiz = $activity->activities;
            return view('lms::my.course.quiz_show', compact('quiz'));
        } else if ($activity->model_type == Module::class) {
            $module = $activity->activities;
            return view('lms::my.course.module_show', compact('module'));
        } else {
            return view('lms::index');
        }
    }

    // Activity Quizzes
    public function quiz_do()
    {
        return view('lms::my.course.quiz_do');
    }
    public function submit_answers(Request $request)
    {
        $activity = CourseActivity::where([
            'model_type' => Quiz::class,
            'model_id' => $request->quiz_id,
        ])->firstOrFail();

        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id'
        ]);

        $countQuestion = Quiz::find($request->quiz_id)->questions->count();
        $countTrueQuestion = Quiz::find($request->quiz_id)->questions->map(fn($q) => $q->answers->map(fn($a) => [
            'answered' => $a->answered($request->quiz_id),
            'is_true' => $a->is_true
        ])->filter(fn($aa) => $aa['answered'] && $aa['is_true'] == 1))->filter(fn($trueAnswer) => count($trueAnswer))->count();

        $percent = round((float) ($countTrueQuestion / $countQuestion) * 100) . '%';

        QuizScoreUser::create([
            'quiz_id' => $request->quiz_id,
            'user_id' => auth()->id(),
            'score' => ($countTrueQuestion / $countQuestion),
            'score_text' => $percent
        ]);

        QuestionAnswerUser::where([
            'quiz_id' => $request->quiz_id,
            'user_id' => auth()->id()
        ])->get()->map(fn($a) => $a->delete());

        return redirect()->route('lms.my.course.activity', [$activity->course_id, $activity->id])->with('message', "Your score is $percent");
    }
}