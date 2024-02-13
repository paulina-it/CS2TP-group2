@extends('layouts.app')

@section('main')
    <div class="main">
        <h1 class="mt-5">User Queries</h1>
        <div class="queries-list">
            @foreach ($queries as $query)
                <div class="query-card">
                    <div class="query-card-info">
                        <p class="query-author"><u>Sent By:</u> <br><br> {{ $query['firstName'].' '.$query['lastName'] }}</p>
                        <p class="query-email"><u>Email:</u> <br><br> {{ $query['email'] }}</p>
                        <p class="query-type"><u>Type:</u> <br><br>{{ $query['query_type'] }}</p>
                        <p class="query-status"><u>Satus:</u> <br><br>{{ $query['status'] }}</p>
                        <p class="query-message"><u>Message:</u> <br><br>{{ $query['message'] }}</p>
                    </div>
                    <div class="query-card-btns">
                        <button class="btn">Change Status</button>
                        <button class="btn">Respond</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
