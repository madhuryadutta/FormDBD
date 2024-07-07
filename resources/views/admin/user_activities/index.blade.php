@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>User Activities</h2>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="userActivitiesTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Activity Type</th>
                            <th>Description</th>
                            <th>User</th>
                            <th>IP Address</th>
                            <th>Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($userActivities as $activity)
                        <tr>
                            <td>{{ $activity->activity_type }}</td>
                            <td>{{ $activity->description }}</td>
                            <td>{{ $activity->user->name }}</td>
                            <td>{{ $activity->ip_address }}</td>
                            <td>{{ $activity->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#userActivitiesTable').DataTable({
            "order": [], // Disable initial sorting
            "pagingType": "full_numbers", // Enable full pagination
            "pageLength": 25, // Number of rows per page
            "lengthMenu": [10, 25, 50, 75, 100], // Options for rows per page
            "language": {
                "lengthMenu": "Show _MENU_ entries",
                "search": "Search:",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                }
            }
        });
    });
</script>
@endsection