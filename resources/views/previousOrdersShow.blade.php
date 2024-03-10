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
    <div class="prev-orders-show">
        <h1 class="title">Previous Order</h1>
        <div class="prev-orders-single-list">
            <?php 
            $total = 0;
            ?>
            <table>
                @foreach ($books as $book)
                <tr>
                    <td>
                        <div class="prev-single-mini">
                            <img class="book-img" src="{{ asset('storage/' . $book[0]['mainImage']) }}"
                                alt="{{ $book[0]['book_name'] }}">
                        </div>
                    </td>
                    <?php 
                    $total += $book[0]['price'];
                    ?>
                    <td>
                        <p>{{$book[0]['book_name']}}</p>
                    </td>
                    <td>
                        <p>£{{number_format($book[0]['price'],2)}}</p>
                    </td>
                </tr>
                @endforeach
            </table>
            <?php
            $date = DATE($items[0]['created_at']);
            $dt = new DateTime($date);
            $discount = null;
            if ($coupon) {
            $discount = $total * $coupon['discount'] / 100;
            $total -= $discount;
            }
            ?>
            @if ($discount)
            <p>Discount: £{{ number_format($discount,2) }}</p>
            @endif
            <p>Total: £{{ number_format($total,2) }}</p>
            <label>{{ $order[0]['status'] }}</label>
            <p>{{ $dt->format('Y-m-d') }}</p>
            @if ($order[0]['status'] != "refunded") 
            <form action="{{ route('order.return', $order[0]['id']) }}" method="POST">
                @csrf
                @method('delete')
                <input class="prev-return-btn" type="submit" value="Return">
            </form>
            @endif
        </div>
    </div>
@endsection