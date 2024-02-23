@extends('layouts.app')

@section('main')
    <div class="main">
        <h1 class="mt-5">Admin Dashboard</h1>
        <div class="admin-dashboard-wrapper">
            @include('layouts.admin-sidebar')
            <div class="admin-dashboard-div">
                <div class="summary-div">
                    <div class="queries-stats stats-card">
                        <h4>Unprocessed Queries:</h4>
                        <p>{{ $queriesPending }}</p>
                    </div>
                    <div class="books-stats stats-card">
                        <h4>Books Out Of Stock:</h4>
                        <p>{{ $outOfStock }}</p>
                    </div>
                    <div class="orders-stats stats-card">
                        <h4>Pending Orders:</h4>
                        <p>{{ $ordersPending }}</p>
                    </div>
                </div>
                {{-- //add sales, graph with amount of books sold,  --}}
                <h4>Last Week's Insight</h4>
                <canvas id="stats-chart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script>
        var ctx = document.getElementById('stats-chart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($dates) !!},
                datasets: [{
                        label: 'Queries Received',
                        data: {!! json_encode($queries) !!},
                        fill: false,
                        borderColor: 'rgb(220, 149, 133)',
                        tension: 0.1
                    },
                    {
                        label: 'Books Sold',
                        data: {!! json_encode($booksSold) !!},
                        fill: false,
                        borderColor: '#546912',
                        tension: 0.1
                    },
                    {
                        label: 'Orders Placed',
                        data: {!! json_encode($orders) !!},
                        fill: false,
                        borderColor: 'rgba(255, 206, 86, 1)',
                        tension: 0.1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
