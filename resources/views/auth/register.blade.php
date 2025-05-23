{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.app')

@section('title', 'Register')

@section('content')
<x-form-card>
    <x-auth.header 
        title="Create your account"
        subtitle="Join us today! Please fill in your information."
    />

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-md">
            <p class="text-sm text-red-600">{{ session('error') }}</p>
        </div>
    @endif

    <form method="POST" action="/register">
        @csrf

        <x-form-input 
            label="Username"
            name="username"
            type="text"
            placeholder="Choose a username"
            required
        />

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
            placeholder="Create a password"
            required
        />

        <x-form-input 
            label="Confirm Password"
            name="password_confirmation"
            type="password"
            placeholder="Confirm your password"
            required
        />

        <div class="mb-6">
            <div class="flex items-center">
                <input 
                    id="terms" 
                    name="terms" 
                    type="checkbox" 
                    required
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                >
                <label for="terms" class="ml-2 block text-sm text-gray-700">
                    I agree to the 
                    <a href="#" class="text-blue-600 hover:text-blue-500 font-medium">Terms of Service</a>
                    and 
                    <a href="#" class="text-blue-600 hover:text-blue-500 font-medium">Privacy Policy</a>
                    <span class="text-red-500">*</span>
                </label>
            </div>
            @error('terms')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <x-form-button>
            Create Account
        </x-form-button>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Already have an account? 
                <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                    Sign in here
                </a>
            </p>
        </div>
    </form>
</x-form-card>
@endsection