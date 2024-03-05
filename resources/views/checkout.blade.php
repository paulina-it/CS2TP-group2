@extends('layouts.app')
@section('main')
<h2 class="text-center">Checkout</h2>
    <div class="main" id="checkout-div">
        @php
            $total = 0;
        @endphp
        <div class="book-basket-preview flex flex-col">
            <h4>Summary</h4>
            <div class="basket-books-list">
                @for ($i = 0; $i < count($books); $i++)
                    <div class="cart-info flex checkout-book">
                        <img class="opened-preview book-img-mini w-16"
                            src="{{ asset('storage/' . $books[$i][0]['mainImage']) }}" alt="{{ $books[$i][0]['book_name'] }}">
                        <div>
                            <p> {{ $books[$i][0]['book_name'] }}</p>
                            <small>{{ $books[$i][0]['author'] }}</small>
                            <br>
                            <small class="text-lime-600">{{ $books[$i][0]['language'] }}</small>
                        </div>
                        <br>
                        <em>Amount: </em>
                        <p>{{ $amounts[$i] }}</p>
                        <em>Total price:</em>
                        <p>£{{ number_format($books[$i][0]['price'] * $amounts[$i],2) }}</p>
                    </div>
                    @php
                        $total += $books[$i][0]['price'] * $amounts[$i];
                        if ($coupon) {
                            $discount = ($coupon['discount'] / 100) * $total;
                            $total = $total - $discount;
                        }
                    @endphp
                @endfor
            </div>
            <h4 class="text-end font-bold mt-2">Total: £{{ number_format($total, 2) }}</h4>
            @if (!$coupon)
                <form action="{{ route('coupons.store') }}" method="POST" class="coupon-form">
                    <h4>Use a Coupon:</h4>
                    @csrf
                    <input type="text" name="name">
                    <button type="submit" value="Submit" class="px-5 py-2 rounded">Submit</button>
                </form>
            @else
                <h4 class="text-end font-bold">{{ $coupon['name'] }} : -£{{ $discount }}</h4>

                <form class="text-end" action="{{ route('coupons.delete') }}" method="POST">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Remove">
                </form>
            @endif
            <div class="delivery mb-5">
                <h4>Delivery:</h4>
                <p>You will be able to pick up your order at our local store.</p>
                <div class="w-full m-auto mt-5">
                    <div class="image-section">
                        <p><iframe class="m-auto"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9718.706562870428!2d-1.912077069282534!3d52.48499024451066!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4870bde61d75f16b%3A0xf002564bfd828e35!2sWHSmith!5e0!3m2!1sen!2suk!4v1707905131077!5m2!1sen!2suk"
                                width="600" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe></p>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{ route('order.create') }}" method="POST" class="checkout flex flex-col">
            @csrf
            @if (!Auth::check())
                <h4>Personal details:</h4>
                <label for="fName">First Name</label>
                <input name="fName" type="text" required>
                <label for="lName">Last Name</label>
                <input name="lName" type="text" required>
                <label for="phone">Phone Number</label>
                <input name="phone" type="text"
                    pattern="^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$"
                    oninvalid="setCustomValidity('Please enter a valid phone number.')" oninput="setCustomValidity('')"
                    required>
                <label for="email">Email</label>
                <input name="email" type="email" pattern="/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/"
                    oninvalid="setCustomValidity('Please enter a valid email address.')" oninput="setCustomValidity('')">
            @endif
            <label for="credit_card_no">Credit Card Number</label>
            <input name="credit_card_no" type="number" pattern="[0-9\s]{13,19}" maxlength="19" required>
            <button type="submit" class="blade-btn p-4 text-white" value="">Complete Order</button>
        </form>
    </div>Í
@endsection
