<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Blog;
use App\Models\Forum;
use App\Models\Video;
use Illuminate\Support\Collection;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function dashboard()
    {
        $totalUsers = User::count();
        $totalBlogs = Blog::count();
        $totalForums = Forum::count();
        $totalVideos = Video::count();

        // Collect recent activities from different models
        $recentBlogs = Blog::with('user')->latest()->take(5)->get()
            ->map(function ($blog) {
                return (object) [
                    'user' => $blog->user,
                    'type' => 'blog',
                    'title' => $blog->title,
                    'created_at' => $blog->created_at,
                    'description' => "Created a new blog post: {$blog->title}"
                ];
            });

        $recentForums = Forum::with('user')->latest()->take(5)->get()
            ->map(function ($forum) {
                return (object) [
                    'user' => $forum->user,
                    'type' => 'forum',
                    'title' => $forum->title,
                    'created_at' => $forum->created_at,
                    'description' => "Posted in forum: {$forum->title}"
                ];
            });

        $recentVideos = Video::with('user')->latest()->take(5)->get()
            ->map(function ($video) {
                return (object) [
                    'user' => $video->user,
                    'type' => 'video',
                    'title' => $video->title,
                    'created_at' => $video->created_at,
                    'description' => "Uploaded a new video: {$video->title}"
                ];
            });

        // Merge all activities and sort by creation date
        $recentActivities = $recentBlogs->concat($recentForums)
            ->concat($recentVideos)
            ->sortByDesc('created_at')
            ->take(10);

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalBlogs',
            'totalForums',
            'totalVideos',
            'recentActivities'
        ));
    }

    public function users()
    {
        $this->authorize('manage_users');
        $users = User::with('roles')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function roles()
    {
        $this->authorize('manage_roles');
        $roles = Role::with('permissions')->paginate(10);
        return view('admin.roles.index', compact('roles'));
    }
}