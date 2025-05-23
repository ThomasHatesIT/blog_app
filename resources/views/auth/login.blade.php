{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')

@section('title', 'Login')

@section('content')
<x-form-card>
    <x-auth.header 
        title="Sign in to your account"
        subtitle="Welcome back! Please enter your details."
    />

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-md">
            <p class="text-sm text-red-600">{{ session('error') }}</p>
        </div>
    @endif

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-md">
            <p class="text-sm text-green-600">{{ session('success') }}</p>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <x-form-input 
            label="Email Address"
            name="email"
            type="email"
            placeholder="Enter your email"
            required
        />

        <x-form-input 
            label="Password"
            name="password"
            type="password"
            placeholder="Enter your password"
            required
        />

        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <input 
                    id="remember_me" 
                    name="remember" 
                    type="checkbox" 
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                >
                <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                    Remember me
                </label>
            </div>

            <div class="text-sm">
                <a href="" class="font-medium text-blue-600 hover:text-blue-500">
                    Forgot your password?
                </a>
            </div>
        </div>

        <x-form-button>
            Sign In
        </x-form-button>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Don't have an account? 
                <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500">
                    Sign up here
                </a>
            </p>
        </div>
    </form>
</x-form-card>
@endsection