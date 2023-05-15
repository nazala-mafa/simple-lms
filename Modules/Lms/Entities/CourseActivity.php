<?php

namespace Modules\Lms\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'model_type',
        'model_id'
    ];

    public function activities()
    {
        return $this->morphTo(__FUNCTION__, 'model_type', 'model_id');
    }
}