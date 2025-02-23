<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoCommentController extends Controller
{
    public function store(Request $request, Video $video)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        $comment = new Comment();
        $comment->content = $validated['content'];
        $comment->user_id = Auth::id();
        $comment->commentable_type = Video::class;
        $comment->commentable_id = $video->id;
        $comment->save();

        return redirect()->back()->with('success', 'Comment posted successfully!');
    }

    public function destroy(Video $video, Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully!');
    }
}