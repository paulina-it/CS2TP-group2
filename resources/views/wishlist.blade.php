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
    <div class="wishlist-main">
        <h1 class="title">Wishlist</h1>
        <div class="wishlist">
        <table>
                <tr>
                    <th>Product</th>
                    <th>Stock</th>
                    <th></th>
                </tr>
                <tr>
                    <td>
                        <div class="wish">
                            <img class="book-img" src="/images/Anna-Karenina.jpg">
                            <div>
                                <p class="name">Anna Karenina</p>
                                <small>Price: £12.90</small>
                                <br>
                            </div>
                        </div>
                    </td>
                    <td><p>In-stock</p></td>
                    <td><button class="cart-button">Add to Cart</button></td>
                </tr>

                <tr>
                    <td>
                        <div class="wish">
                            <img class="book-img" src="/images/Eugene-Onegin.jpg">
                            <div>
                                <p class="name">Eugene Onegin</p>
                                <small>Price: £12.90</small>
                                <br>
                            </div>
                        </div>
                    </td>
                    <td><p>In-stock</p></td>
                    <td><button class="cart-button">Add to Cart</button></td>
                </tr>
            </table>
        </div>
        {{-- <h3 class="m-9 text-center">No wishes</h3> --}}
    </div>
@endsection