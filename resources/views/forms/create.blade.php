@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-white mb-4">Create Form</h1>

        <form action="{{ route('forms.store') }}" method="POST" class="max-w-md mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" novalidate>
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Form Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                @error('name')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="response_type" class="block text-gray-700 text-sm font-bold mb-2">Response Type</label>
                <select id="response_type" name="response_type" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="web" @if(old('response_type') == 'web') selected @endif>Web</option>
                    <option value="json" @if(old('response_type') == 'json') selected @endif>API (JSON) </option>
                </select>
                @error('response_type')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="callback_url" class="block text-gray-700 text-sm font-bold mb-2">Callback URL</label>
                <input type="url" id="callback_url" name="callback_url" value="{{ old('callback_url') }}" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('callback_url')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="note" class="block text-gray-700 text-sm font-bold mb-2">Note</label>
                <textarea id="note" name="note" rows="3" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('note') }}</textarea>
                @error('note')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="ip_tracking" class="flex items-center">
                    <input type="checkbox" id="ip_tracking" name="ip_tracking" class="form-checkbox h-5 w-5 text-blue-600" @if(old('ip_tracking')) checked @endif>
                    <span class="ml-2 text-gray-700 text-sm font-bold">Track IP Address</span>
                </label>
            </div>

            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create</button>
        </form>
    </div>
@endsection
