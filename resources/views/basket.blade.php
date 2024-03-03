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
    <div class="shopping-cart-main">

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
                            <td>
                                <div class="cart-info">
                                    <a href="{{ route('books.show', $books[$i][0]['id']) }}">
                                        <img class="opened-preview book-img-mini"
                                            src="{{ asset('storage/' . $books[$i][0]['mainImage']) }}"
                                            alt="{{ $books[$i][0]['book_name'] }}">
                                    </a>
                                    <div>
                                        <a href="{{ route('books.show', $books[$i][0]['id']) }}">
                                            <p>{{ $books[$i][0]['book_name'] }}</p>
                                        </a>
                                        <small>£{{ $books[$i][0]['price'] }}</small>
                                        <br>
                                        <button onclick="eventPreventDefault()" type="button"
                                            data-modal-toggle="modal{{ $books[$i][0]['id'] }}"
                                            data-modal-target="modal{{ $books[$i][0]['id'] }}">Remove</button>
                                        <div id="modal{{ $books[$i][0]['id'] }}" tabindex="-1"
                                            class="modalWindow hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <button type="button"
                                                        class="closeModal absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-hide="modal{{ $books[$i][0]['id'] }}">
                                                        <svg class="w-3 h-3" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                    <div class="p-4 md:p-5 text-center">
                                                        <h4 class="m-5">
                                                            Are you sure you want to remove "{{$books[$i][0]['book_name']}}" from your basket?</h4>
                                                        <form action="{{ route('basket.destroy', $books[$i][0]['id']) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button value="Delete"
                                                                data-modal-hide="modal{{ $books[$i][0]['id'] }}"
                                                                type="submit"
                                                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                                                Yes, I'm sure
                                                            </button>
                                                        </form>
                                                        <button data-modal-hide="modal{{ $books[$i][0]['id'] }}"
                                                            type="button"
                                                            class="closeModal text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                                                            cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="qty-input" onchange="this.submit()">
                                    <form action="{{ route('basket.update', $books[$i][0]['id']) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input class="product-qty" type="number" name="product-qty" min="0" 
                                    max="10" value="{{$amounts[$i]}}">
                                    </form>
                                </div>
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
            <div class="cartSummary">
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
