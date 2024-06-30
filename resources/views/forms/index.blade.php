@extends('layouts.app')

@section('content')
    <h1>Forms</h1>
    <a href="{{ route('forms.create') }}" class="btn btn-primary mb-3">Create Form</a>
    <div class="list-group">
        @foreach($forms as $form)
            <a href="{{ route('forms.show', $form->id) }}" class="list-group-item list-group-item-action">{{ $form->name }}</a>
        @endforeach
    </div>
@endsection
