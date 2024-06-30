@extends('layouts.app')

@section('content')
    <h1>Create Form</h1>
    <form action="{{ route('forms.store') }}" method="POST" class="needs-validation" novalidate>
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Form Name</label>
            <input type="text" id="name" name="name" class="form-control" required>
            <div class="invalid-feedback">
                Please provide a name for the form.
            </div>
        </div>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
@endsection
