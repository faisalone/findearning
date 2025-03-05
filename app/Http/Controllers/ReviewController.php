<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ReviewController extends Controller
{
    /**
     * Constructor to add authentication middleware
     */
    public function __construct()
    {
        $this->middleware(AdminMiddleware::class)->only(['index', 'toggleStatus',]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all reviews with their relationships
        $reviews = Review::with(['user', 'product'])->latest()->get();
        
        return view('dashboard.reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created review in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $review = new Review();
        $review->product_id = $product->id;
        $review->user_id = Auth::id();
        $review->rating = $validated['rating'];
        $review->comment = $validated['comment'];
        $review->status = false; // Default to pending/requires approval
        
        // Handle image upload if provided
        if ($request->hasFile('image')) {
            // Store the file and get its path
            $imagePath = $request->file('image')->store('reviews', 'public');
            
            // Ensure the path is stored correctly - make it explicit
            $review->image_path = $imagePath;
            
            // Debug information - uncomment if needed
            // \Log::info('Image path saved: ' . $imagePath);
        }
        
        // Save the review with all its properties
        $review->save();
        
        return redirect()->back()->with('success', 'Thank you! Your review has been submitted and is pending approval.');
    }

    /**
     * Toggle the status of the specified review.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleStatus(Review $review)
    {
        $review->status = !$review->status;
        $review->save();
        
        $status = $review->status ? 'approved' : 'unapproved';
        return redirect()->back()->with('success', "Review has been $status.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        // Delete the review image if it exists
        if ($review->image_path) {
            Storage::disk('public')->delete($review->image_path);
        }
        $review->delete();
        
        return redirect()->back()->with('success', 'Review deleted successfully.');
    }
}
