<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of published blog posts.
     */
    public function index(Request $request)
    {
        $query = BlogPost::where('status', 'published')
            ->with('category')
            ->orderBy('published_at', 'desc');

        // Filter by category if provided
        if ($request->has('category') && $request->category) {
            $category = BlogCategory::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        $posts = $query->paginate(3);
        $categories = BlogCategory::all();

        return view('blog.index', compact('posts', 'categories'));
    }

    /**
     * Display the specified blog post.
     */
    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)
            ->where('status', 'published')
            ->with('category')
            ->firstOrFail();

        // Get recent posts (excluding current post)
        $recentPosts = BlogPost::where('status', 'published')
            ->where('id', '!=', $post->id)
            ->with('category')
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        $categories = BlogCategory::all();

        return view('blog.show', compact('post', 'recentPosts', 'categories'));
    }
}