@extends('layouts.app')

@section('title', 'Create New Blog Post')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Create New Post</h1>
            <a href="{{ url('/blog') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring focus:ring-gray-200 transition">
                <i class="fas fa-arrow-left mr-2"></i> Back to Posts
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-400"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">
                                    Please fix the following errors:
                                </h3>
                                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ url('/blog') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Post Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            required autofocus>
                    </div>
                    
                    <div class="mb-6">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select name="category" id="category" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">Select a category</option>
                            <option value="technology" {{ old('category') == 'technology' ? 'selected' : '' }}>Technology</option>
                            <option value="design" {{ old('category') == 'design' ? 'selected' : '' }}>Design</option>
                            <option value="development" {{ old('category') == 'development' ? 'selected' : '' }}>Development</option>
                            <option value="news" {{ old('category') == 'news' ? 'selected' : '' }}>News</option>
                        </select>
                    </div>
                    
                    <div class="mb-6">
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                        <textarea name="content" id="content" rows="12" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            required>{{ old('content') }}</textarea>
                    </div>
                    
                    <div class="mb-6">
                        <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-1">Featured Image (Optional)</label>
                        <div class="mt-1 flex items-center">
                            <span class="inline-block h-12 w-12 rounded-md overflow-hidden bg-gray-100">
                                <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </span>
                            <input type="file" name="featured_image" id="featured_image" 
                                class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                        <div class="flex items-center">
                            <input type="checkbox" name="published" id="published" 
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" {{ old('published') ? 'checked' : '' }}>
                            <label for="published" class="ml-2 block text-sm text-gray-900">
                                Publish immediately
                            </label>
                        </div>
                        
                        <div class="flex space-x-3">
                            <button type="button" onclick="window.history.back()" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 transition">
                                Cancel
                            </button>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 transition">
                                Create Post
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
<script>
    // Initialize markdown editor
    const easyMDE = new EasyMDE({
        element: document.getElementById('content'),
        spellChecker: false,
        autosave: {
            enabled: true,
            delay: 1000,
            uniqueId: 'blog-post-content'
        },
        placeholder: 'Type your content here...',
        toolbar: ['bold', 'italic', 'heading', '|', 'quote', 'unordered-list', 'ordered-list', '|', 'link', 'image', '|', 'preview', 'guide']
    });
</script>
@endsection