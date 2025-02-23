<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForumPost extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'forum_id',
        'title',
        'slug',
        'content',
        'is_approved',
        'is_pinned',
        'views',
        'likes'
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'is_pinned' => 'boolean',
        'views' => 'integer',
        'likes' => 'integer'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function forum(): BelongsTo
    {
        return $this->belongsTo(Forum::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function incrementViews(): void
    {
        $this->increment('views');
    }

    public function incrementLikes(): void
    {
        $this->increment('likes');
    }

    public function decrementLikes(): void
    {
        $this->decrement('likes');
    }

    public function togglePin(): void
    {
        $this->is_pinned = !$this->is_pinned;
        $this->save();
    }
}