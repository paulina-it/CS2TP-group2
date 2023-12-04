<!DOCTYPE html>
<html lang="en">

<head>
  @vite(['resources/assets/sass/app.scss', 'resources/js/app.js'])
  @include('layouts.navigation')


  <head>
    <link rel="stylesheet" href="resources/assests/css/homepage.css" >

    <!-- Include Bootstrap CSS -->
    <link href="path/to/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Include Bootstrap JS -->
    <script src="path/to/bootstrap/js/bootstrap.bundle.min.js"></script>
  </head>

<body>

  <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active" data-bs-interval="2000">
        <img src="images/Advertisement1.jpeg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item" data-bs-interval="2000">
        <img src="Images/2.png" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item" data-bs-interval="2000">
        <img src="Images/3.png" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

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
</body>

</html>


<!-- Trending  -->
<div class="category_block_header">
  <h2> Trending </h2>
</div>
<div class="row row-cols-2 row-cols-md-4 g-4 trend-card">
  <div class="col">
    <div class="card h-100">
      <img src="Images/product1.jpg class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">1</h5>
        <p class="card-text">2 <br>
          2 <br>
          3</p>
        <a href="#" class="btn btn-primary">Buy Now</a>
      </div>
      <div class="card-footer">
        <small class="text-muted">Last updated 3 mins ago</small>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img src="Images/product2.jpg" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">1</h5>
        <p class="card-text">2<br>
          2<br>
          3</p>
        <a href="#" class="btn btn-primary">5</a>
      </div>
      <div class="card-footer">
        <small class="text-muted">Last updated 3 mins ago</small>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img src="Images/product3.jpg" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">1</h5>
        <p class="card-text">2<br>
          3<br>
          4</p>
        <a href="#" class="btn btn-primary">Buy Now</a>
      </div>
      <div class="card-footer">
        <small class="text-muted">Last updated 3 mins ago</small>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img src="Images/44454_sm.jpg" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">1</h5>
        <p class="card-text">2<br>
          3 <br>
          4</p>
        <a href="#" class="btn btn-primary">Buy now</a>
      </div>
      <div class="card-footer">
        <small class="text-muted">Last updated 3 mins ago</small>
      </div>
    </div>
  </div>
</div>

<!-- Categories Image Links -->
<div class="category_block_header">
  <h2>Languages</h2>
</div>
<div class="category_block">
  <ul class="categories">
    <li class="category">
      <a href="#">
        <img src=Images/JK.jpeg" alt="">
      Punjabi
      </a>

    </li>
    <li class="category">
      <a href="#">
        <img src=Images/download.jpeg" alt="">
      Polish
      </a>

    </li>
    <li class="category">
      <a href="#">
        <img src=Images/images.jpeg" alt="">
      Romanian 
      </a>
    </li>
    <li class="category">
      <a href="#">
        <img src=Images/OIP.jpeg" alt="">
      Urdu
      </a>
    </li>
    <li class="category">
      <a href="#">
        <img src=Images/consol.jpg" alt="">
      Latin
      </a>
    </li>
    <li class="category">
      <a href="#">
        <img src=Images/consol.jpg" alt="">
      
      </a>
    </li>
  </ul>
</div>

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

</footer>
<!-- Footer -->
</div>
</div>

@include('layouts.footer')

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
</body>

</html>