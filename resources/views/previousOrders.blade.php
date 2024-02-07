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
        <h1 class="title">Previous Orders</h1>
        <div class="prev-orders-list">
            <table>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Date Ordered</th>
                    <th>Status</th>
                    <th>Return</th>
                </tr>
                @for ($i = 0; $i < count($orders); $i++)
                <tr>
                    <?php
                    $count = 0
                    ?>
                    @foreach ($books as $book)
                        @if($book[0] == $i) 
                            <tr>
                            <td>
                                <div class="prev-order">
                                <img class="opened-preview book-img-mini" src="{{ asset('storage/' . $book[1][0]['mainImage']) }}"
                                    alt="{{ $book[1][0]['book_name'] }}">
                                <div>
                                    <p class="name"> {{ $book[1][0]['book_name'] }}</p>
                                    <small>£{{ $book[1][0]['price'] }}</small>
                                    <br>
                                </div>
                            </td>
                            <td>{{ $items[$i][$count]['quantity'] }}</td>
                            <td> £{{$items[$i][$count]['quantity'] * $book[1][0]['price']}} </td>
                            <?php
                            $date = DATE($items[$i][$count]['created_at']);
                            $dt = new DateTime($date);
                            $count++
                            ?>
                            <td>{{ $dt->format('Y-m-d') }}</td>
                            </tr>
                        @endif
                    @endforeach
                    <td>
                    <label>{{ $orders[$i]['status'] }}</label>
                    </td>
                    <td>
                    <form action="{{ route('order.return', $orders[$i]['order_id']) }}" method="POST">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Return">
                    </form>
                    </td>
                </tr>
                @endfor
            </table>
        </div>
    </div>
@endsection