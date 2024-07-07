@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8 px-4">
        <h1 class="text-3xl font-bold text-white mb-6">Form Submissions Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Total Submissions Card -->
            <div class="bg-gray-800 text-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-2">Total Submissions</h2>
                <p class="text-3xl font-bold">{{ $totalSubmissions }}</p>
            </div>

            <!-- Submissions Per Day Card -->
            <div class="bg-gray-800 text-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-2">Submissions Per Day (Last 7 Days)</h2>
                <canvas id="submissionsPerDayChart" class="mt-4"></canvas>
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
                                precision: 0,
                                fontColor: '#ffffff' // Adjust tick color for dark theme
                            },
                            gridLines: {
                                color: 'rgba(255, 255, 255, 0.1)' // Adjust grid line color for dark theme
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                fontColor: '#ffffff' // Adjust tick color for dark theme
                            },
                            gridLines: {
                                color: 'rgba(255, 255, 255, 0.1)' // Adjust grid line color for dark theme
                            }
                        }]
                    },
                    legend: {
                        labels: {
                            fontColor: '#ffffff' // Adjust legend label color for dark theme
                        }
                    }
                }
            });
        });
    </script>
@endsection
