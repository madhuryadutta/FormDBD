@extends('layouts.business')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-900">
    <div class="text-center">
        <h1 class="text-6xl font-bold text-white">503</h1>
        <p class="text-2xl text-gray-400 mt-4">Service Unavailable</p>
        <p class="text-gray-500 mt-2">We are currently undergoing maintenance. Please check back later.</p>
        <a href="{{ url('/') }}" class="mt-6 inline-block bg-blue-600 text-white px-4 py-2 rounded">Go to Homepage</a>
    </div>
</div>
@endsection
