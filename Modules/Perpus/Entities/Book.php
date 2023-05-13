<?php

namespace Modules\Perpus\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Perpus\Database\factories\BookFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return BookFactory::new();
    }
}
