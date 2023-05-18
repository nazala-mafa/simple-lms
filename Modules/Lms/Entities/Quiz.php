<?php

namespace Modules\Lms\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'school_id'
    ];

    public function activities()
    {
        return $this->morphMany(CourseActivity::class, 'course_activities', 'model_type', 'id');
    }

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'quiz_question', 'quiz_id', 'question_id');
    }

    public function scores()
    {
        return $this->hasMany(QuizScoreUser::class, 'quiz_id', 'id');
    }

    protected static function newFactory()
    {
        return \Modules\Lms\Database\factories\QuizFactory::new();
    }
}