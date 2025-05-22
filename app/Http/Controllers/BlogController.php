<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
    $post = Blog::findOrFail($id);

    $comments = Comment::where('blog_id', $id)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('blog.show', [
        'post' => $post,
        'comments' => $comments,
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

    public function edit($id){
    $post = Blog::findOrFail($id);

    return view('blog.edit', [
        'post' => $post,
    ]);
    }

    public function update(Request $request, $id){

       $validated = $request->validate([
        'title' => ['required', 'string', 'min:3'],
        'category' => ['required', 'string'],
        'body' => ['required', 'string'],
    ]);

    $post = Blog::findOrFail($id);
    $post->update($validated);



    
        return redirect("/blogs/{$post->id}");
    }



    public function destroy($id){

      $post = Blog::findOrFail($id);
        $post->delete();

        return redirect('/blogs');
    }




}