<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\VideoLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoLikeController extends Controller
{
    public function toggle(Video $video)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            // Check if table exists first
            $tableExists = DB::select("SHOW TABLES LIKE 'video_likes'");

            if (empty($tableExists)) {
                // Create table if it doesn't exist
                DB::statement('
                    CREATE TABLE video_likes (
                        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        user_id BIGINT UNSIGNED NOT NULL,
                        video_id BIGINT UNSIGNED NOT NULL,
                        created_at TIMESTAMP NULL DEFAULT NULL,
                        updated_at TIMESTAMP NULL DEFAULT NULL,
                        UNIQUE KEY user_video_unique (user_id, video_id),
                        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                        FOREIGN KEY (video_id) REFERENCES videos(id) ON DELETE CASCADE
                    )
                ');
            }

            $existingLike = VideoLike::where('user_id', $user->id)
                                     ->where('video_id', $video->id)
                                     ->first();

            if ($existingLike) {
                // Unlike the video
                $existingLike->delete();
                $liked = false;
            } else {
                // Like the video
                VideoLike::create([
                    'user_id' => $user->id,
                    'video_id' => $video->id,
                ]);
                $liked = true;
            }

            $likesCount = $video->likes()->count();

            return response()->json([
                'liked' => $liked,
                'likes_count' => $likesCount,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to toggle like: ' . $e->getMessage()
            ], 500);
        }
    }
}
