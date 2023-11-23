<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class comment extends Model
{
    use HasFactory;

    protected $primaryKey = 'comment_id';
    public $timestamps = false;

    public function user(): BelongsTo
   {
      return $this->belongsTo(User::class, 'author_id', 'user_id');
   }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id','post_id');
    }

    public function parentComment()
    {
        return $this->belongsTo(Comment::class, 'previous', 'comment_id');
    }

    // Relationship to child comments
    public function replies()
    {
        return $this->hasMany(Comment::class, 'previous', 'comment_id');
    }

}
