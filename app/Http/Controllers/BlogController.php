<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
   public function index()
{
    $posts = Blog::simplePaginate(5); // Main blog list

    $recentPosts = Blog::latest()->take(5)->get(); // Latest 5 blog posts

    return view('blog.index', [
        'posts' => $posts,
        'recentPosts' => $recentPosts,
    ]);

}


public function show($id)
{
    $posts = Blog::findOrFail($id);

    return view('blog.show', [
        'post' => $posts,
    ]);
}

}