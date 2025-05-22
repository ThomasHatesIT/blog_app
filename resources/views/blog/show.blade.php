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
            <div class="prose max-w-none text-gray-800">
                {!! nl2br(e($post->body)) !!}
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex items-center justify-between">
            <a href="{{ url('/blogs') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-200 transition">
               <i class="fas fa-arrow-left mr-2"></i> Back to Posts
            </a>

           
                    <div class="flex space-x-3">
                        {{-- Edit Button --}}
                        <a href="/blogs/{{ $post->id }}/edit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 transition">
                           <i class="fas fa-edit mr-2"></i> Edit Post
                        </a>

                        {{-- Delete Button --}}
                        <form action="" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this post? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 transition">
                               <i class="fas fa-trash-alt mr-2"></i> Delete Post
                            </button>
                        </form>
                    </div>
             
        </div>
    </div>

    {{-- Delete Confirmation Modal (Optional - for better UX) --}}
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
    // Enhanced delete confirmation with modal (optional)
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForm = document.querySelector('form[onsubmit*="confirm"]');
        const deleteModal = document.getElementById('deleteModal');
        const confirmDelete = document.getElementById('confirmDelete');
        const cancelDelete = document.getElementById('cancelDelete');

        if (deleteForm && deleteModal) {
            // Remove the default onsubmit and handle with modal instead
            deleteForm.removeAttribute('onsubmit');
            
            deleteForm.addEventListener('submit', function(e) {
                e.preventDefault();
                deleteModal.classList.remove('hidden');
            });

            confirmDelete.addEventListener('click', function() {
                deleteForm.submit();
            });

            cancelDelete.addEventListener('click', function() {
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