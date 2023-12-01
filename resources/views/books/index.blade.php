@extends('layouts.app')

@section('main')
    <div class="main">
        {{-- <div class="search-div">
            <form action="{{ route('books.index') }}" method="GET" class="card mb-3">
                <div class="card-body">
                    <input type="text" placeholder="Search" name="search" class="form-control card-title">

                    <input type="submit" class="btn btn-primary">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="searchBy" value="name" id="name"
                            checked>
                        <label class="form-check-label" for="name">
                            Name
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="searchBy" value="genre" id="genre">
                        <label class="form-check-label" for="genre">
                            Genre
                        </label>
                    </div>
                    @if (!empty($search))
                        <label style="color: black">Search results for {{ $search }}</label><br>
                        <a style="color: black" href="{{ route('books.index') }}">Clear Search</a>
                    @endif
                </div>
            </form>
        </div> --}}
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
