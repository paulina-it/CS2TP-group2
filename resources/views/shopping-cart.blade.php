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
    <h1 class="title">Shopping Cart</h1>

    <div class="small-container cart-page">
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            <tr>
                <td>
                    <div class="cart-info">
                        <img src="/images/Anna-Karenina.jpg">
                        <div>
                            <p>Anna Karenina</p>
                            <small>Price: £12.90</small>
                            <br>
                            <a href="">Remove</a>
                        </div>
                    </div>
                </td>
                <td><input type="number" value="1"></td>
                <td>£12.90</td>
            </tr>

            <tr>
                <td>
                    <div class="cart-info">
                        <img src="/images/Eugene-Onegin.jpg">
                        <div>
                            <p>Eugene Onegin</p>
                            <small>Price: £12.90</small>
                            <br>
                            <a href="">Remove</a>
                        </div>
                    </div>
                </td>
                <td><input type="number" value="1"></td>
                <td>£12.90</td>
            </tr>

        </table>
        <div class="totalPrice">
            <table>
                <tr>
                    <td>Total</td>
                    <td>£25.80</td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>£7.99</td>
                </tr>
            </table>
        </div>

        <div class="checkout-button">
            <button onclick="">Go To Checkout</button> <!-- add function for going to checkout page in js -->
        </div>

    </div>

    <div class="recommendedItems">
        <h2 class="like-container">You may also like...</h2>
        <div class="recommendedItems-container">
            @for ($i = 0; $i < 3; $i++)
                @foreach ($otherBooksInLanguage as $otherBook)
                    <a href="{{ route('books.show', $otherBook['id']) }}">
                        <div class="book-card">
                            <div class="book-card-cover">
                                <img class="book-cover" src="{{ asset('storage/' . $otherBook['mainImage']) }}"
                                    alt="">
                            </div>
                            <div class="book-card-info">
                                <p class="book-author">{{ $otherBook['author'] }}</p>
                                <p class="book-title">{{ $otherBook['book_name'] }}</p>
                                <p class="book-price">£{{ number_format((float) $book['price'], 2, '.', '') }}
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endfor
            {{-- <div class="recommendedItem">
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
            </div> --}}

        </div>
    </div>

    <script src="app.js"></script>
    <script src="cart.js"></script>

@endsection
