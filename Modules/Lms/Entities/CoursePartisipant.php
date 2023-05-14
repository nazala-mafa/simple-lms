<?php

namespace Modules\Lms\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoursePartisipant extends Model
{
    use HasFactory;

    protected $table = 'course_partisipant';

    protected $fillable = ['user_id', 'course_id'];

}