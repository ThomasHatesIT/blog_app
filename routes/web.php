<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use App\Models\Comment;
use App\Models\Blog;
use App\Models\User;

Route::get('/register', [RegisterUserController::class, 'index'])->name('register');
Route::post('/register', [RegisterUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'index'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');

Route::get('/', function () {
    return view('layouts.app');
});



Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
 Route::get('/blogs/create', [BlogController::class, 'create'])->middleware('auth')->name('blogs.create');
 ;Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');

Route::post('/comment', [CommentsController::class, 'store'])->middleware('auth')->name('comment.store');
Route::patch('/comment/{id}', [CommentsController::class, 'update'])->name('comment.update');
Route::delete('/comment/{id}', [CommentsController::class, 'destroy'])->name('comment.destroy');

Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blogs.show');
Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])
    ->middleware('auth')
    ->name('blogs.edit');
Route::patch('/blogs/{id}', [BlogController::class, 'update'])->name('blogs.update');
Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');


Route::get('/test-blogs', function() {
    return 'Test route works!';
});

