@extends('layouts.app')

@section('content')
<div class="container">
    <h1>List of Users</h1>

    @if ($users->isEmpty())
    <div class="alert alert-info">
        No active users found.
    </div>
    @else
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->is_admin)
                        <span class="badge badge-primary">Admin</span>
                        @else
                        <span class="badge badge-secondary">User</span>
                        @endif
                    </td>
                    <td>
                    <td>
                        @if (!$user->is_admin)
                        <form action="{{ route('user.makeadmin', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-success">Make Admin</button>
                        </form>
                        @else
                        <form action="{{ route('user.removeadmin', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-warning">Remove Admin</button>
                        </form>
                        @endif
                    </td>
                    </td>
                    <td>
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-info">Edit</a>
                        <form action="{{ route('user.disable', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-danger">Disable</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection