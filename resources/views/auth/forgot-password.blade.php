@extends('layouts.business')

@section('title', 'Forgot Password')

@section('content')
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-lg mx-auto bg-gray-800 p-8 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold mb-6 text-center text-white">Forgot Password</h2>
                
                <div class="mb-4 text-sm text-gray-400">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-400">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="block mt-1 w-full bg-gray-700 border-gray-600 text-gray-200 rounded-md shadow-sm">
                        @error('email')
                            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
                            {{ __('Email Password Reset Link') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
