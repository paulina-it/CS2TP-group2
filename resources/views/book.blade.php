<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/images/No text white logo.png" type="image/png">
    <title>flippinpages</title>

    @vite(['resources/assets/sass/app.scss', 'resources/js/app.js'])
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
</head>

<body>
    @include('layouts.navigation')
    <div class="content">
        <div class="book flex flex-col m-auto">
            <!-- Book main information -->
            <div class="book-main-info-div flex m-5">
                <!-- Book cover and previews -->
                <div class="flex book-img-div">
                    <div class="book-previews-div flex flex-col">
                        <!-- Book previews -->
                        <img onclick="changePreview(this)" class="opened-preview book-img-mini"
                            src="https://i.postimg.cc/j56YwyRW/Eugene-Onegin.jpg" alt="">
                        <img onclick="changePreview(this)" class="book-img-mini"
                            src="https://i.postimg.cc/tCGjhhDC/EO-page-1.jpg" alt="">
                        <img onclick="changePreview(this)" class="book-img-mini"
                            src="https://i.postimg.cc/65VNzy1V/EO-page-2.jpg" alt="">
                        <img onclick="changePreview(this)" class="book-img-mini"
                            src="https://i.postimg.cc/tCGjhhDC/EO-page-1.jpg" alt="">
                    </div>
                    <img src="https://i.postimg.cc/j56YwyRW/Eugene-Onegin.jpg" alt="" class="book-cover">
                </div>
                <!-- Book information and buttons -->
                <div class="book-info-div flex flex-col justify-around">
                    <div class="book-info">
                        <!-- Book title, author, language, and price -->
                        <h2 class="book-title">Eugene Onegin</h2>
                        <h4 class="book-author">Alexander Pushkin</h4>
                        <p class="book-language">Russian</p>
                        <p class="book-price mt-10">£12.90</p>
                    </div>
                    <div class="book-btns mb-10 flex flex-col">
                        <!-- Quantity input and buttons -->
                        <div class="cart flex mb-2">
                            <div class="qty-input">
                                <button class="qty-count qty-count--minus" data-action="minus" type="button">-</button>
                                <input class="product-qty" type="number" name="product-qty" min="0"
                                    max="10" value="1">
                                <button class="qty-count qty-count--add" data-action="add" type="button">+</button>
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
                    "Eugene Onegin" is Alexander Pushkin's classic Russian novel in verse, a tale of love, pride, and
                    societal expectations. The disillusioned aristocrat, Eugene Onegin, rejects the passionate Tatyana
                    Larina, leading to a narrative exploring themes of regret and the clash between individual desires
                    and
                    societal norms. Pushkin's lyrical prose and witty exploration of human complexities make "Eugene
                    Onegin"
                    a timeless masterpiece, offering a poignant commentary on 19th-century Russian society and enduring
                    relevance in its portrayal of love and the human condition.
                </p>
            </div>

        </div>
        <div class="book-genres flex flex-col w-2/3 justify-around m-auto mt-20">
            <h2 class="text-2xl category-title">Genres</h2>
            <div class="genres flex justify-around">
                <div
                    class="genre w-40 text-white font-bold py-2 px-4 rounded-full rounded-full flex justify-center m-4">
                    Novel in Verse
                </div>
                <div
                    class="genre w-32 text-white font-bold py-2 px-4 rounded-full flex justify-center m-4">
                    Sonnet
                </div>
            </div>
        </div>
        <div class="similar flex flex-col w-2/3 justify-around m-auto mt-20">
            <h2 class="text-2xl category-title">Similar books</h2>
            <div class="similar-books-list flex justify-between">
                <div class="book-small">
                    <img class="book-cover"
                        src="https://www.thoughtco.com/thmb/QjDehTJSAXp8Zl2yM5iJxextIL4=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/anna-karenina-59ce5f876f53ba001172c6c8.jpg"
                        alt="">
                    <p class="book-title">Anna Karenina</p>
                    <p class="book-author">Leo Tolstoy</p>
                    <p class="book-price">£14.90</p>
                </div>
                <div class="book-small">
                    <img class="book-cover" src="https://book-assets.openroadmedia.com/9781504061452.jpg"
                        alt="">
                    <p class="book-title">The Brotheres Karamazov</p>
                    <p class="book-author">Fyodor Dostoyevsky</p>
                    <p class="book-price">£13.90</p>
                </div>
                <div class="book-small">
                    <img class="book-cover"
                        src="https://www.thoughtco.com/thmb/QjDehTJSAXp8Zl2yM5iJxextIL4=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/anna-karenina-59ce5f876f53ba001172c6c8.jpg"
                        alt="">
                    <p class="book-title">Anna Karenina</p>
                    <p class="book-author">Leo Tolstoy</p>
                    <p class="book-price">£14.90</p>
                </div>
                <div class="book-small">
                    <img class="book-cover" src="https://book-assets.openroadmedia.com/9781504061452.jpg"
                        alt="">
                    <p class="book-title">The Brotheres Karamazov</p>
                    <p class="book-author">Fyodor Dostoyevsky</p>
                    <p class="book-price">£13.90</p>
                </div>
                <div class="book-small last">
                    <img class="book-cover"
                        src="https://www.thoughtco.com/thmb/QjDehTJSAXp8Zl2yM5iJxextIL4=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/anna-karenina-59ce5f876f53ba001172c6c8.jpg"
                        alt="">
                    <p class="book-title">Anna Karenina</p>
                    <p class="book-author">Leo Tolstoy</p>
                    <p class="book-price">£14.90</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
