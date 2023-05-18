<?php

namespace Modules\Lms\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'question_id',
        'answer',
        'is_true'
    ];

    public function answered($quizId)
    {
        // return $this->question_id;
        return QuestionAnswerUser::where([
            'quiz_id' => $quizId,
            'user_id' => auth()->id(),
            'question_id' => $this->question_id,
            'answer_id' => $this->id,
        ])->exists();
    }

    protected static function newFactory()
    {
        return \Modules\Lms\Database\factories\AnswerFactory::new();
    }
}