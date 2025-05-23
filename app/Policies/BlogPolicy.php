<?php

namespace App\Policies;
use Illuminate\Auth\Access\Response;
use App\Models\User;
use App\Models\Blog;
class BlogPolicy
{
  public function edit(User $user, Blog $blog): bool
    {
 return $blog->user->is($user);
    }
    


}
