<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentsController;
use App\Models\Comment;
use App\Models\Blog;
use App\Models\User;

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
 Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
 ;Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');

Route::post('/comment', [CommentsController::class, 'store'])->name('comment.store');
Route::patch('/comment/{id}', [CommentsController::class, 'update'])->name('comment.update');

Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blogs.show');
Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
Route::patch('/blogs/{id}', [BlogController::class, 'update'])->name('blogs.update');
Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');


Route::get('/test-blogs', function() {
    return 'Test route works!';
});

