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

        <script src="app.js"></script>
      
@endsection