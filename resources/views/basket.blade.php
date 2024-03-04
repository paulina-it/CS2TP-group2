@extends('layouts.app')
@section('localVite')
    @vite(['resources/assets/js/scroll.js'])
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
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th> </th>
                </tr>
                @if (count($books) > 0)
                    @for ($i = 0; $i < count($books); $i++)
                        <tr>
                            <td>
                                <div class="cart-info">
                                    <a href="{{ route('books.show', $books[$i]['id']) }}">
                                        <img class="opened-preview book-img-mini"
                                            src="{{ asset('storage/' . $books[$i]['mainImage']) }}"
                                            alt="{{ $books[$i]['book_name'] }}">
                                    </a>
                                    <div>
                                        <a href="{{ route('books.show', $books[$i]['id']) }}">
                                            <p>{{ $books[$i]['book_name'] }}</p>
                                        </a>
                                        <small>£{{ $books[$i]['price'] }}</small>
                                        <br>

                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="qty-input basket-qty" onchange="this.submit()">
                                    <form action="{{ route('basket.update', $books[$i]['id']) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="product-qty" onchange="this.form.submit()">
                                            @if ($books[$i]['quantity'] >= 10)
                                                <?php
                                                $j = 10;
                                                ?>
                                            @else
                                                <?php
                                                $j = $books[$i]['quantity'];
                                                ?>
                                            @endif
                                            @for ($k = 1; $k < $j; $k++)
                                                <option value="{{ $k }}"
                                                    @if ($amounts[$i] == $k) selected @endif>
                                                    {{ $k }}
                                                </option>
                                            @endfor
                                        </select>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <p>£{{ $books[$i]['price'] * $amounts[$i] }}</p>
                            </td>
                            <td class="flex justify-end">
                                <form action="{{ route('wishlist.store', $books[$i]['id']) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="cart-icon
                                            @guest @php
                                            echo 'disabled-icon';
                                            $disabled = true;
                                            @endphp @endguest"
                                        {{ $disabled ?? false ? ' disabled' : '' }}>
                                        <img src="https://www.svgrepo.com/show/361197/heart.svg" alt="Add to Basket">
                                    </button>
                                </form>
                                <button onclick="eventPreventDefault()" type="button" class="cart-icon"
                                    data-modal-toggle="modal{{ $books[$i]['id'] }}"
                                    data-modal-target="modal{{ $books[$i]['id'] }}">
                                    <img src="https://www.svgrepo.com/show/522319/trash.svg" alt="delete-icon">
                                </button>
                                <div id="modal{{ $books[$i]['id'] }}" tabindex="-1"
                                    class="modalWindow hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button"
                                                class="closeModal absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="modal{{ $books[$i]['id'] }}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-4 md:p-5 text-center">
                                                <h4 class="m-5">
                                                    Are you sure you want to remove
                                                    "{{ $books[$i]['book_name'] }}" from your basket?</h4>
                                                <form action="{{ route('basket.destroy', $books[$i]['id']) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button value="Delete" data-modal-hide="modal{{ $books[$i]['id'] }}"
                                                        type="submit"
                                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                                        Yes, I'm sure
                                                    </button>
                                                </form>
                                                <button data-modal-hide="modal{{ $books[$i]['id'] }}" type="button"
                                                    class="closeModal text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                                                    cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @php
                            $total += $books[$i]['price'] * $amounts[$i];
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
                    <strong class="text-left w-full ml-10">Total: £{{ $total + 2.99 }}</strong>
                    <table>
                        <tr>
                            <td>Subotal ({{ $books->count() }} items)</td>
                            <td>£{{ $total }}</td>
                        </tr>
                        <tr>
                            <td>Shipping</td>
                            <td>£2.99</td>
                        </tr>
                    </table>
                </div>
                <form action="{{ route('order.index') }}" method="GET">
                    @csrf
                    <div class="checkout-button">
                        <button>Go To Checkout</button>
                    </div>
                </form>
                @auth
                    @if ($wishlist != null)
                        <div class="wishlist-books w-full">
                            <strong class="text-left w-full ml-6">Items from your wishlist:</strong>
                            @for ($i = 0; $i < count($wishlist); $i++)
                                <div class="wish-card">
                                    <img src="{{ asset('storage/' . $wishlist[$i][0]['mainImage']) }}" alt=""
                                        class="w-10">
                                    <p>{{ $wishlist[$i][0]['book_name'] }}</p>
                                    <form action="{{ route('basket.store', $wishlist[$i][0]['id']) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="book-button-icon">
                                            <img src="https://www.svgrepo.com/show/506558/shopping-cart.svg"
                                                alt="Add to Wishlist">
                                        </button>
                                    </form>
                                </div>
                            @endfor
                        </div>
                    @endif
                @endauth
            </div>

                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
        </div>
        <div id="new-books" class="recommendedItems similar section justify-around m-auto mt-20">
            <h2 class="like-container">You may also like...</h2>
            <button id="scrollLeftBtn"
                class="scroll-btn back bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 border rounded-full">
                < </button>
                    <button
                        id="scrollRightBtn"class="scroll-btn forward bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 border rounded-full">
                        > </button>
                    {{-- <div class="similar-books-list flex justify-between"> --}}
                    <div class="recommendedItems-container similar-books-list">
                        @foreach ($recommended as $bookRec)
                            <a href="{{ route('books.show', $bookRec['id']) }}">
                                <div class="book-card book-card-common">
                                    <div class="book-card-cover">
                                        @if (Storage::disk('public')->exists($bookRec['mainImage']))
                                            <img class="book-cover" src="{{ asset('storage/' . $bookRec['mainImage']) }}"
                                                alt="{{ $bookRec['book_name'] }}">
                                        @else
                                            <div class="dummy-book-cover">
                                                <p>Image not available</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="book-card-info">
                                        <p class="book-author">{{ $bookRec['author'] }}</p>
                                        <p class="book-language">{{ ucfirst(trans($bookRec['language'])) }}</p>
                                        <p class="book-title">{{ $bookRec['book_name'] }}</p>
                                        <div class="grid-card-bottom">
                                            <p class="book-price">
                                                £{{ number_format((float) $bookRec['price'], 2, '.', '') }}
                                            </p>
                                            <div class="book-card-buttons">
                                                <form action="{{ route('wishlist.store', $bookRec['id']) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="book-button-icon
                            @guest @php
                            echo 'disabled-icon';
                            $disabled = true;
                        @endphp @endguest"
                                                        {{ $disabled ?? false ? ' disabled' : '' }}>
                                                        <img src="https://www.svgrepo.com/show/361197/heart.svg"
                                                            alt="Add to Basket">
                                                        @guest
                                                            <span class="message">Please Login or Signup to Access
                                                                Wishlist</span>
                                                        @endguest
                                                    </button>
                                                </form>
                                                <form action="{{ route('basket.store', $bookRec['id']) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="book-button-icon 
                            @if ($bookRec['quantity'] <= 0) @php
                                    echo 'disabled-icon';
                                    $disabled = true;
                                @endphp 
                                @else @php
                                    $disabled = false;
                                @endphp @endif"
                                                        {{ $disabled ?? false ? ' disabled' : '' }}>
                                                        <img src="https://www.svgrepo.com/show/506558/shopping-cart.svg"
                                                            alt="Add to Wishlist">
                                                        @if ($bookRec['quantity'] <= 0)
                                                            <span class="message">This Book is Out of Stock</span>
                                                        @endif
                                                    </button>
                                                </form>
                                            </div>
        </div>

    @endsection
