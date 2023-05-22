<?php

namespace Modules\School\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'key',
        'value'
    ];

    protected $timestamps = false;
}