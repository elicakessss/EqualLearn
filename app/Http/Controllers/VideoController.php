<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with(['category', 'user'])
            ->where('is_approved', true)
            ->latest()
            ->paginate(12);

        $categories = Category::all();

        return view('videos.index', compact('videos', 'categories'));
    }

    public function show(Video $video)
    {
        if (!$video->is_approved && !auth()->user()->isAdmin()) {
            abort(404);
        }

        $video->increment('views');
        $relatedVideos = Video::where('category_id', $video->category_id)
            ->where('id', '!=', $video->id)
            ->where('is_approved', true)
            ->limit(5)
            ->get();

        return view('videos.show', compact('video', 'relatedVideos'));
    }

    public function create()
    {
        // Debug logging
        \Log::info('VideoController@create method called');
        \Log::info('User: ' . auth()->user()->email);
        \Log::info('User roles: ' . auth()->user()->roles->pluck('name')->implode(', '));
        
        $categories = Category::all();
        \Log::info('Categories count: ' . $categories->count());
        
        return view('videos.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'video_file' => 'required|file|mimes:mp4,webm,ogg,mov,avi|max:512000', // max 500MB
            'thumbnail' => 'required|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'video_url' => 'nullable|url',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['slug'] = Str::slug($validated['title'] . '-' . uniqid());
        $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        $validated['video_url'] = $request->file('video_file')->store('videos', 'public');

        Video::create($validated);

        return redirect()->route('home')->with('success', 'Video uploaded successfully and waiting for approval');
    }
}
