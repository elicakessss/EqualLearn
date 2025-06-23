<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Video extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'thumbnail',
        'video_url',
        'category_id',
        'country_id',
        'user_id',
        'views',
        'is_approved',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'views' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(VideoLike::class);
    }

    public function likedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'video_likes')->withTimestamps();
    }

    public function likesCount(): int
    {
        try {
            return $this->likes()->count();
        } catch (\Exception $e) {
            // Return 0 if table doesn't exist
            return 0;
        }
    }
}
