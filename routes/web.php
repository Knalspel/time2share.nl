<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;
use App\Http\Middleware\BlockedUserMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified', BlockedUserMiddleware::class])->group(function () {
    Route::get('/dashboard', function () {
        $userId = Auth::id();

        return view('dashboard', [
            'loaningProducts' => Product::where('loaner_id', $userId) 
                ->where('status', 'LOANING')
                ->latest()
                ->get(),
            'returnProducts' => Product::where('loaner_id', $userId)
                ->where('status', 'RETURN')
                ->latest()
                ->get(),
        ]);
    })->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/new', function() {
            return view('products/new');
        })->name('new');
    });

    Route::middleware('auth')->get('/my-products', function() {
        return view('products/my-products', [
            'products' => Product::where('user_id', Auth::id())->latest()->get(),
        ]);
    })->name('my-products');

    Route::get('/search', [ProductController::class, 'search'])->name('products.search');

    Route::get('/admin', function () {
        if (!Auth::check() || !Auth::user()->admin) {
            abort(403); // Forbidden access
        }

        return view('adminpanel', [
            'users' => User::all(),
            'products' => Product::all(),
        ]);
    })->middleware('auth')->name('adminpanel');

    Route::resource('products', ProductController::class)
        ->only(['index', 'store', 'search', 'edit', 'update', 'destroy', 'show'])
        ->middleware(['auth', 'verified']);

    Route::middleware(['auth'])->group(function () {
        Route::post('/users/{id}/block', function ($id) {
            if (!Auth::user()->admin) {
                abort(403, 'Unauthorized');
            }
            if (Auth::id() == $id) {
                return redirect()->back()->with('error', "You cannot block yourself!");
            }

            $user = User::findOrFail($id);
            $user->blocked = true;
            $user->save();

            return redirect()->back()->with('success', 'User blocked successfully.');
        })->name('admin.blockUser');

        Route::post('/users/{id}/unblock', function ($id) {
            if (!Auth::user()->admin) {
                abort(403, 'Unauthorized');
            }
            if (Auth::id() == $id) {
                return redirect()->back()->with('error', "You cannot block yourself!");
            }

            $user = User::findOrFail($id);
            $user->blocked = false;
            $user->save();

            return redirect()->back()->with('success', 'User unblocked successfully.');
        })->name('admin.unblockUser');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
        Route::patch('/products/{product}/loan', [ProductController::class, 'loan'])->name('products.loan');
        Route::patch('/products/{product}/return', [ProductController::class, 'return'])->name('products.return');
        Route::post('/products/{product}/review', [ReviewController::class, 'store'])->name('reviews.store');
        Route::post('review-store', [ReviewController::class, 'store'])->name('review.store');
    });
});

require __DIR__.'/auth.php';
