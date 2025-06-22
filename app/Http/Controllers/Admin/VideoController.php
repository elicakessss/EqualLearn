<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $pendingVideos = Video::with(['user', 'category'])
            ->where('is_approved', false)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $approvedVideos = Video::with(['user', 'category'])
            ->where('is_approved', true)
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        return view('admin.videos.index', compact('pendingVideos', 'approvedVideos'));
    }

    public function approve(Video $video)
    {
        $video->update(['is_approved' => true]);

        return redirect()->back()->with('success', "Video '{$video->title}' has been approved!");
    }

    public function reject(Video $video)
    {
        // Delete the video files
        if ($video->video_url && file_exists(storage_path('app/public/' . $video->video_url))) {
            unlink(storage_path('app/public/' . $video->video_url));
        }
        if ($video->thumbnail && file_exists(storage_path('app/public/' . $video->thumbnail))) {
            unlink(storage_path('app/public/' . $video->thumbnail));
        }

        // Delete the video record
        $video->delete();

        return redirect()->back()->with('success', "Video '{$video->title}' has been rejected and deleted!");
    }

    public function unapprove(Video $video)
    {
        $video->update(['is_approved' => false]);

        return redirect()->back()->with('success', "Video '{$video->title}' has been unapproved!");
    }
}
