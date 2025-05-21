@extends('layouts.app')

@section('title', 'Blog Posts')

@section('content')
    <div class="flex flex-col md:flex-row gap-8">
        <div class="w-full md:w-2/3">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Blog Posts</h1>

                    <a href="/blogs/create" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 transition">
                        <i class="fas fa-plus mr-2"></i> New Post
                    </a>
              
            </div>
            
            @forelse($posts as $post)
                <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6 transition transform hover:shadow-lg hover:-translate-y-1">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2 hover:text-indigo-600">
                            <a href="/blogs/{{ $post['id'] }}">{{ $post->title }}</a>
                        </h2>
                        <div class="flex items-center text-gray-500 text-sm mb-4">
                            <i class="fas fa-user-circle mr-2"></i>
                            <span>{{ $post->user->username }}</span>
                            <span class="mx-2">•</span>
                            <i class="far fa-calendar-alt mr-2"></i>
                            <span>{{ $post->created_at->format('F d, Y') }}</span>
                            @if($post->comments_count)
                                <span class="mx-2">•</span>
                                <i class="far fa-comment mr-2"></i>
                                <span>{{ $post->comments_count }} {{ Str::plural('comment', $post->comments_count) }}</span>
                            @endif
                        </div>
                        <p class="text-gray-600 mb-4">{{ Str::limit($post->body, 200) }}</p>
                        <a href="/blogs/{{ $post['id'] }}" class="inline-block text-indigo-600 font-medium hover:text-indigo-500 hover:underline">
                            Read More <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">
                                No posts found. Be the first to create a blog post!
                            </p>
                        </div>
                    </div>
                </div>
            @endforelse
            
            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        </div>
        
        <div class="w-full md:w-1/3">
            <div class="bg-white rounded-lg shadow-md overflow-hidden sticky top-4">
                <div class="bg-gray-50 px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold text-gray-800">Recent Posts</h3>
                </div>
                <div class="p-6">
                    @if(count($recentPosts) > 0)
                        <ul class="space-y-3">
                            @foreach($recentPosts as $recentPost)
                                <li>
                                    <a href="{{ url('/blogs/' . $recentPost->id) }}" class="text-indigo-600 hover:text-indigo-500 hover:underline flex items-start">
                                        <i class="fas fa-file-alt mt-1 mr-2 text-gray-400"></i>
                                        <span>{{ $recentPost->title }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500 text-sm">No recent posts available.</p>
                    @endif
                </div>
                
                <div class="bg-gray-50 px-6 py-4 border-t border-b">
                    <h3 class="text-lg font-semibold text-gray-800">Categories</h3>
                </div>
                <div class="p-6">
                    <div class="flex flex-wrap gap-2">
                        <a href="#" class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm hover:bg-indigo-100 hover:text-indigo-800">Technology</a>
                        <a href="#" class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm hover:bg-indigo-100 hover:text-indigo-800">Design</a>
                        <a href="#" class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm hover:bg-indigo-100 hover:text-indigo-800">Development</a>
                        <a href="#" class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm hover:bg-indigo-100 hover:text-indigo-800">News</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection