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
<div class = "wrapper-basket">
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

        <h1 class="title text-center pt-[50px]">Shopping Cart</h1>
        
        <div class="small-container cart-page mx-[auto] my-[20px] flex flex-col items-center">
            <table class="w-3/4 border-collapse">
                <tr>
                    <th class="text-left p-[2px] bg-[#763514] text-[#fff] font-[500px]">Product</th>
                    <th class="text-left p-[2px] bg-[#763514] text-[#fff] font-[500px]">Quantity</th>
                    <th class="text-left p-[2px] bg-[#763514] text-[#fff] font-[500px]">Total</th>
                </tr>
                @if (count($books) > 0)
                    @for ($i = 0; $i < count($books); $i++)
                        <tr>
                            <td class="px-[5px] py-[10px]">
                                <a href="{{ route('books.show', $books[$i][0]['id']) }}">
                                    <div class="cart-info flex flex-wrap">
                                        <img class="opened-preview book-img-mini mr-[10px] w-[60px] h-[80px]"
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
                            <td class="px-[5px] py-[10px]">
                                <p>{{ $amounts[$i] }}</p>
                                {{-- <input class="h-[50px] w-[60px] p-[10px]" type="number" value="{{ $amounts[$i] }}"> --}}
                            </td>
                            <td class="px-[5px] py-[10px]">
                                <p>£{{ $books[$i][0]['price'] * $amounts[$i] }}</p>
                            </td>
                        </tr>
                        @php
                            $total += $books[$i][0]['price'] * $amounts[$i];
                        @endphp
                    @endfor
                @else
                    <td class="px-[5px] py-[10px]">
                        <h4>Basket is empty</h4>
                    </td>
                @endif
            </table>
            <div class="totalPrice flex flex-col justify-center -mr-[740px]">
                <table class="border-t-[3px_solid_#64ad52] w-[220px] max-w-[350px]">
                    <tr>
                        <td class="px-[5px] py-[10px]">Total</td>
                        <td class="px-[5px] py-[10px]">£{{ $total }}</td>
                    </tr>
                    {{-- <tr>
                        <td class="px-[5px] py-[10px]">Shipping</td>
                        <td class="px-[5px] py-[10px]">£7.99</td>
                    </tr> --}}
                </table>
            </div>
            <form action="{{ route('order.index') }}" method="GET">
                @csrf
                <div class="checkout-button text-center mt-[20px] -mr-[790px]">
                    <button class="cursor-pointer px-[20px] py-[10px] rounded-[5px] bg-[#46a41a] text-[#fff] [transition:background-color_0.3s] border-[none] text-[16px]">Go To Checkout</button>
                </div>
            </form>

        </div>
        {{-- <div class="recommendedItems mt-[40px] text-center">
        <h2 class="like-container text-[25px] mb-[20px]">You may also like...</h2>
        <div class="recommendedItems-container flex justify-center gap-[25px]">
            <div class="recommendedItem w-[200px] border-[1px] border-[solid] border-[gray] rounded-[10px] p-[12px]">
                <img class="w-full rounded-[10px]" src="/images/Anna-Karenina.jpg" alt="Item 1">
                <p class="mt-[10px] font-[300px]">Anna Karenina</p>
                <small>Price: £12.90</small>
                <button>Add to Cart</button>
            </div>
            <div class="recommendedItem w-[200px] border-[1px] border-[solid] border-[gray] rounded-[10px] p-[12px]">
                <img class="w-full rounded-[10px]]" src="/images/Anna-Karenina.jpg" alt="Item 2">
                <p class="mt-[10px] font-[300px]">Anna Karenina</p>
                <small>Price: £12.90</small>
                <button>Add to Cart</button>
            </div>
            <div class="recommendedItem w-[200px] border-[1px] border-[solid] border-[gray] rounded-[10px] p-[12px]">
                <img class="w-full rounded-[10px]" src="/images/Anna-Karenina.jpg" alt="Item 3">
                <p class="mt-[10px] font-[300px]">Anna Karenina</p>
                <small>Price: £12.90</small>
                <button>Add to Cart</button>
            </div>
            <div class="recommendedItem w-[200px] border-[1px] border-[solid] border-[gray] rounded-[10px] p-[12px]">
                <img class="mr-[10px] w-[60px] h-[80px]" src="/images/Anna-Karenina.jpg" alt="Item 4">
                <p class="mt-[10px] font-[300px]">Anna Karenina</p>
                <small>Price: £12.90</small>
                <button>Add to Cart</button>
            </div>

        </div>
    </div> --}}

        <script src="app.js"></script>
        <script src="cart.js"></script>
    @endsection
