@extends('layouts.app')
@section('localVite')
    @vite(['resources/assets/js/changeListView.js'])
@endsection
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
            <h2 class="m-9">All
                @if ($category != null)
                    {{ ucfirst($category) }}
                @endif
                Books
            </h2>
        @endif
        {{-- FINISH WHEN RATINGS IMPLEMENTED --}}
        <div class="books-top-settings flex">
            <div class="sort-div flex">
                <h4 class="mr-3">Sort by</h4>
                <form action="{{ route('books.sort') }}" onchange="this.submit()" method="GET">
                    <select name="sort" id="sort-books">
                        <option value="price-asc">Price (cheapest first)</option>
                        <option value="price-desc">Price (expensive first)</option>
                        <option value="date-asc">Date (newest first)</option>
                        <option value="date-desc">Date (oldest first)</option>
                        {{-- <option value="rating">Rating</option> --}}
                    </select>
                </form>
            </div>
            <div class="view-div flex">
                <h4 class="ml-3">View</h4>
                <img src="https://www.svgrepo.com/show/521918/view-rows.svg" alt="" class="view-icon"
                    id="rows-view">
                <img src="https://www.svgrepo.com/show/521915/view-grid.svg" alt="" class="view-icon"
                    id="grid-view">
            </div>
        </div>
        <main class="book-search-wrapper">
            <div class="books-rows">
                @foreach ($books as $book)
                    <a href="{{ route('books.show', $book['id']) }}">
                        <div class="book-card-common book-row-card">
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
                                <div class="main-info">
                                    <p class="book-title">{{ $book['book_name'] }}</p>
                                    <p class="book-author">{{ $book['author'] }}</p>
                                    <p class="book-language">{{ ucfirst(trans($book['language'])) }}</p>
                                    <p class="book-price">£{{ number_format((float) $book['price'], 2, '.', '') }}</p>
                                </div>
                                <div class="book-card-buttons">
                                    <form action="{{ route('wishlist.store', $book['id']) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="book-button-icon">
                                            <img src="https://www.svgrepo.com/show/361197/heart.svg" alt="Add to Basket">
                                        </button>
                                    </form>
                                    <form action="{{ route('basket.store', $book['id']) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="book-button-icon 
                                        @if ($book['quantity'] <= 0) @php
                                                echo 'disabled-icon';
                                                $disabled = true;
                                            @endphp @endif"
                                            {{ $disabled ?? false ? ' disabled' : '' }}>
                                            <img src="https://www.svgrepo.com/show/506558/shopping-cart.svg"
                                                alt="Add to Wishlist">
                                            @if ($book['quantity'] <= 0)
                                                <span class="message">This Book is Out of Stock</span>
                                            @endif
                                        </button>
                                    </form>
                                </div>
                                <div class="book-card-desc">
                                    {{ $book['description'] }}
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach

            </div>
            <div class="books-list" style="display: none">
                @foreach ($books as $book)
                    <a href="{{ route('books.show', $book['id']) }}">
                        <div class="book-card book-card-common">
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

            <div>
                <div class="ml-5 flex">
                    <img src="https://www.svgrepo.com/show/532169/filter.svg" alt="filter-icon" class="w-5 mr-1">
                    <h4>Apply filters</h4>
                </div>
                <div class="search-sidebar">
                    <form action="{{ route('books.filter') }}" method="GET" class="flex flex-col m-3">
                        <div class="lang-checkboxes">
                            <h5>Languages:</h5>
                            <input type="checkbox" name="lang[]" id="Spanish" value="Spanish"
                                {{ in_array('Spanish', $selectedLanguages) ? 'checked' : '' }}>
                            <label for="Spanish">Spanish</label> <br>
                            <input type="checkbox" name="lang[]" id="Polish" value="Polish"
                                {{ in_array('Polish', $selectedLanguages) ? 'checked' : '' }}>
                            <label for="Polish">Polish</label> <br>
                            <input type="checkbox" name="lang[]" id="Romanian"
                                value="Romanian"{{ in_array('Romanian', $selectedLanguages) ? 'checked' : '' }}>
                            <label for="Romanian">Romanian</label> <br>
                            <input type="checkbox" name="lang[]" id="Russian"
                                value="Russian"{{ in_array('Russian', $selectedLanguages) ? 'checked' : '' }}>
                            <label for="Russian">Russian</label> <br>
                            <input type="checkbox" name="lang[]" id="Urdu"
                                value="Urdu"{{ in_array('Urdu', $selectedLanguages) ? 'checked' : '' }}>
                            <label for="Urdu">Urdu</label> <br>
                            <input type="checkbox" name="lang[]" id="Punjabi"
                                value="Punjabi"{{ in_array('Punjabi', $selectedLanguages) ? 'checked' : '' }}>
                            <label for="Punjabi">Punjabi</label>
                        </div>
                        <div class="stock-chechboxes">
                            <h5>Stock Level:</h5>
                            <select name="stock" id="stock">
                                <option value="all-stock" {{ $selectedStock === 'all-stock' ? 'selected' : '' }}>All
                                </option>
                                <option value="in-stock" {{ $selectedStock === 'in-stock' ? 'selected' : '' }}>In Stock
                                </option>
                                <option value="not-in-stock" {{ $selectedStock === 'not-in-stock' ? 'selected' : '' }}>Not
                                    In Stock</option>
                            </select>
                        </div>
                        <button class="py-2 px-4 rounded btn" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
@endsection
