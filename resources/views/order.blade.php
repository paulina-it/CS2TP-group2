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
    <div class="main" id="checkout-div">
        @php
            $total = 0;
        @endphp
        <div class="book-basket-preview flex">
            @for ($i = 0; $i < count($books); $i++)
                <div class="cart-info flex checkout-book">
                    <img class="opened-preview book-img-mini" src="{{ asset('storage/' . $books[$i][0]['mainImage']) }}"
                        alt="{{ $books[$i][0]['book_name'] }}">
                    <div>
                        <p> {{ $books[$i][0]['book_name'] }}</p>
                        {{-- <small>£{{ $books[$i][0]['price'] }}</small> --}}
                    </div>
                    <br>
                    <em>Amount: </em><p>{{ $amounts[$i] }}</p> 
                    <em>Total price:</em> <p>£{{ $books[$i][0]['price'] * $amounts[$i] }}</p>
                </div>
                @php
                    $total += $books[$i][0]['price'] * $amounts[$i];
                    if ($coupon) {
                        $discount = $coupon['discount'] / 100 * $total;
                        $total = $total - $discount;
                    }
                @endphp
            @endfor
        </div>
        @if (!$coupon)
        <form action="{{ route('coupons.store') }}" method="POST">
            @csrf
            <input type="text" name="name">
            <input type="submit" value="Submit">
        </form>
        @else
        <h4 class="text-end font-bold">{{$coupon['name']}} : -£{{$discount}}</h4>
        
        <form class="text-end" action="{{ route('coupons.delete') }}" method="POST">
            @csrf
            @method('delete')
            <input type="submit" value="Remove">
        </form>
        @endif
        <h4 class="text-end font-bold">Total: £{{ $total }}</h4>
        <div class="delivery mb-5">
            <h3>Delivery:</h3>
            <p>You will be able to pick up your order at our local store.</p>
        </div>
        <form action="{{ route('order.create') }}" method="POST" class="checkout">
            @csrf
            @if (!Auth::check()) 
                <label for="fName">First Name</label>
                <input name="fName" type="text" required>
                <label for="lName">Last Name</label>
                <input name="lName" type="text" required>
                <label for="phone">Phone Number</label>
                <input name="phone" type="text" required>
                <label for="email">Email</label>
                <input name="email" type="text" required>
            @endif
            <label for="credit_card_no">Credit Card Number</label>
            <input name="credit_card_no" type="number" required>
            <button type="submit" class="blade-btn p-4 text-white" value="">Complete Order</button>
        </form>
    </div>Í
@endsection
