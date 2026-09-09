<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuItemController;

// Public Home Route
Route::get('/', function () {
    return view('welcome');
});

// Public Dynamic Page Viewer Route
Route::get('/page/{slug}', [PageController::class, 'show'])->name('pages.show');

// Public Blog Post Routes
Route::get('/posts', [PostController::class, 'publicIndex'])->name('posts.index');
Route::get('/posts/{slug}', [PostController::class, 'publicShow'])->name('posts.show');

// Public Category Filtering Route
Route::get('/category/{slug}', [PostController::class, 'publicByCategory'])->name('categories.show');

// Admin Routes (Protected by Breeze Authentication)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Admin CMS Resources
    Route::resource('pages', PageController::class);
    
    // Custom Post Image Upload Route (Placed before resource to avoid route clashes)
    Route::post('posts/upload-image', [PostController::class, 'uploadImage'])->name('posts.upload_image');
    
    Route::resource('posts', PostController::class);
    Route::resource('categories', CategoryController::class);

    // Admin Menu Builder
    Route::get('/menu', [MenuItemController::class, 'index'])->name('menu.index');
    Route::post('/menu', [MenuItemController::class, 'store'])->name('menu.store');
    Route::put('/menu/{menuItem}', [MenuItemController::class, 'update'])->name('menu.update');
    Route::delete('/menu/{menuItem}', [MenuItemController::class, 'destroy'])->name('menu.destroy');
});

// Breeze Dashboard Redirect
Route::middleware(['auth'])->get('/dashboard', function () {
    return redirect()->route('admin.pages.index');
})->name('dashboard');

// Breeze Profile Management Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('profile.edit', [
            'user' => auth()->user(),
        ]);
    })->name('profile.edit');

    Route::patch('/profile', function (\Illuminate\Http\Request $request) {
        $user = auth()->user();
        $user->fill($request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]));
        $user->save();

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    })->name('profile.update');

    Route::delete('/profile', function (\Illuminate\Http\Request $request) {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    })->name('profile.destroy');
});

// Breeze Auth Routes (Loaded automatically from routes/auth.php)
require __DIR__.'/auth.php';