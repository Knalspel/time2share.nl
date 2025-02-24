<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
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

Route::get('/search', [ProductController::class, 'search'])->name('products.search');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::patch('/products/{product}/loan', [ProductController::class, 'loan'])->name('products.loan');
Route::patch('/products/{product}/return', [ProductController::class, 'return'])->name('products.return');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');


Route::resource('products', ProductController::class)
    ->only(['index', 'store', 'search', 'edit', 'update', 'destroy', 'show'])
    ->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
