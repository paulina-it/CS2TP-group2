@extends('layouts.app')
@section('localVite')
    <!-- Include Bootstrap CSS -->
    <link href="path/to/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Include Bootstrap JS -->
    <script src="path/to/bootstrap/js/bootstrap.bundle.min.js"></script>
@endsection
@section('main')
    <div class="main home">
        <!-- ADVERTISEMENT SLIDESHOW -->
        <div class="slideshow-container">
            <div class="mySlides fade">
                <img src="Images/discover.png" class="d-block w-100" alt="...">
            </div>
            <div class="mySlides fade">
                <img src="Images/backtoschool.png" class="d-block w-100" alt="...">
            </div>
            <div class="mySlides fade">
                <img src="Images/fallreading.png" class="d-block w-100" alt="...">
            </div>

            <!-- Navigation buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>

        <!-- Book cards -->
        <div class="category_block_header">
            <h2>Trending Books</h2>
        </div>
        <div class="trending_block_header">
            {{-- BACKEND --}}
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
            {{-- <div class="book-card">
            <div class="book-card-cover">
                <img class="book-cover" src="https://i.postimg.cc/2y2pTmbr/Anna-Karenina.jpg" alt="">
            </div>
            <div class="book-card-info">
                <p class="book-author">Leo Tolstoy</p>
                <p class="book-title">Anna Karenina</p>
                <p class="book-price">£14.90</p>
            </div>
        </div>
        <div class="book-card">
            <div class="book-card-cover">
                <img class="book-cover" src="https://i.postimg.cc/2y2pTmbr/Anna-Karenina.jpg" alt="">
            </div>
            <div class="book-card-info">
                <p class="book-author">Leo Tolstoy</p>
                <p class="book-title">Anna Karenina</p>
                <p class="book-price">£14.90</p>
            </div>
        </div>
        <div class="book-card">
            <div class="book-card-cover">
                <img class="book-cover" src="https://i.postimg.cc/2y2pTmbr/Anna-Karenina.jpg" alt="">
            </div>
            <div class="book-card-info">
                <p class="book-author">Leo Tolstoy</p>
                <p class="book-title">Anna Karenina</p>
                <p class="book-price">£14.90</p>
            </div>
        </div>
        <div class="book-card">
            <div class="book-card-cover">
                <img class="book-cover" src="https://i.postimg.cc/2y2pTmbr/Anna-Karenina.jpg" alt="">
            </div>
            <div class="book-card-info">
                <p class="book-author">Leo Tolstoy</p>
                <p class="book-title">Anna Karenina</p>
                <p class="book-price">£14.90</p>
            </div>
        </div>
        <div class="book-card">
            <div class="book-card-cover">
                <img class="book-cover" src="https://i.postimg.cc/2y2pTmbr/Anna-Karenina.jpg" alt="">
            </div>
            <div class="book-card-info">
                <p class="book-author">Leo Tolstoy</p>
                <p class="book-title">Anna Karenina</p>
                <p class="book-price">£14.90</p>
            </div>
        </div>
        <div class="book-card">
            <div class="book-card-cover">
                <img class="book-cover" src="https://i.postimg.cc/2y2pTmbr/Anna-Karenina.jpg" alt="">
            </div>
            <div class="book-card-info">
                <p class="book-author">Leo Tolstoy</p>
                <p class="book-title">Anna Karenina</p>
                <p class="book-price">£14.90</p>
            </div>
        </div> --}}
        </div>

        {{-- <div class="carousel-item" data-bs-interval="2000">
        <img src="Images/LNL.png" class="d-block w-100" alt="...">
    </div> --}}
    <div class="grid-categories">
        <!-- Categories Image Links -->
        <div class="languages-div">
            <div class="category_block_header">
                <h2>Languages</h2>
            </div>
            <div class="category_block">
                <ul class="categories">
                    <li class="category">
                        <a href="#">
                            <img src="Images/punjabinew.png" alt="">
                            Punjabi
                        </a>

                    </li>
                    <li class="category">
                        <a href="#">
                            <img src="Images/polishnew.png" alt="">
                            Polish
                        </a>

                    </li>
                    <li class="category">
                        <a href="#">
                            <img src="Images/Romainiannew.png" alt="">
                            Romanian
                        </a>

                    </li>
                    <li class="category">
                        <a href="#">
                            <img src="Images/Urdu.png" alt="">
                            Urdu
                        </a>

                    </li>
                    </li>
                    <li class="category">
                        <a href="#">
                            <img src="Images/Latin.png" alt="">
                            Latin
                        </a>
                    </li>
                    <li class="category">
                        <a href="#">
                            <img src="Images/Russian.png" alt="">
                            Russian
                        </a>

                    </li>
                </ul>
            </div>

        </div>

        <div class="genres-div">
            <!-- Categories Image Links -->
            <div class="category_block_header">
                <h2>Genres</h2>
            </div>
            <div class="category_block">
                <ul class="categories">
                    <li class="category">
                        <a href="#">
                            <img src="Images/BestSeller" alt="">
                            Best Sellers
                        </a>

                    </li>
                    <li class="category">
                        <a href="#">
                            <img src="Images/Fiction.webp" alt="">
                            Fiction
                        </a>

                    </li>
                    <li class="category">
                        <a href="#">
                            <img src="Images/Non fiction.webp" alt="">
                            Non-Fiction
                        </a>
                    </li>
                    <li class="category">
                        <a href="#">
                            <img src="Images/Children.webp" alt="">
                            Children
                        </a>
                    </li>
                    <li class="category">
                        <a href="#">
                            <img src="Images/Teen.webp" alt="">
                            Teen
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    </div>

    <script>
        // Your existing JavaScript code
        // ...

        // Additional JavaScript for automatic slideshow
        var slideIndex = 0;

        function showSlides() {
            var i;
            var slides = document.getElementsByClassName("mySlides");

            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }

            slideIndex++;

            if (slideIndex > slides.length) {
                slideIndex = 1;
            }

            slides[slideIndex - 1].style.display = "block";
            setTimeout(showSlides, 4000); // Change slide every 4 seconds
        }

        function plusSlides(n) {
            slideIndex += n;
            showSlides();
        }

        // Call showSlides immediately to start the slideshow
        window.onload = function() {
            showSlides();
        };
    </script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
@endsection
