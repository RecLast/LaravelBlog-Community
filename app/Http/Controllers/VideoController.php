<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with(['user', 'category'])
            ->where(function($query) {
                $query->where('is_approved', true)
                      ->orWhere('user_id', Auth::id());
            })
            ->latest()
            ->paginate(12);

        return view('videos.index', compact('videos'));
    }

    public function create()
    {
        $categories = Category::ofType('video')->active()->get();
        return view('videos.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'youtube_url' => 'required|url',
            'category_id' => 'required|exists:categories,id'
        ]);

        $video = new Video();
        $video->title = $validated['title'];
        $video->slug = Str::slug($validated['title']);
        $video->description = $validated['description'];
        $video->youtube_url = $validated['youtube_url'];
        $video->category_id = $validated['category_id'];
        $video->user_id = Auth::id();
        $video->save();

        if ($request->has('tags')) {
            $video->tags()->sync($request->tags);
        }

        return redirect()->route('videos.show', $video->slug)
            ->with('success', 'Video created successfully!');
    }

    public function show($slug)
    {
        $video = Video::where('slug', $slug)->firstOrFail();
        $video->increment('views');
        $video->load(['user', 'category', 'tags']);
        
        // Extract video ID from YouTube URL
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $video->youtube_url, $matches);
        $video->youtube_id = $matches[1] ?? null;
        
        $relatedVideos = Video::where('category_id', $video->category_id)
            ->where('id', '!=', $video->id)
            ->where('is_approved', true)
            ->limit(3)
            ->get();

        return view('videos.show', compact('video', 'relatedVideos'));
    }

    public function edit(Video $video)
    {
        $this->authorize('update', $video);
        $categories = Category::ofType('video')->active()->get();
        return view('videos.edit', compact('video', 'categories'));
    }

    public function update(Request $request, Video $video)
    {
        $this->authorize('update', $video);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'youtube_url' => 'required|url',
            'category_id' => 'required|exists:categories,id'
        ]);

        $video->title = $validated['title'];
        $video->slug = Str::slug($validated['title']);
        $video->description = $validated['description'];
        $video->youtube_url = $validated['youtube_url'];
        $video->category_id = $validated['category_id'];
        $video->save();

        if ($request->has('tags')) {
            $video->tags()->sync($request->tags);
        }

        return redirect()->route('videos.show', $video->slug)
            ->with('success', 'Video updated successfully!');
    }

    public function destroy(Video $video)
    {
        $this->authorize('delete', $video);
        $video->delete();

        return redirect()->route('videos.index')
            ->with('success', 'Video deleted successfully!');
    }

    public function like(Video $video)
    {
        $video->increment('likes');
        return response()->json(['likes' => $video->likes]);
    }
}