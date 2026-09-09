<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

// Public Homepage
Route::get('/', [PostController::class, 'index'])->name('home');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Explicit Post Routes (MUST be defined before the wildcard /posts/{post} route)
Route::get('/drafts', [PostController::class, 'drafts'])->name('posts.drafts');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::patch('/posts/{post}/toggle', [PostController::class, 'togglePublish'])->name('posts.toggle');

// Wildcard Route (Must come AFTER specific /posts/* routes)
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Inline Image Upload Route for CKEditor
Route::post('/upload-image', [PostController::class, 'uploadImage'])->name('posts.upload_image');