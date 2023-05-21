<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\Lms\Entities\QuestionAnswerUser;
use Modules\Lms\Entities\Quiz;

class DoQuiz extends Component
{
    public $quizId = null;
    public $activeQuestion = null;
    public $questions = [];
    public $activeQuestionIndex = 0;
    public $abc = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i'];
    public $userAnswers = [];

    public function mount()
    {
        $this->quizId = request()->segment(4);

        if (!count($this->questions)) {
            // Not Shuffled
            // $this->questions = Quiz::find($this->quizId)->questions;
            // Shuffled
            if (cache()->get('questions')) {
                $this->questions = cache()->get('questions');
            } else {
                $questions = Quiz::find($this->quizId)->questions->shuffle()->map(function ($q) {
                    $q->answers = $q->answers->shuffle();
                    return $q;
                });

                $this->questions = $questions;

                cache()->set('questions', $questions);
            }
        }
    }

    public function render()
    {
        if (cache()->get('questions')) {
            $this->questions = cache()->get('questions');
        }

        if (count($this->questions)) {
            $this->activeQuestion = $this->questions[$this->activeQuestionIndex];
        }

        return view('livewire.do-quiz');
    }

    public function nextQuestion()
    {
        if ($this->activeQuestionIndex < count($this->questions) - 1) {
            $this->activeQuestionIndex = $this->activeQuestionIndex + 1;
        }
    }

    public function backQuestion()
    {
        if ($this->activeQuestionIndex > 0) {
            $this->activeQuestionIndex = $this->activeQuestionIndex - 1;
        }
    }

    public function toQuestionIdx($idx)
    {
        if ($idx >= 0 && $idx <= count($this->questions) - 1) {
            $this->activeQuestionIndex = $idx;
        }
    }

    public function answerQuestion($answer_id)
    {
        QuestionAnswerUser::where([
            'quiz_id' => $this->quizId,
            'question_id' => $this->activeQuestion->id,
            'user_id' => auth()->id()
        ])->get()->map(fn($a) => $a->delete());

        QuestionAnswerUser::create([
            'quiz_id' => $this->quizId,
            'question_id' => $this->activeQuestion->id,
            'answer_id' => $answer_id,
            'user_id' => auth()->id()
        ]);
    }
}