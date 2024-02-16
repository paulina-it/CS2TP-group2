@extends('layouts.app')

@section('main')
    <div class="main-search m-auto">
        @if ($search != null)
            @if (count($books) == 0)
                <h2 class="m-9 text-center">No books were found</h2>
            @elseif (count($books) == 1)
                <script>
                    window.location = "/books/" + {{ $books[0]->id }};
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
        <div class="books-list">
            @foreach ($books as $book)
                <a href="{{ route('books.show', $book['id']) }}">
                    <div class="book-card">
                        <div class="book-card-cover">
                            @if (Storage::disk('public')->exists($book['mainImage']))
                                <img class="book-cover" src="{{ asset('storage/' . $book['mainImage']) }}"
                                    alt="{{ $book['book_name'] }}">
                            @else
                            <div class="dummy-book-cover">
                                <p>Image not available</p>
                            </div>
                            @endif
                        </div>
                        <div class="book-card-info">
                            <p class="book-author">{{ $book['author'] }}</p>
                            <p class="book-language">{{ ucfirst(trans($book['language'])) }}</p>
                            <p class="book-title">{{ $book['book_name'] }}</p>
                            <p class="book-price">£{{ number_format((float) $book['price'], 2, '.', '') }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
