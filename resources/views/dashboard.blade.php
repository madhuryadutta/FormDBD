@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Form Submissions Dashboard</h1>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Submissions</h5>
                        <p class="card-text">{{ $totalSubmissions }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Submissions Per Day (Last 7 Days)</h5>
                        <canvas id="submissionsPerDayChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional analytics widgets can be added here -->

    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Submissions per day chart
            var ctx = document.getElementById('submissionsPerDayChart').getContext('2d');
            var submissionsPerDayData = @json($submissionsPerDay);

            var labels = submissionsPerDayData.map(function (entry) {
                return entry.date;
            });

            var data = submissionsPerDayData.map(function (entry) {
                return entry.count;
            });

            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Submissions',
                        data: data,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                precision: 0
                            }
                        }]
                    }
                }
            });
        });
    </script>
@endsection
