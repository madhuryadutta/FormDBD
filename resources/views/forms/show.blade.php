@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 px-4 bg-gray-900 text-white">
    <h1 class="text-3xl font-bold mb-4">{{ $form->name }}</h1>

    <!-- Add Field Button -->
    <a href="{{ route('fields.create', $form->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md mb-3 inline-block">Add Field</a>

    <!-- List of Fields -->
    <ul class="space-y-2">
        @foreach($form->fields as $field)
        <li class="border border-gray-700 rounded-md py-2 px-4 flex justify-between items-center bg-gray-800">
            <span class="text-white">{{ $field->label }} ({{ $field->type }})</span>
            <a href="{{ route('fields.edit', [$form->id, $field->id]) }}" class="bg-gray-600 hover:bg-gray-700 text-white py-1 px-3 rounded-md text-sm">Edit</a>
        </li>
        @endforeach
    </ul>

    <!-- Code Snippets -->
    <div class="mt-8 space-y-4">
        @foreach($codeSnippets as $codeSnippet)
        {!! $codeSnippet !!}
        @endforeach
    </div>
</div>
<!-- Clipboard.js CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize clipboard
        var clipboard = new ClipboardJS('.copy-button');

        // Success message on successful copy
        clipboard.on('success', function(e) {
            e.clearSelection();
            e.trigger.textContent = 'Copied!';
            setTimeout(function() {
                e.trigger.textContent = 'Copy Python';
            }, 2000); // Reset copy button text after 2 seconds
        });

        // Error message on copy failure
        clipboard.on('error', function(e) {
            e.trigger.textContent = 'Press Ctrl+C to copy';
            setTimeout(function() {
                e.trigger.textContent = 'Copy Python';
            }, 2000); // Reset copy button text after 2 seconds
        });
    });
</script>
@endsection