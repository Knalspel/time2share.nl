<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $reviewerId = auth()->user()->id;

        if ($product->user_id == $reviewerId) {
            $receiverId = $product->loaner_id;
        } elseif ($product->loaner_id == $reviewerId) {
            $receiverId = $product->user_id;
        } else {
            return back()->with('error', 'Unauthorized action.');
        }

        $existingReview = Review::where('reviewer_id', $reviewerId)->where('receiver_id', $receiverId)->where('product_id', $productId)->exists();

        if ($existingReview) {
            return back()->with('error', 'You have already reviewed this transaction.');
        }

        $request->validate([
            'score' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:250',
        ]);

        Review::create([
            'reviewer_id' => $reviewerId,
            'receiver_id' => $receiverId,
            'product_id' => $productId,
            'score' => $request->score,
            'comment' => $request->comment,
        ]);

        return back();
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
        //
    }
}
