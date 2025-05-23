<?php

namespace App\Policies;
use Illuminate\Auth\Access\Response;
use App\Models\User;
use App\Models\Comment;
class CommentPolicy
{
   public function edit(User $user, Comment $comment): bool
    {
 return $comment->user->is($user);
    }
    
}
