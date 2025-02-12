<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/new', function() {
    return view('products/new');
})->name('new');

Route::get('/my-products', function() {
    return view('products/my-products', [
        'products' => Product::with('user')->latest()->get(),
    ]);
})->name('my-products');

Route::get('/', [ProductController::class, 'index']);
Route::get('/search', [ProductController::class, 'search'])->name('products.search');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('products', ProductController::class)
    ->only(['index', 'store', 'search'])
    ->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
