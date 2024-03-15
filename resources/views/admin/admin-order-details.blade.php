@extends('layouts.app')

@section('main')
    <div class="admin-order-div">
        <div class="admin-table">
            <h1>Order #{{ $order['id'] }}</h1>
            <div class="order-details w-full flex justify-around">
                <p>Ordered By: {{ $user['firstName'] . ' ' . $user['lastName'] }}</p>
                <p>Contact Details: {{ $user['email'] }}</p>
                <p>Order Status: {{ $order['status'] }}</p>
            </div>
            <table class="sortable" id="books-table">
                <thead>
                    <tr>
                        <th>Book Image</th>
                        <th>Book Name</th>
                        <th>Book Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>
                                <div class="prev-single-mini w-24">
                                    <img class="book-img" src="{{ asset('storage/' . $book['book']['mainImage']) }}"
                                        alt="{{ $book['book']['book_name'] }}" class="w-2/3">
                                </div>
                            </td>
                            <?php
                            // $total += $book[0]['price'];
                            ?>
                            <td>
                                <p>{{ $book['book']['book_name'] }}</p>
                            </td>
                            <td>
                                <p>£{{ number_format($book['book']['price'], 2) }}</p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
 