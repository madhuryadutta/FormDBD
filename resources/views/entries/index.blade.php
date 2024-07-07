<!-- resources/views/entries/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 px-4">
    <h1 class="text-3xl font-bold text-white mb-6">{{ $form->name }} - Submissions</h1>

    @if($entries->isEmpty())
        <div class="bg-blue-600 text-white p-4 rounded">
            No submissions found for this form.
        </div>
    @else
        <div class="bg-gray-800 p-4 rounded-lg shadow-md">
            <table id="submissionsTable" class="min-w-full bg-gray-900 text-white rounded-md">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-700">#</th>
                        @foreach($form->fields as $field)
                            <th class="py-2 px-4 border-b border-gray-700">{{ $field->label }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($entries as $entry)
                        <tr class="border-b border-gray-700">
                            <td class="py-2 px-4">{{ $loop->iteration }}</td>
                            @foreach($form->fields as $field)
                                <td class="py-2 px-4">{{ $entry->data[$field->name] ?? 'N/A' }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        $('#submissionsTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            responsive: true,
            language: {
                searchPlaceholder: "Search submissions",
                sSearch: "",
                sLengthMenu: "_MENU_"
            },
            initComplete: function() {
                $(".dt-buttons").addClass("flex space-x-2");
                $(".dt-buttons button").addClass("bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600");
            }
        });
    });
</script>
@endsection
