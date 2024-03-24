@extends('layouts.app')
@section('main')
    <div class="prev-orders-wrapper wrapper-with-navbar min-h-[70vh]">
        @include('layouts.customer-profile-sidebar')
        <div class="prev-orders-main">
            <h1 class="title">Previous Orders</h1>
            <div class="prev-orders-list">
                <table class = "prev-table">
                    <tr>
                        <th>Product(s)</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Date Ordered</th>
                        <th>Status</th>
                    </tr>
                    @for ($i = 0; $i < count($orders); $i++)
                        <tr class="prev-order" onclick="location.href='{{ route('order.show', $orders[$i]['id']) }}'">

                            <?php
                            $count = 0;
                            $total = 0;
                            $maxBooks = 0;
                            $quantity = 0;
                            ?>
                            @if ($orders[$i]['status'] == 'refunded')
                            <td>
                                <p>This order has been fully returned</p>
                            </td>
                            @else

                                <td>
                                    <div class="prev-order-info">
                                        @for ($j = 0; $j < count($books); $j++)
                                            @if ($books[$j][0] == $i)
                                                @if ($maxBooks > 7)
                                                    <p>...</p>
                                                @break
                                            @endif
                                            <div class="prev-single">
                                                <img class="book-img"
                                                    src="{{ asset('storage/' . $books[$j][1][0]['mainImage']) }}"
                                                    alt="{{ $books[$j][1][0]['book_name'] }}">
                                                <?php
                                                $total += $books[$j][1][0]['price'];
                                                $maxBooks++;
                                                ?>
                                            </div>
                                        @endif
                                    @endfor
                                </div>
                        @endif
                        </td>
                        <?php
                        if ($coupons[$i]) {
                            $total -= ($total * $coupons[$i]['discount']) / 100;
                        }
                        ?>
                        <td>
                            <p>
                                @for ($j = 0; $j < count($books); $j++)
                                    @if ($books[$j][0] == $i)
                                        <?php
                                        $quantity++;
                                        ?>
                                    @endif
                                @endfor
                                {{ $quantity }}
                            </p>
                        </td>
                        <td> £{{ number_format($total, 2) }} </td>
                        <?php
                        $date = DATE($items[$i][$count]['created_at']);
                        $dt = new DateTime($date);
                        $count++;
                        ?>
                        <td>{{ $dt->format('Y-m-d') }}</td>
                        <td>
                            <label>{{ $orders[$i]['status'] }}</label>
                        </td>
                    </tr>
                @endfor
            </table>
        </div>
    </div>
</div>
@endsection
