<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Comment;
class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'blog_id' => 'required|exists:blogs,id',
            'body' => 'required|string|max:1000',
        ]);

        Comment::create([
            'user_id' => Auth::id(), // make sure user is logged in
            'blog_id' => $request->blog_id,
            'body' => $request->body,
        ]);

        return redirect()->back()->with('success', 'Comment posted.');
    }

 public function update(Request $request, $id)
{
    $validated = $request->validate([
        'update_body' => 'required|string|max:1000',
    ]);

    $comment = Comment::findOrFail($id);

    // Update the comment body
    $comment->body = $validated['update_body'];

    // Save will automatically update updated_at timestamp
    $comment->save();

    return redirect()->back()->with('success', 'Comment updated.');
}
 public function destroy($id)
{

        $comment = Comment::findOrFail($id);
        $postID = $comment->blog_id;
        $comment->delete();

        return redirect("/blogs/{$postID}");


}
}