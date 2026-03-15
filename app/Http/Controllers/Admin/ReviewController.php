<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller {
    public function index() {
        $reviews = Review::orderBy('display_order')->get();
        return view('admin.reviews.index', compact('reviews'));
    }
    public function create() {
        return view('admin.reviews.create');
    }
    public function store(Request $request) {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'role'=>'nullable|string|max:255',
            'location'=>'nullable|string|max:255',
            'rating'=>'required|integer|min:1|max:5',
            'review_text'=>'required|string',
            'display_order'=>'required|integer|min:0',
        ]);
        
        $review = new Review($data);
        $review->is_approved = $request->has('is_approved');
        
        // Pick a random vibrant color for avatar if empty
        $colors = ['#2D6A4F', '#7C3AED', '#0891B2', '#D97706', '#DC2626', '#DB2777'];
        $review->avatar_color = $request->avatar_color ?? $colors[array_rand($colors)];
        
        $review->save();
        return redirect()->route('admin.reviews.index')->with('success','Review added successfully!');
    }
    public function edit(Review $review) {
        return view('admin.reviews.edit', compact('review'));
    }
    public function update(Request $request, Review $review) {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'role'=>'nullable|string|max:255',
            'location'=>'nullable|string|max:255',
            'rating'=>'required|integer|min:1|max:5',
            'review_text'=>'required|string',
            'display_order'=>'required|integer|min:0',
        ]);
        
        $review->fill($data);
        $review->is_approved = $request->has('is_approved');
        
        if ($request->filled('avatar_color')) {
            $review->avatar_color = $request->avatar_color;
        }
        
        $review->save();
        return redirect()->route('admin.reviews.index')->with('success','Review updated successfully!');
    }
    public function destroy(Review $review) {
        $review->delete();
        return redirect()->route('admin.reviews.index')->with('success','Review deleted.');
    }
    public function toggleApprove(Review $review) {
        $review->is_approved = !$review->is_approved;
        $review->save();
        return redirect()->back()->with('success', 'Review approval status updated.');
    }
}
