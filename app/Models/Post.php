<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\PostLike;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $primaryKey = 'post_id';

    protected $fillable = [
        'owner_id',
        'image',
        'content',
        'private',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'post_id', 'post_id');
    }

    public function commentsCount()
    {
        return $this->comments()->count();
    }

    public function likes()
    {
        return $this->hasMany(PostLike::class, 'post_id', 'post_id');
    }

    public function likesCount()
    {
        return $this->likes()->count();
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'bookmarked_post', 'post_id');
    }

    public function bookmarksCount()
    {
        return $this->bookmarks()->count();
    }

}
