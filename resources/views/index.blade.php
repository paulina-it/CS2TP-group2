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
        <div class="similar section flex flex-col justify-around m-auto mt-20">
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
        <div class="mid-banner">
            <q>Reading gives us someplace to go when we have to stay where we are.</q>
            <p>- Mason Cooley</p>
        </div>
        <div class="spacer-smaller"></div>
        <div class="categories">
            <div class="languages-container">
                <h2>Languages</h2>
                <div class="languages-div">
                    <?php
                    $languages = ['polish', 'romanian', 'russian', 'punjabi', 'urdu', 'spanish'];
                    ?>
                    @foreach ($languages as $language)
                        <a href="{{ route('books.category', ['category_slug' => $language]) }}">
                            <div class="language">
                                <h4 class="lang-text">
                                    {{ $language }}
                                </h4>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="genres-container">
                <h2>Genres</h2>
                <div class="genres-div">
                    <?php
                    $genres = ['romance', 'sci-fi', 'fiction', 'fantasy', 'novel', 'sonnet'];
                    $genresBg = ['https://i.postimg.cc/SN4nCD0M/genre1.jpg', 'https://i.postimg.cc/P5rNFJ5f/genre2.jpg', 'https://i.postimg.cc/kXyBcK9h/genre3.jpg', 'https://i.postimg.cc/KcBK1CWb/genre4.jpg', 'https://i.postimg.cc/wBnvvkc3/genre5.jpg', 'https://i.postimg.cc/NMT0rrpD/genre6.jpg'];
                    // $i = 1;
                    ?>
                    @foreach ($genres as $index => $genre)
                        <a href="{{ route('books.category', ['category_slug' => $genre]) }}">
                            <div class="genre">
                                <h4 class="genre-text">
                                    {{ $genre }}
                                </h4>
                                {{-- <img class="genre-bg" src="{{ '/images/genre' . $i . ".jpg"}}" alt="{{$genre}}"> --}}
                                <img class="genre-bg" src="{{ $genresBg[$index] }}" alt="{{ $genre }}">
                            </div>
                        </a>
                        {{-- ?php $i++; ?> --}}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
