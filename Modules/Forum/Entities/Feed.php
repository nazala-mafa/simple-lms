<?php

namespace Modules\Forum\Entities;

use App\Models\Comment;
use App\Models\Dislike;
use App\Models\Image;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feed extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'school_id',
        'caption'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function dislikes()
    {
        return $this->morphMany(Dislike::class, 'dislikeable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    protected static function newFactory()
    {
        return \Modules\Forum\Database\factories\FeedFactory::new();
    }
}