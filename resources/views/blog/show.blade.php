@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">{{ $post->title }}</h1>
            <a href="{{ url('/blogs') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring focus:ring-gray-200 transition">
               <i class="fas fa-arrow-left mr-2"></i> Back to Posts
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6 p-6">
            <div class="flex items-center text-gray-500 text-sm mb-4 space-x-4">
                <div class="flex items-center">
                    <i class="fas fa-user-circle mr-2"></i>
                    <span>{{ $post->user->username }}</span>
                </div>
                <div class="flex items-center">
                    <i class="far fa-calendar-alt mr-2"></i>
                    <span>{{ $post->created_at->format('F d, Y') }}</span>
                </div>
                @if($post->category)
                    <div class="flex items-center">
                        <i class="fas fa-tag mr-2"></i>
                        <span class="capitalize">{{ $post->category }}</span>
                    </div>
                @endif
                @if($post->comments_count)
                    <div class="flex items-center">
                        <i class="far fa-comment mr-2"></i>
                        <span>{{ $post->comments_count }} {{ Str::plural('comment', $post->comments_count) }}</span>
                    </div>
                @endif
            </div>

            {{-- Assuming your post body is Markdown, you can use a markdown parser, or just output raw --}}
            <div class="prose max-w-none text-gray-800">
                {!! nl2br(e($post->body)) !!}
            </div>
        </div>

        <a href="{{ url('/blogs') }}" 
           class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 transition">
           <i class="fas fa-arrow-left mr-2"></i> Back to Posts
        </a>
    </div>
@endsection
