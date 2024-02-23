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
                        <option value="price-asc" {{ $sort === 'price-asc' ? 'selected' : '' }}>Price (cheapest first)
                        </option>
                        <option value="price-desc" {{ $sort === 'price-desc' ? 'selected' : '' }}>Price (expensive first)
                        </option>
                        <option value="date-desc" {{ $sort === 'date-desc' ? 'selected' : '' }}>Date (newest first)</option>
                        <option value="date-asc" {{ $sort === 'date-asc' ? 'selected' : '' }}>Date (oldest first)</option>
                        {{-- <option value="rating">Rating</option> --}}
                    </select>
                </form>
            </div>
            <div class="view-div flex">
                <h4 class="ml-3">View</h4>
                <form id="rows-form" action="{{ route('save.view.choice') }}" method="POST" style="display: hidden">
                    <input type="hidden" name="view_choice" value="rows">
                    @csrf<img src="https://www.svgrepo.com/show/521918/view-rows.svg" alt="" class="view-icon"
                        id="rows-view">
                </form>
                <form id="grid-form" action="{{ route('save.view.choice') }}" method="POST" style="display: hidden">
                    <input type="hidden" name="view_choice" value="grid">
                    @csrf<img src="https://www.svgrepo.com/show/521915/view-grid.svg" alt="" class="view-icon"
                        id="grid-view">
                </form>
            </div>
        </div>
        <main class="book-search-wrapper">
            @php
                $viewChoice = session('view_choice') ?? 'rows';
            @endphp
            <div class="books-rows {{ $viewChoice == 'rows' ? '' : 'hidden' }}">
                @if (count($books) <= 0)
                    <h3 class="text-center">Sorry, we coulnd't find a suitable book</h3>
                @endif
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
                                        <button type="submit"
                                            class="book-button-icon
                                        @guest @php
                                        echo 'disabled-icon';
                                        $disabled = true;
                                    @endphp @endguest"
                                            {{ $disabled ?? false ? ' disabled' : '' }}>
                                            <img src="https://www.svgrepo.com/show/361197/heart.svg" alt="Add to Basket">
                                            @guest
                                                <span class="message">Please Login or Signup to Access Wishlist</span>
                                            @endguest
                                        </button>
                                    </form>
                                    <form action="{{ route('basket.store', $book['id']) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="book-button-icon 
                                        @if ($book['quantity'] <= 0) @php
                                                echo 'disabled-icon';
                                                $disabled = true;
                                            @endphp 
                                            @else @php
                                                $disabled = false;
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
            <div class="books-list {{ $viewChoice == 'grid' ? '' : 'hidden' }}">
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
                                <div class="grid-card-bottom">
                                    <p class="book-price">£{{ number_format((float) $book['price'], 2, '.', '') }}</p>
                                    <div class="book-card-buttons">
                                        <form action="{{ route('wishlist.store', $book['id']) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="book-button-icon
                                        @guest @php
                                        echo 'disabled-icon';
                                        $disabled = true;
                                    @endphp @endguest"
                                                {{ $disabled ?? false ? ' disabled' : '' }}>
                                                <img src="https://www.svgrepo.com/show/361197/heart.svg"
                                                    alt="Add to Basket">
                                                @guest
                                                    <span class="message">Please Login or Signup to Access Wishlist</span>
                                                @endguest
                                            </button>
                                        </form>
                                        <form action="{{ route('basket.store', $book['id']) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="book-button-icon 
                                        @if ($book['quantity'] <= 0) @php
                                                echo 'disabled-icon';
                                                $disabled = true;
                                            @endphp 
                                            @else @php
                                                $disabled = false;
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

                                </div>
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
