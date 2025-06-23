<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Category;
use App\Models\Country;
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
        $countries = Country::orderBy('name')->get();
        \Log::info('Categories count: ' . $categories->count());
        \Log::info('Countries count: ' . $countries->count());

        return view('videos.create', compact('categories', 'countries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'video_file' => 'required|file|mimes:mp4,webm,ogg,mov,avi|max:512000', // max 500MB
            'thumbnail' => 'required|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'country_id' => 'required|exists:countries,id',
            'video_url' => 'nullable|url',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['slug'] = Str::slug($validated['title'] . '-' . uniqid());
        $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        $validated['video_url'] = $request->file('video_file')->store('videos', 'public');

        Video::create($validated);

        return redirect()->route('home')->with('success', 'Video uploaded successfully and waiting for approval');
    }

    public function edit(Video $video)
    {
        // Check if user owns the video or is admin
        if ($video->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access to edit this video.');
        }

        $categories = Category::all();
        $countries = Country::orderBy('name')->get();

        return view('videos.edit', compact('video', 'categories', 'countries'));
    }

    public function update(Request $request, Video $video)
    {
        // Check if user owns the video or is admin
        if ($video->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access to edit this video.');
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'video_file' => 'nullable|file|mimes:mp4,webm,ogg,mov,avi|max:512000', // max 500MB
            'thumbnail' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'country_id' => 'required|exists:countries,id',
            'video_url' => 'nullable|url',
        ]);

        // Update slug if title changed
        if ($validated['title'] !== $video->title) {
            $validated['slug'] = Str::slug($validated['title'] . '-' . uniqid());
        }

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($video->thumbnail) {
                \Storage::disk('public')->delete($video->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // Handle video file upload
        if ($request->hasFile('video_file')) {
            // Delete old video file
            if ($video->video_url && \Str::startsWith($video->video_url, 'videos/')) {
                \Storage::disk('public')->delete($video->video_url);
            }
            $validated['video_url'] = $request->file('video_file')->store('videos', 'public');

            // Reset approval status if video file is changed
            $validated['is_approved'] = false;
        }

        $video->update($validated);

        return redirect()->route('videos.show', $video)->with('success', 'Video updated successfully!');
    }
}
