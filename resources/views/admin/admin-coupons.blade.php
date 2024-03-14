@extends('layouts.app')

@section('main')
    <div class="min-h-[70vh]">
        <div class="admin-table h-100%">
            <div id="addCouponModal" tabindex="-1"
                class="modalWindow hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="modal-main relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button"
                            class="closeModal absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="addCouponModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-4 md:p-5 text-center">
                            <div class="add-coupon">
                                <h2 class="text-center">Add a Coupon</h2>
                                <form action="{{ route('admin-coupons-create') }}" method="POST" class="flex flex-col">
                                    @csrf
                                    <label for="name">Coupon Name</label>
                                    <input type="text" name="name">
                                    <label for="discount">Discount (in %)</label>
                                    <input type="number" name="discount">
                                    <label for="Date">Expiry Date</label>
                                    <input type="date" name="date">
                                    <button type="submit" value="Submit" class="py-2 px-4 rounded">Submit</button>
                                </form>
                            </div>

                            <button data-modal-hide="addCouponModal" type="button"
                                class="closeModal text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Close</button>
                            {{-- <button class="py-2 px-4 rounded btn bg-green-50">Submit</button> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="coupons-header flex justify-around w-full m-5 h-full">
                <h2>Coupons List</h2>
                <button class="btn openModalBtn py-2 px-4 rounded" id="deleteBtn" style="display: block"
                    data-modal-target="addCouponModal" data-modal-toggle="addCouponModal">
                    Create a Coupon
                </button>

            </div>
            <table class="sortable h-full" id="books-table">
                <thead>
                    <tr>
                        <th>
                            Coupon Name
                        </th>
                        <th>
                            Last Name
                        </th>
                        <th>
                            Expiry Date
                        </th>
                        <th>
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coupons as $coupon)
                        <tr>
                            <td>{{ $coupon['coupon_name'] }}</td>
                            <td>{{ $coupon['discount'] }}</td>
                            <td>{{ $coupon['expiry_date'] }}</td>
                            <?php
                            $date = new DateTime($coupon['expiry_date']);
                            $today = new DateTime(date('Y-m-d'));
                            if ($date < $today) {
                                $expired = 'Expired';
                            } else {
                                $expired = '';
                            }
                            ?>
                            <td>{{ $expired }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="pagination-links">
            {{ $coupons->links() }}
        </div>       
    </div>
@endsection
