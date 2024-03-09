@extends('layouts.app')
@section('localVite')
    @vite(['resources/assets/js/scroll.js', 'resources/assets/js/bookPage.js', 'resources/assets/js/qty-input.js'])
@endsection
@section('main')
    <div class="content">
        <div class="book">
            <!-- Book main information -->
            <div class="book-main-info-div m-5">
                <!-- Book cover and previews -->
                <div class="flex book-img-div">
                    <div class="book-previews-div flex flex-col">
                        @php
                            $otherImages = json_decode($book['otherImages']);
                        @endphp
                        <!-- Book previews -->
                        <img class="opened-preview book-img-mini" src="{{ asset('storage/' . $book['mainImage']) }}"
                            alt="{{ $book['book_name'] }}">
                        @if ($otherImages != null)
                            @foreach ($otherImages as $otherImage)
                                <img class="book-img-mini" src="{{ asset('storage/' . $otherImage) }}" alt="">
                            @endforeach
                        @endif
                    </div>
                    @if (Storage::disk('public')->exists($book['mainImage']))
                        <img src="{{ asset('storage/' . $book['mainImage']) }}" alt="{{ $book['book_name'] }}"
                            class="book-cover">
                    @else
                        <div class="dummy-book-cover">
                            <p>Image not available</p>
                        </div>
                    @endif
                </div>
                <!-- Book information and buttons -->
                <div class="book-info-div flex flex-col justify-around">
                    <div class="book-info">
                        <!-- Book title, author, language, type and price -->
                        @php
                            $totalRating = 0;
                            $totalReviews = count($ratings);

                            foreach ($ratings as $rating) {
                                $totalRating += $rating['score'];
                            }

                            $averageRating = $totalReviews > 0 ? $totalRating / $totalReviews : 0;
                        @endphp
                        <div class="book-info-top">
                            <h2 class="book-title">{{ $book['book_name'] }}</h2>
                            @if ($totalReviews > 0)
                                <div class="book-rating"><img class="rating-icon"
                                        src="https://i.postimg.cc/NGymHksh/star-svgrepo-com.png"
                                        alt="">{{ $averageRating }}
                                </div>
                            @endif
                        </div>
                        <h4 class="book-author">{{ $book['author'] }}</h4>
                        <p class="book-language">{{ ucfirst(trans($book['language'])) }}</p>
                        <p class="book-type" class="text-gray">{{ ucfirst(trans($book['type'])) }}</p>
                        <p class="book-price mt-10">£{{ number_format((float) $book['price'], 2, '.', '') }}</p>
                        @if ($book['quantity'] > 0)
                            <div class="book-stock">
                                <svg class="stock-icon" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                    class="iconify iconify--twemoji" preserveAspectRatio="xMidYMid meet" fill="#000000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <circle fill="#78B159" cx="18" cy="18" r="18"></circle>
                                    </g>
                                </svg>
                                <p class="book-stock-text">In stock</p>
                            </div>
                        @else
                            <div class="book-stock">
                                <svg class="stock-icon" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                    class="iconify iconify--twemoji" preserveAspectRatio="xMidYMid meet" fill="#000000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <circle fill="#b04545" cx="18" cy="18" r="18"></circle>
                                    </g>
                                </svg>
                                <p class="book-stock-text" class="text-xs">Not in stock</p>
                            </div>
                        @endif
                    </div>
                    <div class="book-btns mb-10">
                        <!-- Quantity input and buttons -->
                        <form action="{{ route('basket.store', $book['id']) }}" method="POST">
                            @csrf
                            <div class="cart flex mb-2">
                                <div class="qty-input">
                                    <button class="qty-count qty-count--minus" type="button">-</button>
                                    <input class="product-qty" type="number" name="product-qty" min="0"
                                        max="10" value="1">
                                    <button class="qty-count qty-count--add" type="button">+</button>
                                </div>
                                @if ($book['quantity'] <= 0)
                                    @php
                                        $disabled = true;
                                    @endphp
                                @endif
                                <button type="submit" id="addToCartBtn" class="py-2 px-4 rounded btn addToCartBtn"
                                    value="Add to Cart" {{ $disabled ?? false ? ' disabled' : '' }}>Add
                                    to Cart</button>
                            </div>
                        </form>
                        <form action="{{ route('wishlist.store', $book['id']) }}" method="POST">
                            @csrf
                            <button type="submit" id="addToWishlistBtn" class="py-2 px-4 rounded btn addToWishlistBtn"
                                @guest
disabled @endguest>
                                Add to Wishlist
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Book description -->
        <div class="book-desc-div">
            <p class="book-desc">
                {{ $book['description'] }}
            </p>
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
                    <a href="{{ route('books.category', ['category_slug' => $genre]) }}">
                        <div
                            class="genre w-40 text-white font-bold py-2 px-4 rounded-full rounded-full flex justify-center m-4">
                            {{ ucfirst(trans($genre)) }}
                        </div>
                    </a>
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
                                    <div class="book-card book-card-common">
                                        <div class="book-card-cover">
                                            <img class="book-cover"
                                                src="{{ asset('storage/' . $otherBook['mainImage']) }}" alt="">
                                        </div>
                                        <div class="book-card-info">
                                            <p class="book-author">{{ $otherBook['author'] }}</p>
                                            <p class="book-language">{{ ucfirst(trans($otherBook['language'])) }}</p>
                                            <p class="book-title">{{ $otherBook['book_name'] }}</p>
                                            <div class="grid-card-bottom">
                                                <p class="book-price">
                                                    £{{ number_format((float) $otherBook['price'], 2, '.', '') }}</p>
                                                <div class="book-card-buttons">
                                                    <form action="{{ route('wishlist.store', $otherBook['id']) }}"
                                                        method="POST">
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
                                                                <span class="message">Please Login or Signup to Access
                                                                    Wishlist</span>
                                                            @endguest
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('basket.store', $otherBook['id']) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class="book-button-icon 
                                                    @if ($otherBook['quantity'] <= 0) @php
                                                            echo 'disabled-icon';
                                                            $disabled = true;
                                                        @endphp 
                                                        @else @php
                                                            $disabled = false;
                                                        @endphp @endif"
                                                            {{ $disabled ?? false ? ' disabled' : '' }}>
                                                            <img src="https://www.svgrepo.com/show/506558/shopping-cart.svg"
                                                                alt="Add to Wishlist">
                                                            @if ($otherBook['quantity'] <= 0)
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
                        @endfor

                    </div>
        </div>

        <div class="product-rating section w-2/3">
            <span class="text-line"></span>
            <h2 class="text-2xl category-title">Reviews</h2>
            @if (count($ratings) > 0)
                @for ($i = 0; $i < count($ratings); $i++)
                    <div class="review-div">
                        <p><strong>{{ $ratingAuthors[$i]['firstName'] . ' ' . $ratingAuthors[$i]['lastName'] }}</strong>
                            rated
                            this book as {{ $ratings[$i]['score'] }}/5.</p>
                        <hr class="border-amber-900 bg-amber-900">
                        <p class="review-text">{{ $ratings[$i]['review'] }}</p>
                    </div>
                @endfor
            @else
                <div class="no-reviews flex">
                    {{-- <img src="https://i.postimg.cc/BQhd7HPB/write-book-svgrepo-com.png" alt=""> --}}
                    <p>There are currently no reviews, you can be the first to leave it.</p>
                </div>
            @endif
            {{-- @if (Auth::check())
                <form action="{{ route('product-rating.create', $book['id']) }}" method="POST">
                    @csrf
                    <h3>Leave a review</h3>
                    <select name="score">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select> 
                    <textarea name="review">
                </textarea>
                    <input type="submit" value="Submit">
                </form>
            @else
                <label>Please log in to leave a review</label>
            @endif --}}
        </div>
    </div>
@endsection
