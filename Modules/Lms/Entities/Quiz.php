<?php

namespace Modules\Lms\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title'
    ];

    public function activities()
    {
        return $this->morphMany(CourseActivity::class, 'course_activities', 'model_type', 'id');
    }
}