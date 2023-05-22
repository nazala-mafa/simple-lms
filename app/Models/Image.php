<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Forum\Entities\Feed;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'uri',
        'path',
        'imageable_id',
        'imageable_type'
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}