<?php

namespace Modules\Master\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'address',
        'status_id',
    ];

    public function status()
    {
        return $this->hasOne(SchoolStatus::class, 'id', 'status_id');
    }
}