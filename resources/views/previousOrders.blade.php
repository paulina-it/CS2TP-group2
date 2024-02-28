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
                    <th>Product(s)</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Date Ordered</th>
                    {{--<th>Status</th>
                    <th>Return</th>--}}
                </tr>
                @for ($i = 0; $i < count($orders); $i++)
                <tr class="prev-order" onclick="location.href='{{ route('order.show', $orders[$i]['id']) }}'">
                    <?php
                    $count = 0;
                    $total = 0;
                    $maxBooks = 0;
                    $quantity = 0;
                    ?>
                    
                    <td>
                        <div class="prev-order-info">
                            @for ($j = 0; $j < count($books); $j++)
                                @if ($books[$j][0] == $i)
                                    @if ($maxBooks > 7)
                                        <p>...</p>
                                        @break
                                    @endif
                                    <div class="prev-single">
                                        <img class="book-img" src="{{ asset('storage/' . $books[$j][1][0]['mainImage']) }}"
                                            alt="{{ $books[$j][1][0]['book_name'] }}">
                                        <?php 
                                        $total += $books[$j][1][0]['price'];
                                        $maxBooks ++;
                                         ?>
                                    </div>
                                @endif
                            @endfor
                        </div>
                    </td>
                    <td>
                        <p>
                            @for ($j = 0; $j < count($books); $j++)
                                @if ($books[$j][0] == $i)
                                    <?php 
                                    $quantity ++
                                        ?>
                                @endif
                            @endfor
                            {{$quantity}}
                        </p>
                    </td>
                    <td> £{{$total}} </td>
                    <?php
                    $date = DATE($items[$i][$count]['created_at']);
                    $dt = new DateTime($date);
                    $count++
                    ?>
                    <td>{{ $dt->format('Y-m-d') }}</td>
                    {{--<td>
                    <label>{{ $orders[$i]['status'] }}</label>
                    </td>
                    <td>
                    <form action="{{ route('order.return', $orders[$i]['id']) }}" method="POST">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Return">
                    </form>
                    </td>--}}
                </tr>
                @endfor
            </table>
        </div>
    </div>
@endsection