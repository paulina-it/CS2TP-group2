@extends('layouts.app')

@section('localVite')
    @vite(['resources/assets/js/modal.js'])
@endsection
@section('main')
    <div class="admin-books-wrapper">
        {{-- @include('layouts.admin-sidebar') --}}
        <div class="main-search m-auto">
            <div class="books-inventory-header">
                <h2 class="m-9 text-center">
                    List of all books
                </h2>
                <div class="inventory-buttons">
                    <button class="py-2 px-4 rounded btn add-book-btn"
                        onclick="window.location='{{ route('books.create') }}'">Add a Book</button>
                </div>
            </div>
            <div class="sort-and-search flex justify-between mb-5">
                <form action="{{ route('admin-books') }}" method="GET" class="flex justify-between">
                    <label for="sort">Sort by:</label>
                    <select name="sort" id="sort-inventory" onchange="this.form.submit()">
                        <option value="created_at" {{ $sort == 'created_at' ? 'selected' : '' }}>Created At Date</option>
                        <option value="author" {{ $sort == 'author' ? 'selected' : '' }}>Author</option>
                        <option value="book_name" {{ $sort == 'book_name' ? 'selected' : '' }}>Book Name</option>
                        <option value="language" {{ $sort == 'language' ? 'selected' : '' }}>Language</option>
                        <option value="price" {{ $sort == 'price' ? 'selected' : '' }}>Price</option>
                        <option value="quantity" {{ $sort == 'quantity' ? 'selected' : '' }}>Stock</option>
                    </select>
                    <label for="order">Order:</label>
                    <select name="order" id="order" onchange="this.form.submit()">
                        <option value="asc" {{ $order == 'asc' ? 'selected' : '' }}>Ascending</option>
                        <option value="desc" {{ $order == 'desc' ? 'selected' : '' }}>Descending</option>
                    </select>
                    {{-- <button type="submit">Sort</button> --}}
                </form>

                <div class="flex">
                    <form action="{{ route('admin-books') }}" method="GET" class="mr-2">
                        <input type="text" name="search" placeholder="Search">
                        <button type="submit" value="submit" class="filter-btn py-2 px-4 rounded btn">Submit</button>
                    </form>
                    {{-- <br> --}}
                    <form action="{{ route('admin-books') }}" method="GET" class="flex justify-end">
                        @csrf
                        <button type="submit" class="clear-btn py-2 px-4 rounded btn">Clear Search</button>
                    </form>
                </div>
            </div>
            <div class="admin-books-list admin-table">
                <table class="sortable" id="books-table">
                    <thead>
                        <tr>
                            <th>Main Image</th>
                            <th>
                                Book Name
                            </th>
                            <th>
                                Author
                            </th>
                            <th>
                                Language
                            </th>
                            <th>
                                Price
                            </th>
                            <th>
                                Stock
                            </th>
                            <th>
                                Created At
                            </th>
                            <th>Buttons</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            {{-- table option --}}
                            <tr @if ($book['quantity'] <= 0) class="attention-needed" @endif>
                                <td id="book-table-img">
                                    @if (Storage::disk('public')->exists($book['mainImage']))
                                        <img class="book-cover" src="{{ asset('storage/' . $book['mainImage']) }}"
                                            alt="{{ $book['book_name'] }}">
                                    @else
                                        <p>Main image not found</p>
                                    @endif
                                </td>
                                <td>{{ $book['book_name'] }}</td>
                                <td>{{ $book['author'] }}</td>
                                <td>{{ $book['language'] }}</td>
                                <td>{{ $book['price'] }}</td>
                                <td>{{ $book['quantity'] }}</td>
                                <td>{{ explode(' ', $book['created_at'])[0] }}</td>
                                <td id="book-table-btns">
                                    <div class="book-card-btns">
                                        <button class="btn" id="editBtn"
                                            onclick="window.location='{{ route('books.edit', $book['id']) }}'">Edit</button>
                                        <button class="btn openModalBtn" id="deleteBtn" style="display: block"
                                            data-modal-target="modal{{ $book['id'] }}"
                                            data-modal-toggle="modal{{ $book['id'] }}">
                                            Delete
                                        </button>
                                        {{-- Popup Modal --}}
                                        <div id="modal{{ $book['id'] }}" tabindex="-1"
                                            class="modalWindow hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <button type="button"
                                                        class="closeModal absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-hide="modal{{ $book['id'] }}">
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
                                                            Are you sure you want to delete this product?</h4>
                                                        <form action="{{ route('books.destroy', $book->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            {{-- <button type="submit" value="Delete"
                                                                    id="red-btn">Delete</button> --}}
                                                            <button value="Delete"
                                                                data-modal-hide="modal{{ $book['id'] }}" type="submit"
                                                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                                                Yes, I'm sure
                                                            </button>
                                                        </form>
                                                        <button data-modal-hide="modal{{ $book['id'] }}" type="button"
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
                <br>
                <div class="pagination">
                    {{ $books->appends(['sort' => $sort, 'order' => $order])->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
