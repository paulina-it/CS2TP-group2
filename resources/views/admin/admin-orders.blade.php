@extends('layouts.app')
@section('localVite')
    @vite(['resources/assets/js/modal.js'])
@endsection

@section('main')
    <h2 class="text-center">Orders Management</h2>
    <div class="sort-and-search flex justify-between">
        <form action="{{ route('admin-orders') }}" method="GET" class="flex">
            <label for="sort">Sort by:</label>
            <select name="sort" id="sort" onchange="this.form.submit()">
                <option value="id" {{ request('sort') === 'id' ? 'selected' : '' }}>ID</option>
                <option value="created_at" {{ request('sort') === 'created_at' ? 'selected' : '' }}>Created At</option>
                <option value="status" {{ request('sort') === 'status' ? 'selected' : '' }}>Status</option>
                <option value="email" {{ request('sort') === 'email' ? 'selected' : '' }}>Email</option>
                <option value="phone" {{ request('sort') === 'phone' ? 'selected' : '' }}>Phone</option>
                <!-- Add other options for sorting -->
            </select>
            <label for="order">Order:</label>
            <select name="order" id="order" onchange="this.form.submit()">
                <option value="asc" {{ request('order') === 'asc' ? 'selected' : '' }}>Ascending</option>
                <option value="desc" {{ request('order') === 'desc' ? 'selected' : '' }}>Descending</option>
            </select>
            {{-- <button type="submit">Sort</button> --}}
        </form>

        <div class="filter-orders-div">
            <form action="{{ route('admin-orders') }}" method="GET" class="filter-orders">
                <label for="filter">Filter</label>
                <select name="filter">
                    <option value="none">None</option>
                    <option value="pending">Pending</option>
                    <option value="processed">Processed</option>
                    <option value="completed">Completed</option>
                    <option value="shipping">Shipping</option>
                    <option value="canceled">Canceled</option>
                    <option value="refunded">Refunded</option>
                </select>
                <input type="text" name="idSearch" placeholder="Search">
                <button type="submit" value="submit" class="filter-btn">Submit</button>
            </form>
            <form action="{{ route('admin-orders') }}" method="GET">
                @csrf
                @if (request('idSearch') || request('filter'))
                    <button type="submit" class="clear-btn py-2 px-4 rounded btn">Clear Search</button>
                @endif
            </form>
        </div>
    </div>
    <div class="admin-table">

        <table class="sortable" id="books-table">
            <thead>
                <tr>
                    <th>
                        <div class="with-svg">
                            ID
                        </div>
                    </th>
                    <th>
                        <div class="with-svg">
                            Customer Name
                        </div>
                    </th>
                    <th>
                        <div class="with-svg">
                            Email
                        </div>
                    </th>
                    <th>
                        <div class="with-svg">
                            Phone
                        </div>
                    </th>
                    <th>
                        <div class="with-svg">
                            Created At
                        </div>
                    </th>
                    <th>
                        <div class="with-svg">
                            Status
                        </div>
                    </th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < count($orders); $i++)
                    <tr>
                        <td>
                            <label>{{ $orders[$i]->id }}</label>
                        </td>
                        <td>
                            <label>{{ $users[$i]->firstName . ' ' . $users[$i]->lastName }}</label>
                        </td>
                        <td>
                            <label>{{ $users[$i]->email }}</label>
                        </td>
                        <td>
                            <label>{{ $users[$i]->phone }}</label>
                        </td>
                        <td>
                            <label>{{ $orders[$i]['created_at'] }}</label>
                        </td>
                        <td>
                            <form action="{{ route('admin-process', $orders[$i]['id']) }}" method="POST">
                                @csrf
                                <select name="status" onchange="this.form.submit()">
                                    @if ($orders[$i]['status'] == 'pending')
                                        <option value="pending" @if ($orders[$i]['status'] == 'pending') selected @endif>
                                            Pending
                                        </option>
                                        <option value="processed" @if ($orders[$i]['status'] == 'processed') selected @endif>
                                            Processed
                                        </option>
                                        <option value="cancelled" @if ($orders[$i]['status'] == 'cancelled') selected @endif>
                                            Cancelled
                                        </option>
                                    @elseif ($orders[$i]['status'] == 'processed' || $orders[$i]['status'] == 'shipped')
                                        <option value="processed" @if ($orders[$i]['status'] == 'processed') selected @endif>
                                            Processed
                                        </option>
                                        <option value="shipped" @if ($orders[$i]['status'] == 'shipped') selected @endif>
                                            Shipped
                                        </option>
                                        <option value="completed" @if ($orders[$i]['status'] == 'completed') selected @endif>
                                            Completed
                                        </option>
                                        <option value="cancelled" @if ($orders[$i]['status'] == 'cancelled') selected @endif>
                                            Cancelled
                                        </option>
                                        <option value="refunded" @if ($orders[$i]['status'] == 'refunded') selected @endif>
                                            Refunded
                                        </option>
                                        <option value="partially refunded"
                                            @if ($orders[$i]['status'] == 'partially refunded') selected @endif>
                                            Partially Refunded
                                        </option>
                                    @elseif ($orders[$i]['status'] == 'completed')
                                        <option value="completed" @if ($orders[$i]['status'] == 'completed') selected @endif>
                                            Completed
                                        </option>
                                        <option value="refunded" @if ($orders[$i]['status'] == 'refunded') selected @endif>
                                            Refunded
                                        </option>
                                        <option value="partially refunded"
                                            @if ($orders[$i]['status'] == 'partially refunded') selected @endif>
                                            Partially Refunded
                                        </option>
                                    @elseif (
                                        $orders[$i]['status'] == 'cancelled' ||
                                            $orders[$i]['status'] == 'refunded' ||
                                            $orders[$i]['status'] == 'partially refunded')
                                        <option value="cancelled" @if ($orders[$i]['status'] == 'cancelled') selected @endif>
                                            Cancelled
                                        </option>
                                        <option value="refunded" @if ($orders[$i]['status'] == 'refunded') selected @endif>
                                            Refunded
                                        </option>
                                        <option value="partially refunded"
                                            @if ($orders[$i]['status'] == 'partially refunded') selected @endif>
                                            Partially Refunded
                                        </option>
                                    @endif
                                </select>
                            </form>
                        </td>
                        <td>
                            <a class="font-bold" href="{{ route('admin-order-details', $orders[$i]['id']) }}">Open Details</a>
                        </td>
                    </tr>
                @endfor

            </tbody>
        </table>
        <br>
        <div class="pagination-links">
            {{ $orders->appends(['idSearch' => request('idSearch'), 'filter' => request('filter'), 'sort' => request('sort'), 'order' => request('order')])->links() }}
        </div>
    </div>
@endsection
