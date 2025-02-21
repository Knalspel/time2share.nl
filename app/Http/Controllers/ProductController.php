<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('products.list', [
            'products' => Product::with('user')->latest()->get(),
            ]);
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

    //      
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'string|max:100',
            'deadline' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'string',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }
        $validated['user_id'] = $request->user()->id;
        $request->user()->products()->create($validated);

        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        Gate::authorize('update', $product);

        return view('products.edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        Gate::authorize('update', $product);
 
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'string|max:100',
            'deadline' => 'required|date',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'string',
        ]);
        
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);
        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        Gate::authorize('delete', $product);
        $product->delete();
        return redirect(route('products.index'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category');
        $products = Product::query();

        if (!empty($query)) {
            $products->where('name', 'LIKE', "%{$query}%");
        }
        if (!empty($category)) {
            $products->where('category', $category);
        }

        $products = $products->get();
        return view('products.list', compact('products', 'query', 'category'));
    }

    public function loan(Request $request, Product $product): RedirectResponse
    {
        $product->update([
            'loaner_id' => Auth::id(),
            'status' => 'LOANING',
        ]);

        return redirect(route('products.index'));
    }

    public function return(Request $request, Product $product): RedirectResponse
    {
        $product->update([
            'status' => 'RETURNED',
        ]);

        return redirect(route('products.index'));
    }
}
