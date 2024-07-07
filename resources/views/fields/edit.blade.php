@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8 px-4 bg-gray-900 text-white">
        <h1 class="text-3xl font-bold mb-4">Edit Field for {{ $form->name }}</h1>

        <!-- Form -->
        <form action="{{ route('fields.update', [$form->id, $field->id]) }}" method="POST" class="needs-validation" novalidate>
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="label" class="block text-sm font-medium mb-1">Field Label</label>
                <input type="text" id="label" name="label" value="{{ $field->label }}" class="form-input w-full bg-gray-800 text-white border border-gray-700 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" required>
                <div class="invalid-feedback mt-1">
                    Please provide a label for the field.
                </div>
            </div>
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium mb-1">Field Name</label>
                <input type="text" id="name" name="name" value="{{ $field->name }}" class="form-input w-full bg-gray-800 text-white border border-gray-700 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" required>
                <div class="invalid-feedback mt-1">
                    Please provide a name for the field.
                </div>
            </div>
            <div class="mb-6">
                <label for="type" class="block text-sm font-medium mb-1">Field Type</label>
                <select id="type" name="type" class="form-select w-full bg-gray-800 text-white border border-gray-700 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" required>
                    <option value="text" {{ $field->type == 'text' ? 'selected' : '' }}>Text</option>
                    <option value="email" {{ $field->type == 'email' ? 'selected' : '' }}>Email</option>
                    <option value="textarea" {{ $field->type == 'textarea' ? 'selected' : '' }}>Textarea</option>
                    <option value="number" {{ $field->type == 'number' ? 'selected' : '' }}>Number</option>
                    <option value="date" {{ $field->type == 'date' ? 'selected' : '' }}>Date</option>
                    <option value="checkbox" {{ $field->type == 'checkbox' ? 'selected' : '' }}>Checkbox</option>
                    <option value="radio" {{ $field->type == 'radio' ? 'selected' : '' }}>Radio</option>
                    <option value="select" {{ $field->type == 'select' ? 'selected' : '' }}>Select</option>
                    <!-- Add more types as needed -->
                </select>
                <div class="invalid-feedback mt-1">
                    Please select a type for the field.
                </div>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md">Save Changes</button>
        </form>
    </div>
@endsection
