@extends('layouts.app')

@section('main')
    <div class="main">
        <h1 class="mt-5">Admin Dashboard</h1>
        <div class="admin-dashboard-wrapper">
            @include('layouts.admin-sidebar')
            <div class="admin-dashboard-div">
                <div class="queries-stats stats-card">
                    <h4>Unprocessed Queries:</h4>
                    <p>{{ $queries }}</p>
                </div>
                <div class="books-stats stats-card">
                    <h4>Books Out Of Stock:</h4>
                    <p>{{ $outOfStock }}</p>
                </div>
                <div class="orders-stats stats-card">
                    <h4>Pending Orders:</h4>
                    <p>{{ $orders }}</p>
                </div>
                {{-- //add sales, graph with amount of books sold,  --}}
            </div>
        </div>
    </div>
@endsection
