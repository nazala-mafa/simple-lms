<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Forum\Entities\Feed;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'likeable_id',
        'likeable_type'
    ];

    public function likeable()
    {
        $this->morphTo();
    }
}