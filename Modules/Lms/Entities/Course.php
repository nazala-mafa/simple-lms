<?php

namespace Modules\Lms\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'is_published'];

    public function partisipant()
    {
        return $this->belongsToMany(User::class)->using(CoursePartisipant::class);
    }
}