<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BlogController extends Controller {
    public function index() {
        $posts = BlogPost::orderBy('created_at', 'desc')->get();
        return view('admin.blog.index', compact('posts'));
    }
    public function create() {
        return view('admin.blog.create');
    }
    public function store(Request $request) {
        $data = $request->validate([
            'title'=>'required|string|max:255',
            'excerpt'=>'nullable|string',
            'content'=>'required|string',
            'author'  => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'video_url' => 'nullable|url|max:500',
        ]);
        
        $post = new BlogPost($data);
        $post->video_url = $request->input('video_url');
        $post->slug = Str::slug($request->title) . '-' . uniqid();
        $post->is_published = $request->has('is_published');
        if ($post->is_published) {
            $post->published_at = Carbon::now();
        }
        
        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('public/blog');
            $post->cover_image_url = Storage::url($path);
        }
        
        $post->save();
        return redirect()->route('admin.blog.index')->with('success','Blog post created successfully!');
    }
    public function edit(BlogPost $blog) {
        return view('admin.blog.edit', compact('blog'));
    }
    public function update(Request $request, BlogPost $blog) {
        $data = $request->validate([
            'title'=>'required|string|max:255',
            'excerpt'=>'nullable|string',
            'content'=>'required|string',
            'author'  => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'video_url' => 'nullable|url|max:500',
        ]);
        
        $blog->fill($data);
        $blog->video_url = $request->input('video_url');
        
        if ($request->has('is_published') && !$blog->is_published) {
            $blog->is_published = true;
            $blog->published_at = $blog->published_at ?? Carbon::now();
        } elseif (!$request->has('is_published')) {
            $blog->is_published = false;
        }
        
        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('public/blog');
            $blog->cover_image_url = Storage::url($path);
        }
        
        $blog->save();
        return redirect()->route('admin.blog.index')->with('success','Blog post updated successfully!');
    }
    public function destroy(BlogPost $blog) {
        $blog->delete();
        return redirect()->route('admin.blog.index')->with('success','Blog post deleted.');
    }
}
