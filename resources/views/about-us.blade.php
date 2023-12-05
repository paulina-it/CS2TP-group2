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
        <header class="aboutUs">About us - flippinpages</header>
        <p>Welcome to flippinpages, a site developed by a small team for our readers that have interests in books</p>
        <h2 class="mission">Our Mission</h2>
        <p>At flippinpages, our mission for the site is to create a platform where book enthusiasts would be able to connect others that have similiar interests as them. Here you would be able to find a sense of community with other book enthusiasts.<br> Along with the plethora of books to choose from, we also provide reviews and discussions on the various books you will find throughout the site. This allows you and others to be able to share and see others insights  of books, authors and the latest trends. We aim to have both classic and latest literature to cater to a diverse range of readers. </p>
        <h2 class="team">Our Team</h2>
        <p>Meet the small development team that have worked on the project for the creation of this platform</p>
        <ul class="project-members">
        <p>Project Leader: Polina Bovykina</p>
        <p>Front-end Developers: Gurvir Brar, Akash Bhatti, Mubtasim Bepari, Joel Campbell</p>
        <p>Back-end Developers: Oliver Burnett-Kiernan, Sayira Begum, Nihar Priyadarshi</p>
        </ul>

      @include('layouts.footer')
    </body>
    
</html>