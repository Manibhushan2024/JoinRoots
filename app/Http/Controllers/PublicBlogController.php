<?php
namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class PublicBlogController extends Controller {
    public function index() {
        $blogs = BlogPost::where('is_published', true)
                 ->orderBy('published_at', 'desc')
                 ->paginate(9);
        return view('blog.index', compact('blogs'));
    }

    public function show(BlogPost $blog) {
        if (!$blog->is_published) {
            abort(404);
        }
        
        $relatedBlogs = BlogPost::where('is_published', true)
                        ->where('id', '!=', $blog->id)
                        ->where('category', $blog->category)
                        ->take(3)
                        ->get();
                        
        return view('blog.show', compact('blog', 'relatedBlogs'));
    }
}
