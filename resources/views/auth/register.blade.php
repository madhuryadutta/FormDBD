@extends('layouts.business')

@section('title', 'Register')

@section('content')
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-lg mx-auto bg-gray-800 p-8 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold mb-6 text-center text-white">Register</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-400">Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="block mt-1 w-full bg-gray-700 border-gray-600 text-gray-200 rounded-md shadow-sm">
                        @error('name')
                            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-400">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="block mt-1 w-full bg-gray-700 border-gray-600 text-gray-200 rounded-md shadow-sm">
                        @error('email')
                            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-400">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password" class="block mt-1 w-full bg-gray-700 border-gray-600 text-gray-200 rounded-md shadow-sm">
                        @error('password')
                            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-400">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="block mt-1 w-full bg-gray-700 border-gray-600 text-gray-200 rounded-md shadow-sm">
                        @error('password_confirmation')
                            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Already registered? -->
                    <div class="flex items-center justify-between mt-4">
                        <a href="{{ route('login') }}" class="text-sm text-gray-400 hover:text-gray-200">Already registered?</a>
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
