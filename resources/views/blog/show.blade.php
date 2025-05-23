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

            {{-- Post Content --}}
            <div class="prose max-w-none text-gray-800 leading-relaxed">
                {!! nl2br(e($post->body)) !!}
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex items-center justify-between mb-8">
            <a href="{{ url('/blogs') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-200 transition">
               <i class="fas fa-arrow-left mr-2"></i> Back to Posts
            </a>

            <div class="flex space-x-3">
                {{-- Edit Button --}}
                @can('edit', $post)
                    
                
                <a href="{{ route('blogs.edit', $post->id) }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 transition">
                   <i class="fas fa-edit mr-2"></i> Edit Post
                </a>
                @endcan
                {{-- Delete Button --}}
       
                    
            
                <form action="{{ route('blogs.destroy', $post->id) }}" method="POST" id="deleteForm">
                             @can('edit', $post)
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="confirmDelete()"
                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 transition">
                       <i class="fas fa-trash-alt mr-2"></i> Delete Post
                    </button>
                        @endcan
                </form>
            </div>
        </div>

        {{-- Comments Section --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            {{-- Comments Header --}}
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                    <i class="fas fa-comments mr-2 text-indigo-600"></i>
                    Comments ({{ $post->comments->count() }})
                </h3>
            </div>

            <div class="p-6">
                {{-- Add Comment Form --}}
                <div class="mb-8">
                    <h4 class="text-md font-medium text-gray-700 mb-3">Leave a Comment</h4>
                   <form action="/comment" method="POST" class="space-y-4">
    @csrf
    <input type="hidden" name="blog_id" value="{{ $post->id }}">

    <div>
        <textarea name="body" id="comment-content" rows="4" 
            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 resize-none"
            placeholder="Share your thoughts..." required>{{ old('body') }}</textarea>
        @error('body')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="flex justify-end">
        <button type="submit" 
            class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500">
            <i class="fas fa-paper-plane mr-2"></i> Post Comment
        </button>
    </div>
</form>

                </div>

                {{-- Comments List --}}
                @if($post->comments->count() > 0)
                    <div class="space-y-6">
                        @foreach($post->comments as $comment)
                            <div class="border-l-4 border-gray-200 pl-4 py-3" id="comment-{{ $comment->id }}">
                                {{-- Comment Header --}}
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex items-center text-sm text-gray-600">
                                            <i class="fas fa-user-circle mr-2 text-lg text-gray-400"></i>
                                            <span class="font-medium">{{ $comment->user->username ?? 'Anonymous' }}</span>
                                        </div>
                                       <div class="text-xs text-gray-500">
                                            <i class="far fa-clock mr-1"></i>
                                         Created at   {{ $comment->created_at->diffForHumans() }}
                                            @if($comment->created_at != $comment->updated_at)
                                                <span class="text-gray-400">(edited {{ $comment->updated_at->diffForHumans() }})</span>
                                            @endif
                                        </div>

                                    </div>

                                    {{-- Comment Actions (removed auth requirements) --}}
                               
 
                                    <div class="flex space-x-2">
                                                
                                             @can('edit', $comment)
                                        <button onclick="editComment({{ $comment->id }})" 
                                            class="text-blue-600 hover:text-blue-800 text-sm">
                                       
                                            <i class="fas fa-edit"></i>
                                        </button>
                                            @endcan
                                        <form action="{{ route('comment.destroy', $comment->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                             @can('edit', $comment)
                                            <button type="submit" 
                                                onclick="return confirm('Are you sure you want to delete this comment?')"
                                                class="text-red-600 hover:text-red-800 text-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                                    @endcan
                                        </form>
                                    </div>
                                         
                                </div>

                                {{-- Comment Content --}}
                                <div class="comment-content-{{ $comment->id }}">
                                    <p class="text-gray-700 leading-relaxed">{{ $comment->body }}</p>
                                </div>

                                {{-- Edit Form (Hidden by default) --}}
                                <div class="comment-edit-form-{{ $comment->id }} hidden mt-3">
                                  <form action="{{ route('comment.update', $comment->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <textarea name="update_body" rows="3" 
                                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 resize-none"
                                            required>{{ $comment->body }}</textarea>
                                        <div class="flex justify-end space-x-2 mt-2">
                                            <button type="button" onclick="cancelEdit({{ $comment->id }})" 
                                                class="px-3 py-1 text-sm bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                                                Cancel
                                            </button>
                                            <button type="submit" 
                                                class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
                                                Update
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-comment-slash text-4xl mb-4 text-gray-300"></i>
                        <p class="text-lg">No comments yet</p>
                        <p class="text-sm">Be the first to share your thoughts!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Delete Post Confirmation Modal --}}
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mt-4">Delete Post</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        Are you sure you want to delete this post? This action cannot be undone and all associated data will be permanently removed.
                    </p>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="confirmDelete"
                        class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md w-24 mr-2 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">
                        Delete
                    </button>
                    <button id="cancelDelete"
                        class="px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-24 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function confirmDelete() {
        if (confirm('Are you sure you want to delete this post? This action cannot be undone.')) {
            document.getElementById('deleteForm').submit();
        }
    }
    
    // Comment editing functions
    function editComment(commentId) {
        const contentDiv = document.querySelector(`.comment-content-${commentId}`);
        const editForm = document.querySelector(`.comment-edit-form-${commentId}`);
        
        contentDiv.classList.add('hidden');
        editForm.classList.remove('hidden');
    }
    
    function cancelEdit(commentId) {
        const contentDiv = document.querySelector(`.comment-content-${commentId}`);
        const editForm = document.querySelector(`.comment-edit-form-${commentId}`);
        
        contentDiv.classList.remove('hidden');
        editForm.classList.add('hidden');
    }
    
    // Modal functionality
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForm = document.getElementById('deleteForm');
        const deleteModal = document.getElementById('deleteModal');
        const confirmDeleteBtn = document.getElementById('confirmDelete');
        const cancelDeleteBtn = document.getElementById('cancelDelete');

        if (deleteForm && deleteModal) {
            confirmDeleteBtn.addEventListener('click', function() {
                deleteForm.submit();
            });

            cancelDeleteBtn.addEventListener('click', function() {
                deleteModal.classList.add('hidden');
            });

            // Close modal when clicking outside
            deleteModal.addEventListener('click', function(e) {
                if (e.target === deleteModal) {
                    deleteModal.classList.add('hidden');
                }
            });
        }
    });
</script>
@endsection