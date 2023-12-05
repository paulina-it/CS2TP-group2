<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="\CS2TP-group2\resources\assets\sass\components\_shoppingCart.scss">
    @vite(['resources/assets/sass/app.scss', 'resources/assets/js/cart.js'])
</head>
<body>
@include('layouts.navigation')
    <div class="container-fluid border">
        <!-- First Nav Bar -->
        {{-- <nav class="navbar navbar-expand-lg navbar-dark custom-navbar1"> --}}
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

    
        
    <div class="container">
        <header>
            <h1>Shopping Cart</h1>
            <div class="shopping">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
            </svg>
                <span class="quantity">0</span>
            </div>
        </header>
        <div class="list"></div>
    </div>
    <div class="card">
        <h1>Card</h1>
        <ul class="listCard"></ul>
        <div class="checkout">
            <div class="total">0</div>
            <div class="closeShopping">Close</div>
        </div>
    </div>

    <script src="app.js"></script>
</body>
</html>