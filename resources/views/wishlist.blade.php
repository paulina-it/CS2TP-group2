@extends('layouts.app')
@section('main')
    <div class="wishlist-wrapper wrapper-with-navbar">
        @include('layouts.customer-profile-sidebar')
        <div class="wishlist-main min-h-[70vh]">

            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif

            <h1 class="title">Wishlist</h1>

            <div class="small-container wishlist">
                <table>
                    <tr>
                        <th>Product</th>
                        <th>Stock</th>
                        <th></th>
                    </tr>
                    @if (count($books) > 0)
                        @for ($i = 0; $i < count($books); $i++)
                            <tr>
                                <td>
                                    <div class="wish">
                                        <img class="opened-preview book-img-mini"
                                            src="{{ asset('storage/' . $books[$i][0]['mainImage']) }}"
                                            alt="{{ $books[$i][0]['book_name'] }}">
                                        <div>
                                            <p class="name">{{ $books[$i][0]['book_name'] }}</p>
                                            <small>Price: £{{ number_format($books[$i][0]['price'], 2) }}</small>
                                            <br>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if ($books[$i][0]['quantity'] > 0)
                                        <div class="book-stock">
                                            <p class="book-stock-text">In stock</p>
                                        </div>
                                    @else
                                        <div class="book-stock">
                                            <p class="book-stock-text" class="text-xs">Not in stock</p>
                                        </div>
                                    @endif
                                </td>
                                <td class="flex ">

                                    <form action="{{ route('wishlist.basket', $books[$i][0]['id']) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="book-button-icon 
                                        @if ($books[$i][0]['quantity'] <= 0) @php
                                                echo 'disabled-icon';
                                                $disabled = true;
                                            @endphp 
                                            @else @php
                                                $disabled = false;
                                            @endphp @endif"
                                            {{ $disabled ?? false ? ' disabled' : '' }}>
                                            <img src="https://www.svgrepo.com/show/506558/shopping-cart.svg"
                                                alt="Add to Wishlist">
                                        </button>
                                    </form>
                                    <button onclick="eventPreventDefault()" type="button" class="book-button-icon "
                                        data-modal-toggle="modal{{ $books[$i][0]['id'] }}"
                                        data-modal-target="modal{{ $books[$i][0]['id'] }}">
                                        <img src="https://www.svgrepo.com/show/522319/trash.svg" alt="delete-icon">
                                    </button>
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
                                                        Are you sure you want to remove
                                                        "{{ $books[$i][0]['book_name'] }}" from your wishlist?</h4>

                                                    <form action="{{ route('wishlist.destroy', $books[$i][0]['id']) }}"
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
                                </td>
                            </tr>
                        @endfor
                    @else
                        <td>
                            <h4>Wishlist is empty</h4>
                        </td>
                    @endif
                </table>
            </div>
        </div>

    </div>
@endsection
