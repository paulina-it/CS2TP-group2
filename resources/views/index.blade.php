@extends('layouts.app')
@section('localVite')
    @vite(['resources/assets/js/scroll.js'])
@endsection
@section('main')
    <div class="main home-container">
        <div class="banner">
            <img src="https://i.postimg.cc/jS5d41ML/main-banner.jpg" alt="main banner">
        </div>
        <div class="spacer"></div>
        <div id="new-books" class="similar section flex flex-col justify-around m-auto mt-20">
            <h2 class="category-title">New books</h2>
            <button id="scrollLeftBtn"
                class="scroll-btn back bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 border rounded-full">
                < </button>
                    <button
                        id="scrollRightBtn"class="scroll-btn forward bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 border rounded-full">
                        > </button>
                    <div class="similar-books-list flex justify-between">
                        <!-- Book cards -->
                        @foreach ($books as $book)
                            <a href="{{ route('books.show', $book['id']) }}">
                                <div class="book-card">
                                    <div class="book-card-cover">
                                        @if (Storage::disk('public')->exists($book['mainImage']))
                                            <img class="book-cover" src="{{ asset('storage/' . $book['mainImage']) }}"
                                                alt="{{ $book['book_name'] }}">
                                        @else
                                            {{-- <p>Main image not found</p> --}}
                                            <div class="dummy-book-cover">
                                                <p>Image not available</p>
                                            </div>
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
        <div class="mid-banner">
            <q>Reading gives us someplace to go when we have to stay where we are.</q>
            <p>- Mason Cooley</p>
        </div>
        <div class="spacer-smaller"></div>
        <div class="categories">
            <div id="languages" class="languages-container">
                <h2>Languages</h2>
                <div class="languages-div">
                    <?php
                    $languages = ['polish', 'romanian', 'russian', 'punjabi', 'urdu', 'spanish'];
                    $langsBG = ['https://i.postimg.cc/BQvfDwbQ/lang1.jpg','https://i.postimg.cc/Gm80g8vW/lang2.jpg','https://i.postimg.cc/kGJ3TTys/lang3.jpg','https://i.postimg.cc/HWzCrCph/lang4.jpg','https://i.postimg.cc/ZKDtLFvP/lang5.jpg','https://i.postimg.cc/8cZ89LKS/lang6.jpg'];
                    ?>
                    @foreach ($languages as $index => $language)
                        <a href="{{ route('books.category', ['category_slug' => $language]) }}">
                            <div class="language">
                                <h4 class="lang-text">
                                    {{ $language }}
                                </h4>
                                <img class="lang-bg" src="{{ $langsBG[$index] }}" alt="{{ $language }}">
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="genres-container">
                <h2>Genres</h2>
                <div class="genres-div">
                    <?php
                    $genres = ['romance', 'sci-fi', 'fiction', 'fantasy', 'novel', 'non-fiction'];
                    $genresBg = ['https://i.postimg.cc/SN4nCD0M/genre1.jpg', 'https://i.postimg.cc/P5rNFJ5f/genre2.jpg', 'https://i.postimg.cc/kXyBcK9h/genre3.jpg', 'https://i.postimg.cc/KcBK1CWb/genre4.jpg', 'https://i.postimg.cc/wBnvvkc3/genre5.jpg', 'https://i.postimg.cc/NMT0rrpD/genre6.jpg', 'https://i.postimg.cc/xT1smRg1/genre7.jpg', 'https://i.postimg.cc/L6Qx310B/genre8.jpg'];
                    // $i = 1;
                    ?>
                    @foreach ($genres as $index => $genre)
                        <a href="{{ route('books.category', ['category_slug' => $genre]) }}">
                            <div class="genre">
                                <h4 class="genre-text">
                                    {{ $genre }}
                                </h4>
                                <img class="genre-bg" src="{{ $genresBg[$index] }}" alt="{{ $genre }}">
                            </div>
                        </a>
                        {{-- ?php $i++; ?> --}}
                    @endforeach
                </div>
                <p class="block-of-text mt-10">Delve into the complexities of the human experience with our literary fiction, explore diverse
                    non-fiction subjects, and stay updated with our constantly evolving database. Whether you're a seasoned bookworm or just starting your literary journey, our
                    online bookshop is your portal to a world of stories, ideas, and knowledge.</p>
            </div>
        </div>
    </div>
@endsection
