@extends('layouts.app')

@section('main')
    <div class="admin-books-wrapper">
        {{-- @include('layouts.admin-sidebar') --}}
        <div class="main-search m-auto">
            @if ($search != null)
                @if (count($books) == 0)
                    <h2 class="m-9 text-center">No books were found</h2>
                @elseif (count($books) == 1)
                    <script>
                        window.location = "/books/edit" + {{ $books[0]->id }};
                    </script>
                @else
                    <h2 class="m-5">Search results for "{{ $search }}":</h2>
                @endif
            @else
                <h2 class="m-9 text-center">List of all
                    @if ($category != null)
                        {{ ucfirst($category) }}
                    @endif
                    books
                </h2>
            @endif
            <div class="admin-books-list">
                @foreach ($books as $book)
                    <div class="book-card-inventory">
                        <div class="book-card-cover">
                            @if (Storage::disk('public')->exists($book['mainImage']))
                                <img class="book-cover" src="{{ asset('storage/' . $book['mainImage']) }}"
                                    alt="{{ $book['book_name'] }}">
                            @else
                                <p>Main image not found</p>
                            @endif
                        </div>
                        <div class="book-card-info">
                            <p class="book-author"><u>Author:</u> <br><br> {{ $book['author'] }}</p>
                            <p class="book-author"><u>Language:</u> <br><br> {{ $book['language'] }}</p>
                            <p class="book-title"><u>Name:</u> <br><br>{{ $book['book_name'] }}</p>
                            <p class="book-price"><u>Price:</u> <br><br>
                                £{{ number_format((float) $book['price'], 2, '.', '') }}</p>
                            <p class="book-title"><u>Stock:</u> <br><br>{{ $book['quantity'] }}</p>
                        </div>
                        <div class="book-card-btns">
                            <button class="btn" id="editBtn"
                                onclick="window.location='{{ route('books.edit', $book['id']) }}'">Edit</button>
                            <button class="btn" id="deleteBtn">Delete</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
