@extends('layouts.app')

@section('content')
    <h1>Edit Field for {{ $form->name }}</h1>
    <form action="{{ route('fields.update', [$form->id, $field->id]) }}" method="POST" class="needs-validation" novalidate>
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="label" class="form-label">Field Label</label>
            <input type="text" id="label" name="label" class="form-control" value="{{ $field->label }}" required>
            <div class="invalid-feedback">
                Please provide a label for the field.
            </div>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Field Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $field->name }}" required>
            <div class="invalid-feedback">
                Please provide a name for the field.
            </div>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Field Type</label>
            <select id="type" name="type" class="form-select" required>
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
            <div class="invalid-feedback">
                Please select a type for the field.
            </div>
        </div>
        <button type="submit" class="btn btn-success">Save Changes</button>
    </form>
@endsection
