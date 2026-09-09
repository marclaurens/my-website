<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

// Public Routes
Route::get('/', [PostController::class, 'index'])->name('home');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Admin Routes
Route::middleware('admin')->group(function () {
    Route::get('/drafts', [PostController::class, 'drafts'])->name('posts.drafts');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::patch('/posts/{post}/toggle', [PostController::class, 'togglePublish'])->name('posts.toggle');
    Route::post('/upload-image', [PostController::class, 'uploadImage'])->name('posts.upload_image');
});

// Public Wildcard Route (Must remain at the bottom)
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');