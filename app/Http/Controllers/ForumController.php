<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\ForumPost;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ForumController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $categories = Category::with(['forums' => function($query) {
            $query->active();
        }])->ofType('forum')->active()->get();

        return view('forums.index', compact('categories'));
    }

    public function show(Forum $forum)
    {
        $posts = $forum->posts()
            ->with(['user'])
            ->latest()
            ->paginate(20);

        return view('forums.show', compact('forum', 'posts'));
    }

    public function create()
    {
        $this->authorize('create', Forum::class);
        $categories = Category::ofType('forum')->active()->get();
        return view('forums.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Forum::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id'
        ]);

        $forum = new Forum();
        $forum->name = $validated['title'];
        $forum->description = $validated['description'];
        $forum->category_id = $validated['category_id'];
        $forum->user_id = Auth::id();
        $forum->slug = Str::slug($validated['title']);
        $forum->save();

        return redirect()->route('forums.show', $forum)
            ->with('success', 'Forum created successfully.');
    }

    public function createPost(Forum $forum)
    {
        $this->authorize('create', ForumPost::class);
        return view('forums.posts.create', compact('forum'));
    }

    public function storePost(Request $request, Forum $forum)
    {
        $this->authorize('create', ForumPost::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        $post = new ForumPost();
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->forum_id = $forum->id;
        $post->user_id = Auth::id();
        $post->slug = Str::slug($validated['title']);
        $post->save();

        return redirect()->route('forums.show', $forum)
            ->with('success', 'Topic created successfully.');
    }
}