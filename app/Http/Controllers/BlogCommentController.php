<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    public function store(Request $request, Blog $blog)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = $blog->comments()->create([
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Comment posted successfully!');
    }

    public function destroy(Blog $blog, Comment $comment)
    {
        if ($comment->user_id !== auth()->id() && $blog->user_id !== auth()->id()) {
            abort(403);
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully!');
    }
}