@extends('layouts.app')
@section('localVite')
    @vite(['resources/assets/js/scroll.js'])
@endsection
@section('main')
    <div class="shopping-cart-main">

        @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{!! \Session::get('success') !!}</p>
            </div>
        @endif
        @php
            $total = 0;
            $outOfStock = [];
        @endphp

        <h1 class="title">Shopping Cart</h1>

        <div class="small-container cart-page">
            @php
                $outOfStock = [];
                $filteredBooks = [];

                foreach ($books as $book) {
                    if ($book['quantity'] <= 0) {
                        $outOfStock[] = $book;
                    } else {
                        $filteredBooks[] = $book;
                    }
                }
            @endphp
            <div class="basket-table">

                <table class="">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th> </th>
                        </tr>
                    </thead>
                    @if (count($filteredBooks) > 0)
                        <tbody>
                            @for ($i = 0; $i < count($filteredBooks); $i++)
                                <tr>
                                    <td class="sticky">
                                        <div class="cart-info">
                                            <a href="{{ route('books.show', $filteredBooks[$i]['id']) }}">
                                                <img class="opened-preview book-img-mini"
                                                    src="{{ asset('storage/' . $filteredBooks[$i]['mainImage']) }}"
                                                    alt="{{ $filteredBooks[$i]['book_name'] }}">
                                            </a>
                                            <div>
                                                <a href="{{ route('books.show', $filteredBooks[$i]['id']) }}">
                                                    <p>{{ $filteredBooks[$i]['book_name'] }}</p>
                                                </a>
                                                <small>£{{ number_format($filteredBooks[$i]['price'], 2) }}</small>
                                                <br>

                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="qty-input basket-qty" onchange="this.submit()">
                                            <form action="{{ route('basket.update', $filteredBooks[$i]['id']) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select name="product-qty" onchange="this.form.submit()">
                                                    @if ($filteredBooks[$i]['quantity'] >= 10)
                                                        <?php
                                                        $j = 10;
                                                        ?>
                                                    @else
                                                        <?php
                                                        $j = $filteredBooks[$i]['quantity'];
                                                        ?>
                                                    @endif
                                                    @for ($k = 1; $k <= $j; $k++)
                                                        <option value="{{ $k }}"
                                                            @if ($filteredBooks[$i]['amount'] == $k) selected @endif>
                                                            {{ $k }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <p>£{{ number_format($filteredBooks[$i]['price'] * $filteredBooks[$i]['amount'], 2) }}
                                        </p>
                                    </td>
                                    <td class="basket-item-btns flex justify-end">
                                        @auth

                                            <form action="{{ route('wishlist.store', $filteredBooks[$i]['id']) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="cart-icon">
                                                    <img src="https://www.svgrepo.com/show/361197/heart.svg"
                                                        alt="Add to Basket">
                                                </button>
                                            </form>
                                        @endauth
                                        <button onclick="eventPreventDefault()" type="button" class="cart-icon"
                                            data-modal-toggle="modal{{ $filteredBooks[$i]['id'] }}"
                                            data-modal-target="modal{{ $filteredBooks[$i]['id'] }}">
                                            <img src="https://www.svgrepo.com/show/522319/trash.svg" alt="delete-icon">
                                        </button>
                                        <div id="modal{{ $filteredBooks[$i]['id'] }}" tabindex="-1"
                                            class="modalWindow hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <button type="button"
                                                        class="closeModal absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-hide="modal{{ $filteredBooks[$i]['id'] }}">
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
                                                            Are you sure you want to remove
                                                            "{{ $filteredBooks[$i]['book_name'] }}" from your basket?</h4>
                                                        <form
                                                            action="{{ route('basket.destroy', $filteredBooks[$i]['id']) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button value="Delete"
                                                                data-modal-hide="modal{{ $filteredBooks[$i]['id'] }}"
                                                                type="submit"
                                                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                                                Yes, I'm sure
                                                            </button>
                                                        </form>
                                                        <button data-modal-hide="modal{{ $filteredBooks[$i]['id'] }}"
                                                            type="button"
                                                            class="closeModal text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                                                            cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @php
                                    $total += $filteredBooks[$i]['price'] * $filteredBooks[$i]['amount'];
                                @endphp
                            @endfor
                        </tbody>
                    @else
                        <td colspan="4">
                            <h4 class="text-center my-5">Basket is empty</h4>
                        </td>
                    @endif
                </table>
                @if (count($outOfStock) > 0)
                    <h2 class="text-center text-[18px] mb-3">We are sorry, but these books are now out of stock</h2>
                    <table class="outOfStock-table">
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th> </th>
                        </tr>
                        @foreach ($outOfStock as $book)
                            <tr>
                                <td class="sticky">
                                    <div class="cart-info legend">
                                        <a href="{{ route('books.show', $book['id']) }}">
                                            <img class="opened-preview book-img-mini opacity-85"
                                                src="{{ asset('storage/' . $book['mainImage']) }}"
                                                alt="{{ $book['book_name'] }}">
                                        </a>
                                        <div>
                                            <a href="{{ route('books.show', $book['id']) }}">
                                                <p>{{ $book['book_name'] }}</p>
                                                <small>{{ $book['author'] }}</small>
                                            </a>
                                            <br>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <small>£{{ number_format($book['price'], 2) }}</small>
                                </td>
                                <td class="basket-item-btns flex justify-end">
                                    @auth
                                        <form action="{{ route('wishlist.store', $book['id']) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="cart-icon">
                                                <img src="https://www.svgrepo.com/show/361197/heart.svg" alt="Add to Basket">
                                            </button>
                                        </form>
                                    @endauth
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            </div>
            <div class="cartSummary">
                <div class="totalPrice flex flex-col">
                    <strong class="text-left w-full ml-10">Total: £{{ number_format($total, 2) }}</strong>
                    <table>
                        @php
                            $totalAmount = 0;

                            foreach ($filteredBooks as $book) {
                                $totalAmount += $book['amount'];
                            }
                        @endphp
                        <tr>
                            <td>Subtotal ({{ $totalAmount }} items)</td>
                            <td>£{{ number_format($total, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Shipping</td>
                            <td>Free</td>
                        </tr>
                    </table>
                </div>
                <form action="{{ route('order.index') }}" method="GET">
                    @csrf
                    <div class="checkout-button">
                        <button @if (count($filteredBooks) <= 0) onclick="event.preventDefault()" @endif>Go To
                            Checkout</button>
                    </div>
                </form>
                @auth
                    @if (count($wishlist) > 0)
                        <div class="wishlist-books w-full">
                            <strong class="text-left w-full ml-6">Items from your wishlist:</strong>
                            @for ($i = 0; $i < count($wishlist); $i++)
                                <div class="wish-card">
                                    <img src="{{ asset('storage/' . $wishlist[$i][0]['mainImage']) }}" alt=""
                                        class="w-10">
                                    <p>{{ $wishlist[$i][0]['book_name'] }}</p>
                                    <form action="{{ route('wishlist.basket', $wishlist[$i][0]['id']) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="book-button-icon">
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
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
        </div>

    @endsection
