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
                        <form action="{{ route('queries.status', $query['id']) }}" method="POST">
                            @csrf
                        <select name="status">
                            <option value="not reviewed" <?php if($query['status'] == "not reviewed"){echo("selected");} ?>>Not Reviewed</option>
                            <option value="open" <?php if($query['status'] == "open"){echo("selected");} ?>>Open</option>
                            <option value="closed" <?php if($query['status'] == "closed"){echo("selected");} ?>>Closed</option>
                        </select>
                        
                            <button class="btn">Change Status</button>
                        </form>
                        <button class="btn"><a href="mailto:{{$query['email']}}">Respond</a></button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
