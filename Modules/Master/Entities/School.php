<?php

namespace Modules\Master\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'address',
        'status',
    ];

    public function status()
    {
        return $this->hasOne('school_statuses', 'id', 'school_id');
    }
}