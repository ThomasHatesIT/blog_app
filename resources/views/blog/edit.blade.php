@extends('layouts.app')

@section('title', 'Edit Blog Post')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css" rel="stylesheet">
<style>
    .form-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }
    
    .form-card {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    
    .form-input {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 2px solid #e5e7eb;
        background: rgba(255, 255, 255, 0.8);
    }
    
    .form-input:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        background: rgba(255, 255, 255, 1);
        transform: translateY(-1px);
    }
    
    .form-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
        display: block;
        font-size: 0.875rem;
        letter-spacing: 0.025em;
    }
    
   .btn-primary {
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    border: none;
    box-shadow: 0 4px 14px 0 rgba(99, 102, 241, 0.39);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    z-index: 1;
    cursor: pointer;
}

.btn-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: -1;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px 0 rgba(99, 102, 241, 0.5);
}

.btn-primary:hover::before {
    opacity: 1;
}
    
    .btn-secondary {
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid #e5e7eb;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .btn-secondary:hover {
        background: rgba(249, 250, 251, 1);
        border-color: #d1d5db;
        transform: translateY(-1px);
    }
    
    .error-container {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        border-left: 4px solid #ef4444;
        animation: slideInDown 0.3s ease-out;
    }
    
    @keyframes slideInDown {
        from {
            transform: translateY(-10px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
    
    .file-input-container {
        position: relative;
        overflow: hidden;
        display: inline-block;
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        border: 2px dashed #d1d5db;
        border-radius: 0.75rem;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        width: 100%;
    }
    
    .file-input-container:hover {
        border-color: #6366f1;
        background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%);
    }
    
    .file-input {
        position: absolute;
        left: -9999px;
    }
    
    .header-section {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 1rem;
        padding: 1.5rem;
        margin-bottom: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .header-title {
        background: linear-gradient(135deg, #1f2937 0%, #4b5563 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 2.25rem;
        font-weight: 800;
        letter-spacing: -0.025em;
    }
    
    .section-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent 0%, #e5e7eb 50%, transparent 100%);
        margin: 2rem 0;
    }
    
    .checkbox-container {
        display: flex;
        align-items: center;
        padding: 1rem;
        background: rgba(249, 250, 251, 0.8);
        border-radius: 0.75rem;
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
    }
    
    .checkbox-container:hover {
        background: rgba(243, 244, 246, 1);
    }
    
    .category-select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 1rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 3rem;
    }
</style>
@endsection

@section('content')
    <div class="form-container">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="header-section">
                <div class="flex items-center justify-between">
                    <h1 class="header-title">Edit Post</h1>
                    <a href="{{ route('blogs.index') }}" class="inline-flex items-center px-6 py-3 bg-white/20 backdrop-blur-sm border border-white/30 rounded-xl font-semibold text-sm text-gray-700 hover:bg-white/30 transition-all duration-300 group">
                        <i class="fas fa-arrow-left mr-2 transition-transform group-hover:-translate-x-1"></i> 
                        Back to Posts
                    </a>
                </div>
            </div>

            <div class="form-card rounded-2xl overflow-hidden">
                <div class="p-8">
                    @if ($errors->any())
                        <div class="error-container rounded-xl p-6 mb-8">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-triangle text-red-500 text-lg"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-red-800 mb-2">
                                        Please fix the following errors:
                                    </h3>
                                    <ul class="text-sm text-red-700 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li class="flex items-center">
                                                <i class="fas fa-circle text-xs mr-2"></i>
                                                {{ $error }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="/blogs/{{ $post->id }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                                @method('PATCH')
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <div class="lg:col-span-2">
                                <label for="title" class="form-label">Post Title</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" 
                                    class="form-input w-full rounded-xl px-4 py-3 text-lg"
                                    placeholder="Enter title here"
                                    required autofocus>
                            </div>
                            
                      <div>
    <label for="category" class="form-label">Category</label>
    <select name="category" id="category" class="form-input category-select w-full rounded-xl px-4 py-3">
        <option value="">Select a category</option>
        <option value="technology" {{ old('category', $post->category ?? '') == 'technology' ? 'selected' : '' }}>
            <i class="fas fa-laptop-code"></i> Technology
        </option>
        <option value="design" {{ old('category', $post->category ?? '') == 'design' ? 'selected' : '' }}>
            <i class="fas fa-palette"></i> Design
        </option>
        <option value="development" {{ old('category', $post->category ?? '') == 'development' ? 'selected' : '' }}>
            <i class="fas fa-code"></i> Development
        </option>
        <option value="news" {{ old('category', $post->category ?? '') == 'news' ? 'selected' : '' }}>
            <i class="fas fa-newspaper"></i> News
        </option>
    </select>
</div>
                            
                            <div class="lg:col-span-2">
                                <label for="body" class="form-label">Post Content</label>
                                <textarea name="body" id="body" rows="12" 
                                    class="form-input w-full rounded-xl px-4 py-3 resize-none"
                                    placeholder=""
                                    required>{{ old('body', $post->body) }}</textarea>
                            </div>
                            
                            <div class="lg:col-span-2">
                                <label class="form-label">Featured Image (Optional)</label>
                                <div class="file-input-container">
                                    <input type="file" name="featured_image" id="featured_image" class="file-input" accept="image/*">
                                    <div class="text-center">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                                        <p class="text-lg font-semibold text-gray-700 mb-2">
                                            Drop your image here or click to browse
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            PNG, JPG, GIF up to 10MB
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="section-divider"></div>
                        
                        <div class="flex items-center justify-between pt-4">
                            <div class="checkbox-container">
                                <input type="checkbox" name="published" id="published" 
                                    class="h-5 w-5 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded transition-all duration-200" 
                                    {{ old('published') ? 'checked' : '' }}>
                                <label for="published" class="ml-3 text-sm font-medium text-gray-700 cursor-pointer">
                                    <i class="fas fa-rocket mr-2 text-indigo-500"></i>
                                    Publish immediately
                                </label>
                            </div>
                            
                            <div class="flex space-x-4">
                                <button type="button" onclick="window.history.back()" 
                                    class="btn-secondary inline-flex items-center px-6 py-3 rounded-xl font-semibold text-sm text-gray-700 uppercase tracking-wider">
                                    <i class="fas fa-times mr-2"></i>
                                    Cancel
                                </button>
                                <button type="submit" 
                                    class="btn-primary inline-flex items-center px-8 py-3 rounded-xl font-semibold text-sm text-white uppercase tracking-wider">
                                    <i class="fas fa-plus mr-2"></i>
                                    Save 
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Enhanced file input functionality
    document.getElementById('featured_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const container = document.querySelector('.file-input-container');
        
        if (file) {
            const fileName = file.name;
            const fileSize = (file.size / 1024 / 1024).toFixed(2);
            
            container.innerHTML = `
                <div class="text-center">
                    <i class="fas fa-check-circle text-4xl text-green-500 mb-4"></i>
                    <p class="text-lg font-semibold text-gray-700 mb-2">
                        ${fileName}
                    </p>
                    <p class="text-sm text-gray-500">
                        ${fileSize} MB
                    </p>
                </div>
            `;
            container.style.borderColor = '#10b981';
            container.style.background = 'linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%)';
        }
    });
    
    // Add smooth focus transitions
    document.querySelectorAll('.form-input').forEach(input => {
        input.addEventListener('focus', function() {
            this.style.transform = 'translateY(-1px)';
        });
        
        input.addEventListener('blur', function() {
            this.style.transform = 'translateY(0)';
        });
    });
</script>
@endsection