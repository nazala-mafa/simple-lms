<?php

namespace Modules\Lms\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'is_published'];

    public function contributors()
    {
        return $this->belongsToMany(User::class, 'course_contributor', 'course_id', 'user_id')->withTimestamps();
    }
    public function partisipants()
    {
        return $this->belongsToMany(User::class, 'course_partisipant', 'course_id', 'user_id')->withTimestamps();
    }

    protected static function newFactory()
    {
        return \Modules\Lms\Database\factories\CourseFactory::new();
    }
}