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
        @for ($i = 0; $i < count($books); $i++)
            <p>{{ $books[$i][0]['book_name'] }}</p>
            <p>{{ $books[$i][0]['price'] }}</p>
        @endfor
        <form action="{{route('order.create')}}" method="POST">
            @csrf
            <input type="submit" value="Complete Order">
        </form>
@endsection