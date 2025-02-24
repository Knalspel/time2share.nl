<?php

namespace App\Http\Controllers;

use App\Models\review;
use app\Http\Controllers\ProductController;
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:100',
            'text' => 'nullable|string|max:500',
            'score' => 'required|integer|min:1|max:5',
            'account_id' => 'required|exists:users,id', // Ensure account_id exists
        ]);

        Review::create([
            'reviewer_id' => auth()->id(),
            'account_id' => $validated['account_id'], // Product owner's ID
            'score' => $validated['score'],
            'title' => $validated['title'] ?? null,  // Default to null if empty
            'text' => $validated['text'] ?? null,    // Default to null if empty
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(review $review)
    {
        //
    }
}
