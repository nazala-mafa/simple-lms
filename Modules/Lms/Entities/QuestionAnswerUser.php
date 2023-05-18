<?php

namespace Modules\Lms\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuestionAnswerUser extends Model
{
    use HasFactory;

    protected $fillable = ['quiz_id', 'question_id', 'answer_id', 'user_id'];

}