<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    public function videoLikes(): HasMany
    {
        return $this->hasMany(VideoLike::class);
    }

    public function likedVideos(): BelongsToMany
    {
        try {
            return $this->belongsToMany(Video::class, 'video_likes')->withTimestamps();
        } catch (\Exception $e) {
            // Return empty collection if table doesn't exist
            return $this->belongsToMany(Video::class, 'video_likes')->whereRaw('1 = 0');
        }
    }

    public function hasLikedVideo(Video $video): bool
    {
        // Check if video_likes table exists before querying
        try {
            return $this->likedVideos()->where('video_id', $video->id)->exists();
        } catch (\Exception $e) {
            // If table doesn't exist, return false
            return false;
        }
    }

    public function hasRole(string $role): bool
    {
        return $this->roles->contains('name', $role);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isCreator(): bool
    {
        return $this->hasRole('creator');
    }

    public function isStudent(): bool
    {
        return $this->hasRole('student');
    }
}
