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
    <div class="prev-orders-show">
        <h1 class="title">Previous Order</h1>

        <div class="back-btn w-[70%] m-auto">
            <button class="px-5 py-2 rounded my-[1em] flex " id="back-btn" onclick="history.back()">Go Back</button>
        </div>
        <div class="prev-wrapper flex flex-col-reverse">

            @if (count($returns) > 0)
                <div class="prev-orders-single-list">
                    <h2>Returned Items</h2>
                    <table>
                        @for ($k = 0; $k < count($returns); $k++)
                            <tr>
                                <td>
                                    <div class="prev-single-mini">
                                        <a href="{{ route('books.show', $returns[$k][0]['id']) }}">
                                        <img class="book-img" src="{{ asset('storage/' . $returns[$k][0]['mainImage']) }}"
                                            alt="{{ $returns[$k][0]['book_name'] }}">
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <p class="font-semibold text-[18px]">{{ $returns[$k][0]['book_name'] }}</p>
                                    <p>{{ $returns[$k][0]['author'] }}</p>
                                </td>
                                <td>
                                    <p>£{{ number_format($returns[$k][0]['price'], 2) }}</p>
                                </td>
                                <td>

                                </td>
                            </tr>
                        @endfor
                    </table>
                </div>
            @endif
            @if (count($items) > 0)
                <div class="prev-orders-single-list">
                    <?php
                    $total = 0;
                    $bookCount = 0;
                    ?>
                    <table>
                        {{-- <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr> --}}
                        @for ($i = 0; $i < count($items); $i++)
                            @for ($j = 0; $j < $items[$i]['quantity']; $j++)
                                <tr>
                                    <td>
                                        <a href="{{ route('books.show', $books[$bookCount][0]['id']) }}">
                                        <div class="prev-single-mini">
                                            <img class="book-img"
                                                src="{{ asset('storage/' . $books[$bookCount][0]['mainImage']) }}"
                                                alt="{{ $books[$bookCount][0]['book_name'] }}">
                                        </div>
                                        </a>
                                    </td>
                                    <?php
                                    $total += $books[$bookCount][0]['price'];
                                    ?>
                                    <td>
                                        <p class="font-semibold text-[18px]">{{ $books[$bookCount][0]['book_name'] }}</p>
                                        <p>{{ $books[$bookCount][0]['author'] }}</p>
                                    </td>
                                    <td>
                                        <p>£{{ number_format($books[$bookCount][0]['price'], 2) }}</p>
                                    </td>
                                    <td>
                                        @if ($order[0]['status'] == 'completed' || $order[0]['status'] == 'partially refunded')
                                            <button onclick="eventPreventDefault()" type="button"
                                                class="prev-return-btn py-2 px-4 rounded btn mb-3"
                                                data-modal-toggle="modalReturn{{ $items[$i]['id'] }}"
                                                data-modal-target="modalReturn{{ $items[$i]['id'] }}">Return
                                            </button>
                                            <div id="modalReturn{{ $items[$i]['id'] }}" tabindex="-1"
                                                class="modalWindow hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative p-4 w-full max-w-md max-h-full">
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <button type="button"
                                                            class="closeModal absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                            data-modal-hide="modalReturn{{ $items[$i]['id'] }}">
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
                                                                Are you sure you want to return
                                                                "{{ $books[$bookCount][0]['book_name'] }}"?</h4>

                                                            <form action="{{ route('order.return', $items[$i]['id']) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <button class="prev-return-btn py-2 px-4 rounded btn mb-3"
                                                                    type="submit" value="Return">Return</button>
                                                            </form>

                                                            <button data-modal-hide="modalReturn{{ $items[$i]['id'] }}"
                                                                type="button"
                                                                class="closeModal text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                                                                cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button onclick="eventPreventDefault()" type="button"
                                                class="review-btn py-2 px-4 rounded btn"
                                                data-modal-toggle="modal{{ $items[$i]['id'] }}"
                                                data-modal-target="modal{{ $items[$i]['id'] }}">
                                                Review
                                            </button>
                                            <div id="modal{{ $items[$i]['id'] }}" tabindex="-1"
                                                class="modalWindow hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative p-4 w-full max-w-md max-h-full">
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <button type="button"
                                                            class="closeModal absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                            data-modal-hide="modal{{ $items[$i]['id'] }}">
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
                                                            <h3>Leave a Review of</h3>
                                                            <h4 class="mb-[-2em]">{{ $books[$bookCount][0]['book_name'] }}
                                                            </h4>
                                                            <form
                                                                action="{{ route('product-rating.create', $items[$i]['book_id']) }}"
                                                                class="review-form" method="POST">
                                                                @csrf
                                                                <label for="score">Rating</label>
                                                                <select name="score" required>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                </select>
                                                                <label for="review">Write a review</label>
                                                                <textarea name="review" class="mb-3" required></textarea>
                                                                <button type="submit" value="Submit"
                                                                    class="review-btn py-2 px-4 rounded btn mb-3">Submit</button>
                                                                <button data-modal-hide="modal{{ $items[$i]['id'] }}"
                                                                    type="button"
                                                                    class="closeModal text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <?php
                                    $bookCount++;
                                    ?>
                                </tr>
                            @endfor
                        @endfor
                    </table>
                </div>
                <div class="prev-order-summary flex md:flex-row flex-col w-full justify-between py-[2em] px-[20%] font-semibold">
                    <?php
                    $date = DATE($items[0]['created_at']);
                    $dt = new DateTime($date);
                    $discount = null;
                    if ($coupon) {
                        $discount = ($total * $coupon['discount']) / 100;
                        $total -= $discount;
                    }
                    ?>
                    @if ($discount)
                        <p>Discount: £{{ number_format($discount, 2) }}</p>
                    @endif
                    <p>Total: £{{ number_format($total, 2) }}</p>
                    <p>Status: {{ $order[0]['status'] }}</p>
                    <p>Ordered At: {{ $dt->format('Y-m-d') }}</p>
                </div>
            @else
                <div class="prev-order-summary flex md:flex-row flex-col w-full justify-between py-[2em] px-[20%] font-semibold">
                    <?php
                    $date = DATE($order[0]['created_at']);
                    $dateUpd = DATE($order[0]['updated_at']);
                    $dt = new DateTime($date);
                    $dtUpd = new DateTime($dateUpd);
                    ?>
                    <p>Status: {{ $order[0]['status'] }}</p>
                    <p>Ordered At: {{ $dt->format('Y-m-d') }}</p>
                    <p>Returned At: {{ $dtUpd->format('Y-m-d') }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection
