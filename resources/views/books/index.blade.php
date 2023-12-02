@extends('layouts.app')

@section('main')
    <div class="main">
        @if ($search != null)
            <h2 class="m-5">Search results:</h2>
        @else
            <h2 class="m-5">List of all books</h2>
        @endif
        <div class="books-list flex">
            @foreach ($books as $book)
                <a href="{{ route('books.show', $book['id']) }}">
                    <div class="book-card">
                        <div class="book-card-cover">
                            @if (Storage::disk('public')->exists($book['mainImage']))
                                <img class="book-cover" src="{{ asset('storage/' . $book['mainImage']) }}"
                                    alt="{{ $book['book_name'] }}">
                            @else
                                <p>Main image not found</p>
                            @endif
                        </div>
                        <div class="book-card-info">
                            <p class="book-author">{{ $book['author'] }}</p>
                            <p class="book-title">{{ $book['book_name'] }}</p>
                            <p class="book-price">£{{ number_format((float) $book['price'], 2, '.', '') }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
