@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-900">
    <div class="text-center">
        <h1 class="text-6xl font-bold text-white">419</h1>
        <p class="text-2xl text-gray-400 mt-4">Page Expired</p>
        <p class="text-gray-500 mt-2">Your session has expired. Please refresh and try again.</p>
        <a href="{{ url()->previous() }}" class="mt-6 inline-block bg-blue-600 text-white px-4 py-2 rounded">Go Back</a>
    </div>
</div>
@endsection
