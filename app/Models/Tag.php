<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Lms\Entities\Question;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'school_id',
        'name',
    ];

    public $timestamps = false;

    public function questions()
    {
        return $this->morphedByMany(Question::class, 'taggable');
    }
}