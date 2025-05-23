<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    /** @use HasFactory<\Database\Factories\BlogFactory> */
    use HasFactory;

    protected $table = 'blogs';
      protected $fillable = ['user_id', 'blog_id' ,'title', 'body', 'category'];

     public function user() {
    return $this->belongsTo(User::class);
}


      public function comments()
{
    return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
}

}
