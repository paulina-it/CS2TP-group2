<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" /> 
</head>
<body>
    <div class="container-fluid border">

        <!-- First Nav Bar -->
        <nav class="navbar navbar-expand-lg navbar-dark custom-navbar1">
            <div class="container-fluid">
              <a class="navbar-brand" href="home.html">
                <img src="/Images/logo.png" alt="" width="200" height="70" class="d-inline-block align-text-top">
                <!-- GameStation  -->
              </a>
              
                <!-- <form class="d-flex"> -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="about.html">About Us</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-regular fa-user"></i> Login/ Register</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link"><i class="fas fa-shopping-cart"></i></i></a>
                      </li>
                    </ul>
                </div>
                <!-- </form>  -->
            </div>
          </nav>

    
        
          <!-- Second Navigation Bar includes Search -->
          <nav class="navbar navbar-expand-lg navbar-dark custom-navbar2">
            <div class="container-fluid">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#"> Books</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#"> New </a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Stationary & Gifts
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#"> Special Editions </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#"> Our Favourites </a>
                  </li>
                </ul>
                <form class="d-flex search-form">
                  <input class="form-control me-2 search-input" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success search-btn"  type="submit">Search</button>
                </form>
              </div>
            </div>
          </nav>
          <!--  End of Search Tab -->

          <!-- Game station Banner -->
        <video loop autoplay muted class="video">
            <source src="Videos/GameStationWebsite2.mp4" type="video/mp4">
            <!-- <source src="movie.ogg" type="video/ogg"> -->
            Your browser does not support the video tag.
        </video>

        <!-- Gaming Adverts carousel -->
        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active" data-bs-interval="2000">
                <img src="Images/1.png" class="d-block w-100" alt="...">
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

        <!-- Trending Deals  -->
        <div class="category_block_header">
          <h2> New Upcoming Releases  </h2>
         </div>
        
        <div class="row row-cols-2 row-cols-md-4 g-4 trend-card">
            <div class="col">
              <div class="card h-100">
                <img src= Images/product1.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Atomic Hearts £50</h5>
                  <p class="card-text">Format: PlayStation 5 | Age Rating: PEGI-18 <br>
                    Stock status: In Stock <br>
                    Delivery: FREE UK Royal Mail 1st Class delivery on this item.</p>
                  <a href="#" class="btn btn-primary">Buy Now</a>
                </div>
                <div class="card-footer">
                  <small class="text-muted">Last updated 3 mins ago</small>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100">
                <img src=Images/product2.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Scars Above  £45</h5>
                  <p class="card-text">Format: PlayStation 5 | Age Rating: PEGI-16 <br>
                    Stock status: In Stock <br>
                    Delivery: FREE UK Royal Mail 1st Class delivery on this item.</p>
                  <a href="#" class="btn btn-primary">Buy Now</a>
                </div>
                <div class="card-footer">
                  <small class="text-muted">Last updated 3 mins ago</small>
                </div>
              </div>
            </div>
            <div class="col">
                <div class="card h-100">
                  <img src=Images/product3.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">The Legend of Zelda  £65</h5>
                    <p class="card-text">Format: PlayStation 5 | Age Rating: PEGI-16 <br>
                      Stock status: In Stock <br>
                      Delivery: FREE UK Royal Mail 1st Class delivery on this item.</p>
                    <a href="#" class="btn btn-primary">Buy Now</a>
                </div>
                  <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                  </div>
                </div>
              </div>
            <div class="col">
              <div class="card h-100">
                <img src=Images/44454_sm.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">HOGWARTS Legacy £110</h5>
                  <p class="card-text">Format: Xbox Series X | S | Publisher: Warner | Age Rating: PEGI-16 <br>
                    Stock status: In Stock <br>
                    Delivery: FREE UK Royal Mail 1st Class delivery on this item </p>
                  <a href="#" class="btn btn-primary">Buy Now</a>
                </div>
                <div class="card-footer">
                  <small class="text-muted">Last updated 3 mins ago</small>
                </div>
              </div>
            </div>
          </div>

            <!-- Categories Image Links -->
            <div class="category_block_header">
              <h2>Authors</h2>
             </div>
              <div class="category_block">
                  <ul class="categories">
                      <li class="category">
                          <a href="#"> 
                          <img src=Images/VideoGame.jpeg" alt="">
                          JK Rowling
                          </a>
                          
                      </li>
                      <li class="category">
                          <a href="#"> 
                              <img src=Images/download.jpeg" alt="">
                            Stephen King 
                          </a>
                         
                      </li>
                      <li class="category">
                          <a href="#"> 
                          <img src=Images/images.jpeg" alt="">
                          Dan Brown
                          </a>
                      </li>
                      <li class="category">
                          <a href="#"> 
                              <img src=Images/OIP.jpeg" alt="">
                            John Green 
                          </a>
                      </li>
                      <li class="category">
                          <a href="#"> 
                              <img src=Images/consol.jpg" alt="">
                              Neil Gaiman 
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
        
        
        
        <!-- Footer -->
        <footer class="bg-dark text-center text-white footer1" >
            <!-- Grid container -->
            
        
            <!-- Section: Links -->
            <section class="myfooter">
                <!--Grid row-->
                <div class="row">
                <!--Grid column-->
                <div class="col-lg-5 col-md-4 mb-4 mb-md-0 links">
                    <h5 class="text-uppercase">Links</h5>
        
                    <ul class="list-unstyled mb-0">
                    <li>
                        <a href="#!" class="text-white">Home</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">About Us</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">Products</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">Login</a>
                    </li>
                    </ul>
                </div>
                <!--Grid column-->
                <div class="col-lg-7 col-md-8 mb-4 mb-md-0">
                    <div class="container p-4">
                        <!-- Section: Social media -->
                        <section class="mb-4">
                            <!-- Facebook -->
                            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
                            ><i class="fab fa-facebook-f"></i
                            ></a>
                    
                            <!-- Twitter -->
                            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
                            ><i class="fab fa-twitter"></i
                            ></a>
                    
                            <!-- Google -->
                            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
                            ><i class="fab fa-google"></i
                            ></a>
                    
                            <!-- Instagram -->
                            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
                            ><i class="fab fa-instagram"></i
                            ></a>
                    
                            <!-- Linkedin -->
                            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
                            ><i class="fab fa-linkedin-in"></i
                            ></a>
                    
                        </section>
                        <!-- Section: Social media -->
                    
                        <!-- Section: Form -->
                        <section class="">
                            <form action="">
                            <!--Grid row-->
                            <div class="row d-flex justify-content-center">
                                <!--Grid column-->
                                <div class="col-auto">
                                <p class="pt-2">
                                    <strong>Sign up to our newsletter</strong>
                                </p>
                                </div>
                                <!--Grid column-->
                    
                                <!--Grid column-->
                                <div class="col-md-5 col-12">
                                <!-- Email input -->
                                <div class="form-outline form-white mb-4">
                                    <input type="email" id="form5Example21" class="form-control" />
                                    <label class="form-label" for="form5Example21">Email address</label>
                                </div>
                                </div>
                                <!--Grid column-->
                    
                                <!--Grid column-->
                                <div class="col-auto">
                                <!-- Submit button -->
                                <button type="submit" class="btn btn-outline-light mb-4">
                                    Subscribe
                                </button>
                                </div>
                                <!--Grid column-->
                            </div>
                            <!--Grid row-->
                            </form>
                        </section>
                        <!-- Section: Form -->
                    
                        <!-- Section: Text -->
                        <section class="mb-4">
                            <p>
                              Thank you for visiting our website !  Please checkout our products and get the most exclusive and Books at the best and most affordable prices !
                           
                            </p>
                        </section>
                        <!-- Section: Text -->

                </div>

        
                
                <!--Grid column-->
                </div>
                <!--Grid row-->
                <!-- Copyright -->
                <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2023 Copyright:
                <a class="text-white" href="#">FlippinPages</a>
                </div>
                <!-- Copyright -->

            </section>
            <!-- Section: Links -->
            </div>
            <!-- Grid container -->
        
        </footer>
        <!-- Footer -->
      </div>
    </div>
            
           
    
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
</body>
</html>