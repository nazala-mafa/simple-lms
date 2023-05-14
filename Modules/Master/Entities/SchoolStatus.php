<?php

namespace Modules\Master\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolStatus extends Model
{
    use HasFactory;
    protected $table = 'school_statuses';

    protected $fillable = [
        'name'
    ];

    public function schools()
    {
        return $this->hasMany(School::class, 'status_id', 'id');
    }
}