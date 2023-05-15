<?php

namespace Modules\Lms\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quiz_id',
        'question_id',
        'answer',
        'is_true'
    ];

    protected static function newFactory()
    {
        return \Modules\Lms\Database\factories\AnswerFactory::new();
    }
}