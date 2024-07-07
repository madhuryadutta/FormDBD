@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-white mb-4">Forms</h1>

    <!-- Create Form Button -->
    <a href="{{ route('forms.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md mb-4 inline-block">Create Form</a>

    <!-- List of Forms -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($forms as $form)
        <div class="border border-gray-700 rounded-md overflow-hidden hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
            <div class="p-4">
                <h2 class="text-white text-xl font-semibold mb-2">{{ $form->name }}</h2>
                <p class="text-gray-300 mb-4">{{ $form->description }}</p> <!-- Add description or other relevant data -->

                <!-- Management Button -->
                <a href="{{ route('forms.show', $form->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded-md mr-2">Manage</a>

                <!-- Button to view related submissions -->
                <a href="{{ route('entries.index', $form->id) }}" class="bg-gray-700 hover:bg-gray-600 text-white py-2 px-4 rounded-md">View Submissions</a>
            </div>
        </div>
        @empty
        <div class="text-gray-400 text-center py-6">
            No forms found.
        </div>
        @endforelse
    </div>
</div>
@endsection