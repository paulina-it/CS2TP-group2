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
        <head>
          <meta name = "viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <section class="about-container">
          <div class="about-us">
            <h1>About Us</h1>
            <div class="container">
              <div class="content">
                <h3>Welcome to Flippinpages</h3>
                <p>At flippinpages, our mission for the site is to create a platform where book enthusiasts would be able to connect others that have similiar interests as them. Here you would be able to find a sense of community with other book enthusiasts.<br> 
                Along with the plethora of books to choose from, we also provide reviews and discussions on the various books you will find throughout the site. 
                This allows you and others to be able to share and see others insights  of books, authors and the latest trends. We aim to have both classic and latest literature to cater to a diverse range of readers. </p>
              </div>
              <div class="image-section">
                <img src="/images/about-us1.jpg" alt="">
              </div>
            </div>
          </div>
        </section>

        <section class="about-container">
          <div class="about-us">
            <div class="container">
            <div class="image-section">
                <img src="/images/about-us2.jpg" alt="">
              </div>
              <div class="content">
              <h3>Our Vision</h3>
                <p>Our vision for flippinpages is to allow you to experience an online community where book enthusiasts like you and others can engage with each other in meaningful discussions, explore new books and connect with like-minded people. </p>
              </div>
            </div>
          </div>
        </section>


        <section class="about-container">
          <div class="about-us">
            <div class="container">
              <div class="content">
              <h3>The Founders</h3>
                <p>Meet the people who have created this platform: <br>
                <br>
                Polina Bovykina - Project Leader<br>
                Joel Campbell - Front-end Developer<br>
                Mubtasim Bepari - Front-end Developer<br>
                Nihar Priyadarshi - Back-end Developer<br>
                Oliver Burnett-Kiernan - Back-end Developer<br>
                Saiya Begum - Back-end Developer<br>
                <br>
                With our combined experiences in literature and technology, we have brought you flippinpages with the goal of changing the way you discover new books and find other book enthusiasts like you.
              </p>
              </div>
              <div class="image-section">
                <img src="/images/about-us3.jpg" alt="">
              </div>
            </div>
          </div>
        </section>

        <script src="app.js"></script>
      
@endsection