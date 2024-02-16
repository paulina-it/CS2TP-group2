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
                </tr>
                <tr class="prev-order" onclick="location.href='{{ route('order.previous') }}'">
                    <td>
                        <div class="prev-order-info">
                            @for ($i = 0; $i < 8; $i++)
                                <div class="prev-single">
                                    <img class="book-img" src="/images/Anna-Karenina.jpg">
                                </div>
                            @endfor
                        </div>
                    </td>
                    <td><p>{{$i}}</p></td>
                    <td>{{"£" . number_format((float)$i * 12.9, 2, '.', '')}}</td>
                    <td>2024-01-05</td>
                </tr>

                <tr class="prev-order" onclick="location.href='{{ route('order.previous') }}'">
                    <td>
                        <div class="prev-order-info">
                            @for ($i = 0; $i < 1; $i++)
                                <div class="prev-single">
                                    <img class="book-img" src="/images/Eugene-Onegin.jpg">
                                </div>
                            @endfor
                        </div>
                    </td>
                    <td><p>{{$i}}</p></td>
                    <td>{{"£" . number_format((float)$i * 12.9, 2, '.', '')}}</td>
                    <td>2023-11-17</td>
                </tr>
            </table>
            {{-- <h3 class="m-9 text-center">No previous orders</h3> --}}
        </div>
    </div>
@endsection