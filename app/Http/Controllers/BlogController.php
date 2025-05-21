<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
public function index()
{
    $posts = Blog::orderBy('created_at', 'desc')->simplePaginate(5);
    $recentPosts = Blog::latest()->take(5)->get();

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

public function create()
{
   

    return view('blog.create');
}


public function store(Request $request)
{
    $validated = $request->validate([
        'title' => ['required', 'min:3'],
        'category' => ['required'],
        'body' => ['required'], // usually 'body' is text, not numeric
    ]);

    Blog::create($validated + ['user_id' => 1]);

    return redirect('/blogs');
}



}