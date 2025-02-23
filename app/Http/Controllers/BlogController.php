<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BlogController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $blogs = Blog::with('category', 'user')->latest()->paginate(10);
        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::ofType('blog')->get();
        $tags = Tag::all();
        return view('blogs.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->content = $request->content;
        $blog->category_id = $request->category_id;
        $blog->user_id = Auth::id();

        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $extension = $image->getClientOriginalExtension();
            $filename = Str::slug($request->title) . '-' . uniqid() . '.' . $extension;
            
            // Store the image in the public disk
            $image->storeAs('blogs', $filename, 'public');
            $blog->featured_image = 'blogs/' . $filename;
        }

        $blog->save();

        if ($request->has('tags')) {
            $blog->tags()->sync($request->tags);
        }

        return redirect()->route('blogs.index')
            ->with('success', 'Blog post created successfully.');
    }

    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        $this->authorize('update', $blog);
        $categories = Category::all();
        $tags = Tag::all();
        return view('blogs.edit', compact('blog', 'categories', 'tags'));
    }

    public function togglePublish(Blog $blog)
    {
        $this->authorize('update', $blog);
        
        $blog->is_published = !$blog->is_published;
        $blog->save();

        $status = $blog->is_published ? 'published' : 'unpublished';
        return redirect()->back()->with('success', "Blog post {$status} successfully.");
    }

    public function update(Request $request, Blog $blog)
    {
        $this->authorize('update', $blog);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->content = $request->content;
        $blog->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('blogs', $filename, 'public');
            $blog->image = $path;
        }

        $blog->save();

        return redirect()->route('blogs.index')
            ->with('success', 'Blog post updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $this->authorize('delete', $blog);

        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()->route('blogs.index')
            ->with('success', 'Blog post deleted successfully.');
    }
}