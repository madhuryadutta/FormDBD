@extends('layouts.app')

@section('content')
    <h1>Add Field to {{ $form->name }}</h1>
    <form action="{{ route('fields.store', $form->id) }}" method="POST" class="needs-validation" novalidate>
        @csrf
        <div class="mb-3">
            <label for="label" class="form-label">Field Label</label>
            <input type="text" id="label" name="label" class="form-control" required>
            <div class="invalid-feedback">
                Please provide a label for the field.
            </div>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Field Name</label>
            <input type="text" id="name" name="name" class="form-control" required>
            <div class="invalid-feedback">
                Please provide a name for the field.
            </div>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Field Type</label>
            <select id="type" name="type" class="form-select" required>
                <option value="text">Text</option>
                <option value="email">Email</option>
                <option value="textarea">Textarea</option>
            </select>
            <div class="invalid-feedback">
                Please select a type for the field.
            </div>
        </div>
        <button type="submit" class="btn btn-success">Add Field</button>
    </form>
@endsection
