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
            $bookCount = 0;
            ?>
            <table>
                @for ($i = 0; $i < count($items); $i++)
                    @for ($j = 0; $j < $items[$i]['quantity']; $j++)
                    <tr>
                        <td>
                            <div class="prev-single-mini">
                                <img class="book-img" src="{{ asset('storage/' . $books[$bookCount][0]['mainImage']) }}"
                                    alt="{{ $books[$bookCount][0]['book_name'] }}">
                            </div>
                        </td>
                        <?php 
                        $total += $books[$bookCount][0]['price'];
                        ?>
                        <td>
                            <p>{{$books[$bookCount][0]['book_name']}}</p>
                        </td>
                        <td>
                            <p>£{{number_format($books[$bookCount][0]['price'],2)}}</p>
                        </td>
                        <td>
                            <form action="{{ route('order.return', $items[$i]['id']) }}" method="POST">
                                @csrf
                                @method('delete')
                                <input class="prev-return-btn" type="submit" value="Return">
                            </form>
                        </td>
                        <?php 
                        $bookCount ++;
                        ?>
                    </tr>
                    @endfor
                @endfor
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
        </div>
    </div>
@endsection