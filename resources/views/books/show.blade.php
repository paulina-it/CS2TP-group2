@extends('layouts.app')
@section('localVite')
    @vite(['resources/assets/js/bookPage.js'])
@endsection
@section('main')
    <div class="content">
        <div class="book">
            <!-- Book main information -->
            <div class="book-main-info-div m-5">
                <!-- Book cover and previews -->
                <div class="flex book-img-div">
                    <div class="book-previews-div flex flex-col">
                        <?php
                        $otherImages = json_decode($book['otherImages']);
                        ?>
                        <!-- Book previews -->
                        <img class="opened-preview book-img-mini" src="{{ asset('storage/' . $book['mainImage']) }}"
                            alt="{{ $book['book_name'] }}">
                        @foreach ($otherImages as $otherImage)
                            <img class="book-img-mini" src="{{ asset('storage/' . $otherImage) }}" alt="">
                        @endforeach
                    </div>
                    <img src="{{ asset('storage/' . $book['mainImage']) }}" alt="{{ $book['book_name'] }}"
                        class="book-cover">
                </div>
                <!-- Book information and buttons -->
                <div class="book-info-div flex flex-col justify-around">
                    <div class="book-info">
                        <!-- Book title, author, language, type and price -->
                        <h2 class="book-title">{{ $book['book_name'] }}</h2>
                        <h4 class="book-author">{{ $book['author'] }}</h4>
                        <p class="book-language">{{ ucfirst(trans($book['language'])) }}</p>
                        <p class="book-type" class="text-gray">{{ ucfirst(trans($book['type'])) }}</p>
                        <p class="book-price mt-10">£{{ number_format((float) $book['price'], 2, '.', '') }}</p>
                    </div>
                    <div class="book-btns mb-10">
                        <!-- Quantity input and buttons -->
                        <div class="cart flex mb-2">
                            <div class="qty-input">
                                <button class="qty-count qty-count--minus" type="button">-</button>
                                <input class="product-qty" type="number" name="product-qty" min="0" max="10"
                                    value="1">
                                <button class="qty-count qty-count--add" type="button">+</button>
                            </div>
                            <button id="addToCartBtn" class="py-2 px-4 rounded btn addToCartBtn">Add
                                to Cart</button>
                        </div>
                        <button id="addToCartBtn" class="py-2 px-4 rounded btn addToWishlistBtn">
                            Add to Wishlist</button>
                    </div>
                </div>
            </div>

            <!-- Book description -->
            <div class="book-desc-div">
                <p class="book-desc">
                    {{ $book['description'] }}
                </p>
            </div>

        </div>
        <!-- Book genres -->
        <div class="book-genres section flex flex-col w-2/3 justify-around m-auto mt-20">
            <span class="text-line"></span>
            <h2 class="text-2xl category-title">Genres</h2>
            <div class="genres flex justify-around">
                <?php
                $genres = explode(', ', $book['genre']);
                ?>
                @foreach ($genres as $genre)
                    <div
                        class="genre w-40 text-white font-bold py-2 px-4 rounded-full rounded-full flex justify-center m-4">
                        {{ $genre }}
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Similar books -->
        <div class="similar section flex flex-col justify-around m-auto mt-20">
            <span class="text-line"></span>
            <h2 class="text-2xl category-title">Other Books in {{ ucfirst(trans($book['language'])) }}</h2>
            <button id="scrollLeftBtn"
                class="scroll-btn back bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 border rounded-full">
                < </button>
                    <button
                        id="scrollRightBtn"class="scroll-btn forward bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 border rounded-full">
                        > </button>
                    <div class="similar-books-list flex justify-between">
                        <!-- Book cards -->
                        @for ($i = 0; $i < 3; $i++)
                            @foreach ($otherBooksInLanguage as $otherBook)
                            <a href="{{ route('books.show', $otherBook['id']) }}">
                                <div class="book-card">
                                    <div class="book-card-cover">
                                        <img class="book-cover" src="{{ asset('storage/' . $otherBook['mainImage']) }}"
                                            alt="">
                                    </div>
                                    <div class="book-card-info">
                                        <p class="book-author">{{ $otherBook['author'] }}</p>
                                        <p class="book-title">{{ $otherBook['book_name'] }}</p>
                                        <p class="book-price">£{{ number_format((float) $book['price'], 2, '.', '') }}</p>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        @endfor

                    </div>
        </div>
    </div>
@endsection
