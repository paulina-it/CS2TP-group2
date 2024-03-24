@extends('layouts.app')
@section('localVite')
    @vite(['resources/assets/js/sortTable.js', 'resources/assets/js/modal.js'])
@endsection

@section('main')
    <div class="main">
        <h2 class="mt-5 text-center mb-5">User Queries</h2>
        <div class="sort-and-search flex">
            <form action="{{ route('queries') }}" method="GET" class="flex">
                <label for="sort">Sort by:</label>
                <select name="sort" id="sort" onchange="this.form.submit()">
                    <option value="id" {{ $sort === 'id' ? 'selected' : '' }}>ID</option>
                    <option value="first_name" {{ $sort === 'first_name' ? 'selected' : '' }}>First Name</option>
                    <option value="last_name" {{ $sort === 'last_name' ? 'selected' : '' }}>Last Name</option>
                    <option value="email" {{ $sort === 'email' ? 'selected' : '' }}>Email</option>
                    <option value="type" {{ $sort === 'type' ? 'selected' : '' }}>Type</option>
                    <option value="status" {{ $sort === 'status' ? 'selected' : '' }}>Status</option>
                    <option value="created_at" {{ $sort === 'created_at' ? 'selected' : '' }}>Created At</option>
                </select>
                <label for="order">Order:</label>
                <select name="order" id="order" onchange="this.form.submit()">
                    <option value="asc" {{ $order === 'asc' ? 'selected' : '' }}>Ascending</option>
                    <option value="desc" {{ $order === 'desc' ? 'selected' : '' }}>Descending</option>
                </select>
            </form>
            <div class="filter-orders-div">
                {{-- <form action="{{ route('queries') }}" method="GET" class="filter-orders">
                    <label for="filter">Filter</label>
                    <select name="filter">
                            <option value="not reviewed">Not Reviewed</option>
                            <option value="open" >Open</option>
                            <option value="closed" >Closed</option>
                    </select>
                    <input type="text" name="idSearch" placeholder="Search">
                    <button type="submit" value="submit" class="filter-btn">Submit</button>
                </form> --}}
                <form action="{{ route('queries') }}" method="GET">
                    @csrf
                    @if (request('idSearch') || request('filter'))
                        <button type="submit" class="clear-btn py-2 px-4 rounded btn">Clear Search</button>
                    @endif
                </form>
            </div>
        </div>

        <div class="queries-list admin-table">
            <table class="sortable" id="queries-table">
                <thead>
                    <tr>
                        <th>
                            <div class="with-svg">
                                ID
                            </div>
                        </th>
                        <th>
                            <div class="with-svg">
                                Sent By
                            </div>
                        </th>
                        <th>
                            <div class="with-svg">
                                Email
                            </div>
                        </th>
                        <th>
                            <div class="with-svg">
                                Type
                            </div>
                        </th>
                        <th>
                            <div class="with-svg">
                                Status
                            </div>
                        </th>
                        <th>
                            <div class="with-svg">
                                Created At
                            </div>
                        </th>
                        <th>Buttons</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($queries as $query)
                        {{-- table option --}}
                        <tr
                            @if ($query['status'] == 'not reviewed') class="attention-needed" @elseif ($query['status'] == 'open') class="open-query" @endif>
                            <td>{{ $query['id'] }}</td>
                            <td>{{ $query['firstName'] . ' ' . $query['lastName'] }}</td>
                            <td>{{ $query['email'] }}</td>
                            <td>{{ $query['query_type'] }}</td>
                            <td>
                                <form action="{{ route('queries.status', $query['id']) }}" method="POST"
                                    onchange="this.submit()">
                                    @csrf
                                    <select name="status">
                                        <option value="not reviewed" <?php if ($query['status'] == 'not reviewed') {
                                            echo 'selected';
                                        } ?>>Not Reviewed</option>
                                        <option value="open" <?php if ($query['status'] == 'open') {
                                            echo 'selected';
                                        } ?>>Open</option>
                                        <option value="closed" <?php if ($query['status'] == 'closed') {
                                            echo 'selected';
                                        } ?>>Closed</option>
                                    </select>

                                    {{-- <button class="btn">Change Status</button> --}}
                                </form>
                            </td>
                            <td>{{ explode(' ', $query['created_at'])[0] }}</td>
                            <td class="">
                                <button class="btn openModalBtn font-semibold" id="deleteBtn" style="display: block"
                                    data-modal-target="modal{{ $query['id'] }}"
                                    data-modal-toggle="modal{{ $query['id'] }}">
                                    Details
                                </button>
                                {{-- Popup Modal --}}
                                <div id="modal{{ $query['id'] }}" tabindex="-1"
                                    class="modalWindow hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="modal-main relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button"
                                                class="closeModal absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="modal{{ $query['id'] }}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-4 md:p-5 text-center">
                                                <h5 class="m-5 text-start">Sent By:
                                                    <strong>{{ $query['firstName'] . ' ' . $query['lastName'] }}</strong>
                                                </h5>
                                                <h5 class="m-5 text-start">Query Type:
                                                    <strong>{{ $query['query_type'] }}</strong></h5>
                                                <h5 class="m-5 text-start">
                                                    Query Text:</h5>
                                                <p class="overflow-hidden overflow-ellipsis m-5 text-start"> {{ $query['message'] }}</p>
                                                <button data-modal-hide="modal{{ $query['id'] }}" type="button"
                                                    class="closeModal text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Close</button>
                                                <button class="py-2 px-4 rounded btn bg-green-50"><a
                                                        href="mailto:{{ $query['email'] }}">Respond</a></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-links">
                {{ $queries->appends(['sort' => $sort, 'order' => $order])->links() }}
            </div>
        </div>
    </div>
@endsection
