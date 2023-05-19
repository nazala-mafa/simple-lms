<?php

namespace Modules\Lms\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'body',
        'school_id'
    ];

    public function activities()
    {
        return $this->morphMany(CourseActivity::class, 'course_activities', 'model_type', 'id');
    }

    protected static function newFactory()
    {
        return \Modules\Lms\Database\factories\ModuleFactory::new();
    }
}