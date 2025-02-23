<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $forums = Forum::latest()->paginate(10);
        return view('admin.forums.index', compact('forums'));
    }

    public function create()
    {
        return view('admin.forums.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|in:active,inactive'
        ]);

        Forum::create($validated);

        return redirect()->route('admin.forums.index')
            ->with('success', 'Forum created successfully.');
    }

    public function edit(Forum $forum)
    {
        return view('admin.forums.edit', compact('forum'));
    }

    public function update(Request $request, Forum $forum)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|in:active,inactive'
        ]);

        $forum->update($validated);

        return redirect()->route('admin.forums.index')
            ->with('success', 'Forum updated successfully.');
    }

    public function destroy(Forum $forum)
    {
        $forum->delete();

        return redirect()->route('admin.forums.index')
            ->with('success', 'Forum deleted successfully.');
    }
}