<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        $videos = Video::with(['category', 'user'])
            ->latest()
            ->paginate(15);

        return view('admin.videos.index', compact('videos'));
    }

    public function approve(Video $video)
    {
        $video->update(['is_approved' => true]);
        return back()->with('success', 'Video approved successfully');
    }

    public function reject(Video $video)
    {
        $video->delete();
        return back()->with('success', 'Video rejected and deleted successfully');
    }
}
