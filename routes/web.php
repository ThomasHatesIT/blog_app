<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Models\Comment;
use App\Models\Blog;
use App\Models\User;

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
 Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
 Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blogs.show');





Route::get('/test-blogs', function() {
    return 'Test route works!';
});

