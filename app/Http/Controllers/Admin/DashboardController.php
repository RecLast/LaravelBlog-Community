<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\ForumPost;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get recent blogs
        $blogs = Blog::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($blog) {
                return (object) [
                    'user' => $blog->user,
                    'type' => 'blog',
                    'title' => $blog->title,
                    'created_at' => $blog->created_at,
                    'description' => "Created a new blog post: {$blog->title}"
                ];
            });

        // Get recent forum posts
        $forumPosts = ForumPost::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($post) {
                return (object) [
                    'user' => $post->user,
                    'type' => 'forum',
                    'title' => $post->title,
                    'created_at' => $post->created_at,
                    'description' => "Posted in forum: {$post->title}"
                ];
            });

        // Get recent videos
        $videos = Video::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($video) {
                return (object) [
                    'user' => $video->user,
                    'type' => 'video',
                    'title' => $video->title,
                    'created_at' => $video->created_at,
                    'description' => "Uploaded a new video: {$video->title}"
                ];
            });

        // Merge all activities and sort by created_at
        $recentActivities = $blogs->concat($forumPosts)
            ->concat($videos)
            ->sortByDesc('created_at')
            ->take(10);

        // Get some basic statistics
        $stats = [
            'totalUsers' => User::count(),
            'totalBlogs' => Blog::count(),
            'totalForums' => ForumPost::count(),
            'totalVideos' => Video::count(),
        ];

        return view('admin.dashboard', array_merge(['recentActivities' => $recentActivities], $stats));
    }
}