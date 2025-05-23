<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'My Blog')</title>
    <!-- Tailwind CSS -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @yield('styles')
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
   <!-- Navbar -->
<nav class="bg-indigo-600 text-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex items-center">
                    <i class="fas fa-pen-fancy mr-2 text-xl"></i>
                    <span class="font-bold text-xl">My Blog</span>
                </a>
            </div>
            
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ url('/') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-indigo-500 {{ request()->is('/') ? 'bg-indigo-700' : '' }}">Home</a>
                <a href="{{ url('/blogs') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-indigo-500 {{ request()->is('blog*') ? 'bg-indigo-700' : '' }}">Blog</a>
            </div>
            
            <div class="flex items-center">
                @guest
                    <!-- Show Login and Register buttons for guests -->
                    <a href="{{ route('login') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-indigo-500">Login</a>
                    <a href="{{ route('register') }}" class="ml-3 px-3 py-2 rounded-md text-sm font-medium bg-white text-indigo-600 hover:bg-gray-100">Register</a>
                @else
                    <!-- Show user dropdown for authenticated users -->
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" class="flex items-center text-sm font-medium rounded-md focus:outline-none hover:bg-indigo-500 px-3 py-2">
                            <span class="mr-1">{{ Auth::user()->username  }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 py-1 z-50">
                            <a href="{{ url('/blogs/create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-plus mr-2"></i>Create Post
                            </a>
                            <a href="{{ url('/profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user mr-2"></i>Profile
                            </a>
                            <div class="border-t border-gray-100"></div>
                            <form action="{{ route('logout') }}" method="POST" class="block">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
            
            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden">
                <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-indigo-500 focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile menu -->
    <div class="mobile-menu hidden md:hidden bg-indigo-700">
        <a href="{{ url('/') }}" class="block px-4 py-2 text-base font-medium hover:bg-indigo-500 {{ request()->is('/') ? 'bg-indigo-800' : '' }}">Home</a>
        <a href="{{ url('/blog') }}" class="block px-4 py-2 text-base font-medium hover:bg-indigo-500 {{ request()->is('blog*') ? 'bg-indigo-800' : '' }}">Blog</a>
        
        @guest
            <!-- Mobile login/register buttons -->
            <div class="border-t border-indigo-600 pt-2">
                <a href="{{ route('login') }}" class="block px-4 py-2 text-base font-medium hover:bg-indigo-500">Login</a>
                <a href="{{ route('register') }}" class="block px-4 py-2 text-base font-medium hover:bg-indigo-500">Register</a>
            </div>
        @else
            <!-- Mobile user menu -->
            <div class="border-t border-indigo-600 pt-2">
                <div class="px-4 py-2 text-base font-medium text-indigo-200">
                    {{ Auth::user()->username ?? Auth::user()->name }}
                </div>
                <a href="{{route('blogs.create')}}" class="block px-4 py-2 text-base font-medium hover:bg-indigo-500">Create Post</a>
                <a href="{{ url('/profile') }}" class="block px-4 py-2 text-base font-medium hover:bg-indigo-500">Profile</a>
                <form action="{{ route('logout') }}" method="POST" class="block">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium hover:bg-indigo-500">Logout</button>
                </form>
            </div>
        @endguest
    </div>
</nav>
    <!-- Main Content -->
    <main class="flex-grow py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            
            @if(session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <p>© {{ date('Y') }} My Blog. All rights reserved.</p>
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-300 hover:text-white">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <!-- Custom JS -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        // Mobile menu toggle
        document.querySelector('.mobile-menu-button').addEventListener('click', function() {
            document.querySelector('.mobile-menu').classList.toggle('hidden');
        });
    </script>
    @yield('scripts')
</body>
</html>