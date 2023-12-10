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
    <div class="main">

        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        @php
            $total = 0;
        @endphp

        <h1 class="title">Shopping Cart</h1>

        <div class="small-container cart-page">
            <table>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
                @if (count($books) > 0)
                    @for ($i = 0; $i < count($books); $i++)
                        <tr>
                            <td>
                                <a href="{{ route('books.show', $books[$i][0]['id']) }}">
                                    <div class="cart-info">
                                        <img class="opened-preview book-img-mini"
                                            src="{{ asset('storage/' . $books[$i][0]['mainImage']) }}"
                                            alt="{{ $books[$i][0]['book_name'] }}">
                                        <div>
                                            <p>{{ $books[$i][0]['book_name'] }}</p>
                                            <small>£{{ $books[$i][0]['price'] }}</small>
                                            <br>
                                            <form action="{{ route('basket.destroy', $books[$i][0]['id']) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button>Remove</button>
                                            </form>
                                        </div>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <p>{{ $amounts[$i] }}</p>
                                {{-- <input type="number" value="{{ $amounts[$i] }}"> --}}
                            </td>
                            <td>
                                <p>£{{ $books[$i][0]['price'] * $amounts[$i] }}</p>
                            </td>
                        </tr>
                        @php
                            $total += $books[$i][0]['price'] * $amounts[$i];
                        @endphp
                    @endfor
                @else
                    <td>
                        <h4>Basket is empty</h4>
                    </td>
                @endif
            </table>
            <div class="totalPrice flex flex-col">
                <table>
                    <tr>
                        <td>Total</td>
                        <td>£{{ $total }}</td>
                    </tr>
                    {{-- <tr>
                        <td>Shipping</td>
                        <td>£7.99</td>
                    </tr> --}}
                </table>
            </div>
            <form action="{{ route('order.index') }}" method="GET">
                @csrf
                <div class="checkout-button">
                    <button>Go To Checkout</button>
                </div>
            </form>

        </div>
        {{-- <div class="recommendedItems">
        <h2 class="like-container">You may also like...</h2>
        <div class="recommendedItems-container">
            <div class="recommendedItem">
                <img src="/images/Anna-Karenina.jpg" alt="Item 1">
                <p>Anna Karenina</p>
                <small>Price: £12.90</small>
                <button>Add to Cart</button>
            </div>
            <div class="recommendedItem">
                <img src="/images/Anna-Karenina.jpg" alt="Item 2">
                <p>Anna Karenina</p>
                <small>Price: £12.90</small>
                <button>Add to Cart</button>
            </div>
            <div class="recommendedItem">
                <img src="/images/Anna-Karenina.jpg" alt="Item 3">
                <p>Anna Karenina</p>
                <small>Price: £12.90</small>
                <button>Add to Cart</button>
            </div>
            <div class="recommendedItem">
                <img src="/images/Anna-Karenina.jpg" alt="Item 4">
                <p>Anna Karenina</p>
                <small>Price: £12.90</small>
                <button>Add to Cart</button>
            </div>

        </div>
    </div> --}}

        <script src="app.js"></script>
        <script src="cart.js"></script>
    @endsection
