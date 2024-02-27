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
    <div class="prev-orders-main">
        <h1 class="title">Previous Order</h1>
        <div class="prev-orders-single-list">
            <?php 
            $total = 0;
            ?>
            @foreach ($books as $book)
            <div class="prev-single-mini">
                <img class="book-img" src="{{ asset('storage/' . $book[0]['mainImage']) }}"
                    alt="{{ $book[0]['book_name'] }}">
            </div>
            <div class="prev-single-details">
                <?php 
                $total += $book[0]['price'];
                ?>
                <p>£{{$book[0]['price']}}</p>
                <form action="{{ route('order.return', $book[0]['id']) }}" method="POST">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Return">
                </form>
                </td>
            </div>
            @endforeach
            <?php
            $date = DATE($items[0]['created_at']);
            $dt = new DateTime($date);
            ?>
            <p>£{{ $total }}</p>
            <label>{{ $order[0]['status'] }}</label>
            <p>{{ $dt->format('Y-m-d') }}</p>
        </div>
    </div>
@endsection