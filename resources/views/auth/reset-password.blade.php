@extends('layouts.business')

@section('title', 'Reset Password')

@section('content')
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-lg mx-auto bg-gray-800 p-8 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold mb-6 text-center text-white">Reset Password</h2>

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-400">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" class="block mt-1 w-full bg-gray-700 border-gray-600 text-gray-200 rounded-md shadow-sm">
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

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
