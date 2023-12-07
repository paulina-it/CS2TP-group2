@extends('layouts.app')
@section('localVite')
    <!-- Include Bootstrap CSS -->
    <link href="path/to/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Include Bootstrap JS -->
    <script src="path/to/bootstrap/js/bootstrap.bundle.min.js"></script>
@endsection
@section('main')
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        @for ($i = 0; $i < count($books); $i++)
            <p>{{ $books[$i][0]['book_name'] }}</p>
            <p>{{ $books[$i][0]['description'] }}</p>
            <p>{{ $books[$i][0]['author'] }}</p>
            <p>{{ $books[$i][0]['price'] }}</p>
            <form action="{{ route('basket.destroy', $books[$i][0]['id']) }}" method="POST">
                @csrf
                @method('delete')
                <input type="submit" value="Remove"/>
            </form>
            @php
            $total += $books[$i][0]['price'];
            @endphp   
        @endfor
        <p>Total: £{{$total}}</p>
        <form action="{{route('order.index')}}" method="GET">
            @csrf
            <input type="submit" value="Order">
        </form>
@endsection