<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/images/No text white logo.png" type="image/png">
    <title>flippinpages</title>

    @vite(['resources/assets/sass/app.scss', 'resources/assets/js/app.js'])
</head>

<body>
    @include('layouts.navigation')
    <div class="content">
        <div class="book">
            <!-- Book main information -->
            <div class="book-main-info-div m-5">
                <!-- Book cover and previews -->
                <div class="flex book-img-div">
                    <div class="book-previews-div flex flex-col">
                        <!-- Book previews -->
                        <img  class="opened-preview book-img-mini"
                            src="https://i.postimg.cc/j56YwyRW/Eugene-Onegin.jpg" alt="">
                        <img class="book-img-mini"
                            src="https://i.postimg.cc/tCGjhhDC/EO-page-1.jpg" alt="">
                        <img class="book-img-mini"
                            src="https://i.postimg.cc/65VNzy1V/EO-page-2.jpg" alt="">
                        <img  class="book-img-mini"
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
                    <div class="book-btns mb-10">
                        <!-- Quantity input and buttons -->
                        <div class="cart flex mb-2">
                            <div class="qty-input">
                                <button class="qty-count qty-count--minus" type="button">-</button>
                                <input class="product-qty" type="number" name="product-qty" min="0"
                                    max="10" value="1">
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
        <!-- Book genres -->
        <div class="book-genres section flex flex-col w-2/3 justify-around m-auto mt-20">
            <span class="text-line"></span>
            <h2 class="text-2xl category-title">Genres</h2>
            <div class="genres flex justify-around">
                <div
                    class="genre w-40 text-white font-bold py-2 px-4 rounded-full rounded-full flex justify-center m-4">
                    Novel in Verse
                </div>
                <div class="genre w-32 text-white font-bold py-2 px-4 rounded-full flex justify-center m-4">
                    Sonnet
                </div>
            </div>
        </div>
        <!-- Similar books -->
        <div class="similar section flex flex-col justify-around m-auto mt-20">
            <span class="text-line"></span>
            <h2 class="text-2xl category-title">Similar books</h2>
            <button id="scrollLeftBtn"
                class="scroll-btn back bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 border rounded-full">
                < </button>
                    <button  id="scrollRightBtn"class="scroll-btn forward bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 border rounded-full">
                        > </button>
                    <div class="similar-books-list flex justify-between">
                        <!-- Book cards -->
                        <div class="book-card">
                            <div class="book-card-cover">
                                <img class="book-cover" src="https://i.postimg.cc/2y2pTmbr/Anna-Karenina.jpg"
                                    alt="">
                            </div>
                            <div class="book-card-info">
                                <p class="book-author">Leo Tolstoy</p>
                                <p class="book-title">Anna Karenina</p>
                                <p class="book-price">£14.90</p>
                            </div>
                        </div>
                        <div class="book-card">
                            <div class="book-card-cover">
                                <img class="book-cover" src="https://i.postimg.cc/2y2pTmbr/Anna-Karenina.jpg"
                                    alt="">
                            </div>
                            <div class="book-card-info">
                                <p class="book-author">Leo Tolstoy</p>
                                <p class="book-title">Anna Karenina</p>
                                <p class="book-price">£14.90</p>
                            </div>
                        </div>
                        <div class="book-card">
                            <div class="book-card-cover">
                                <img class="book-cover" src="https://i.postimg.cc/2y2pTmbr/Anna-Karenina.jpg"
                                    alt="">
                            </div>
                            <div class="book-card-info">
                                <p class="book-author">Leo Tolstoy</p>
                                <p class="book-title">Anna Karenina</p>
                                <p class="book-price">£14.90</p>
                            </div>
                        </div>
                        <div class="book-card">
                            <div class="book-card-cover">
                                <img class="book-cover" src="https://i.postimg.cc/2y2pTmbr/Anna-Karenina.jpg"
                                    alt="">
                            </div>
                            <div class="book-card-info">
                                <p class="book-author">Leo Tolstoy</p>
                                <p class="book-title">Anna Karenina</p>
                                <p class="book-price">£14.90</p>
                            </div>
                        </div>
                        <div class="book-card">
                            <div class="book-card-cover">
                                <img class="book-cover" src="https://i.postimg.cc/2y2pTmbr/Anna-Karenina.jpg"
                                    alt="">
                            </div>
                            <div class="book-card-info">
                                <p class="book-author">Leo Tolstoy</p>
                                <p class="book-title">Anna Karenina</p>
                                <p class="book-price">£14.90</p>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
    @include('layouts.footer')

    <script>
        // //change book preview on click
        // function changePreview(element) {
        //     if (!element.classList.contains('opened-preview')) {
        //         let previews = document.querySelectorAll('.book-img-mini');
        //         let main = document.querySelector('.book-cover');
        //         let toRemove = main.src;
        //         previews.forEach(prev => {
        //             if (prev.src == toRemove) {
        //                 prev.classList.toggle('opened-preview');
        //             }
        //             main.src = element.src;
        //             element.classList.add('opened-preview');

        //         });
        //     }
        // }

        // // scroll through similar books
        // function sideScroll(id, direction) {
        //     scrollAmount = 0;
        //     let element = document.querySelector("." + id);
        //     let speed = 15;
        //     let distance = 300;
        //     let step = 10;
        //     let slideTimer = setInterval(function() {
        //         if (direction == 'left') {
        //             element.scrollLeft -= step;
        //         } else {
        //             element.scrollLeft += step;
        //         }
        //         scrollAmount += step;
        //         if (scrollAmount >= distance) {
        //             window.clearInterval(slideTimer);
        //         }
        //     }, speed);
        // }

        // // quantity input
        // function increaseQty() {
        //     let qtySelector = document.querySelector('.product-qty');
        //     qtySelector.value++;
        // }

        // function decreaseQty() {
        //     let qtySelector = document.querySelector('.product-qty');
        //     if (qtySelector.value > 1) {
        //     qtySelector.value--;}
        // }
    </script>
</body>

</html>
