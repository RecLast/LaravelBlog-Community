<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::with(['user', 'members'])->latest()->paginate(10);
        return view('groups.index', compact('groups'));
    }

    public function create()
    {
        return view('groups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'privacy' => 'required|in:public,private,hidden'
        ]);

        $group = new Group();
        $group->name = $request->name;
        $group->slug = Str::slug($request->name);
        $group->description = $request->description;
        $group->privacy = $request->privacy;
        $group->owner_id = Auth::id();
        $group->save();

        return redirect()->route('groups.show', $group)
            ->with('success', 'Group created successfully.');
    }

    public function show(Group $group)
    {
        $group->load(['members']);
        return view('groups.show', compact('group'));
    }

    public function edit(Group $group)
    {
        $this->authorize('update', $group);
        return view('groups.edit', compact('group'));
    }

    public function update(Request $request, Group $group)
    {
        $this->authorize('update', $group);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'privacy' => 'required|in:public,private,hidden'
        ]);

        $group->name = $request->name;
        $group->slug = Str::slug($request->name);
        $group->description = $request->description;
        $group->privacy = $request->privacy;
        $group->save();

        return redirect()->route('groups.show', $group)
            ->with('success', 'Group updated successfully.');
    }

    public function destroy(Group $group)
    {
        $this->authorize('delete', $group);
        $group->delete();

        return redirect()->route('groups.index')
            ->with('success', 'Group deleted successfully.');
    }
}