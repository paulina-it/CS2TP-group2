@extends('layouts.app')
@section('localVite')
    @vite(['resources/assets/js/sortTable.js', 'resources/assets/js/modal.js'])
@endsection
@section('main')
        <h2 class="text-center my-5">User Management</h2>
        <div class="sort-and-search flex">
            <form action="{{ route('admin-users') }}" method="GET" class="flex">
                <label for="sort">Sort by:</label>
                <select name="sort" id="sort" onchange="this.form.submit()">
                    <option value="first_name" {{ $sort === 'first_name' ? 'selected' : '' }}>First Name</option>
                    <option value="last_name" {{ $sort === 'last_name' ? 'selected' : '' }}>Last Name</option>
                    <option value="email" {{ $sort === 'email' ? 'selected' : '' }}>Email</option>
                    <option value="created_at" {{ $sort === 'created_at' ? 'selected' : '' }}>Created At</option>
                    <option value="role" {{ $sort === 'role' ? 'selected' : '' }}>Role</option>
                </select>
                <label for="order">Order:</label>
                <select name="order" id="order" onchange="this.form.submit()">
                    <option value="asc" {{ $order === 'asc' ? 'selected' : '' }}>Ascending</option>
                    <option value="desc" {{ $order === 'desc' ? 'selected' : '' }}>Descending</option>
                </select>
                {{-- <button type="submit">Sort</button> --}}
            </form>
            <div class="filter-orders-div">
                <form action="{{ route('admin-users') }}" method="GET" class="filter-orders">
                    <label for="filter">Filter</label>
                    <select name="filter">
                        <option value="none">None</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                    <input type="text" name="idSearch" placeholder="Search">
                    <button type="submit" value="submit" class="filter-btn">Submit</button>
                </form>
                <form action="{{ route('admin-users') }}" method="GET">
                    @csrf
                    @if (request('idSearch') || request('filter'))
                        <button type="submit" class="clear-btn py-2 px-4 rounded btn">Clear Search</button>
                    @endif
                </form>
            </div>
        </div>
    <div class="main admin-table">
        <table class="sortable" id="books-table">
            <thead>
                <tr>
                    <th>
                        <div class="with-svg">
                            First Name
                        </div>
                    </th>
                    <th>
                        <div class="with-svg">
                            Last Name
                        </div>
                    </th>
                    <th>
                        <div class="with-svg">
                            Email
                        </div>
                    </th>
                    <th>
                        <div class="with-svg">
                            Created At
                        </div>
                    </th>
                    <th>Role</th>
                    <th>Buttons</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    {{-- table option --}}
                    <tr>
                        <td>{{ $user['firstName'] }}</td>
                        <td>{{ $user['lastName'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ explode(' ', $user['created_at'])[0] }}</td>
                        <td>{{ $user['role'] }}</td>
                        <td id="book-table-btns">
                            <div class="book-card-btns">
                                <button class="btn" id="editBtn"
                                    onclick="window.location='{{ route('admin-users-edit', $user['id']) }}'">Edit</button>
                                <button class="btn openModalBtn" id="deleteBtn" style="display: block"
                                    data-modal-target="modal{{ $user['id'] }}"
                                    data-modal-toggle="modal{{ $user['id'] }}">
                                    Delete
                                </button>
                                <div id="modal{{ $user['id'] }}" tabindex="-1"
                                    class="modalWindow hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button"
                                                class="closeModal absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="modal{{ $user['id'] }}">
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
                                                    Are you sure you want to delete this user account?</h4>
                                                <form action="{{ route('admin-user-delete', $user['id']) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button value="Delete" data-modal-hide="modal{{ $user['id'] }}"
                                                        type="submit"
                                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                                        Yes, I'm sure
                                                    </button>
                                                </form>
                                                <button data-modal-hide="modal{{ $user['id'] }}" type="button"
                                                    class="closeModal text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                                                    cancel</button>
                                            </div>
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
            {{ $users->appends(['sort' => $sort, 'order' => $order])->links() }}
        </div>

        {{-- @endforeach
    </div> --}}
    @endsection
