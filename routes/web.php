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
Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blogs.show');

