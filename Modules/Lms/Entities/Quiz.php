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

    protected static function newFactory()
    {
        return \Modules\Lms\Database\factories\QuizFactory::new();
    }
}