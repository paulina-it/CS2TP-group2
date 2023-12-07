<!DOCTYPE html>
<html>
    <head>
        <meta charset ="utf-8">
        <title>About us</title>
        <link rel="stylesheet" href="\CS2TP-group2\resources\assets\sass\components\_aboutUs.scss">
        @vite(['resources/assets/sass/app.scss', 'resources/assets/js/app.js'])
    </head>
    <body>
      @include('layouts.navigation')
        <section>
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
      
    </body>
    @include('layouts.footer')
</html>