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
    <div class="wrapper-about">

        <head>
            <meta name = "viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <section class="about-container">
            <div class="about-us">
                <h1 class="text-center">About Us</h1>
                <div class="container flex justify-center items-center ">
                    <div class="content">
                        <h3 class="">Welcome to Flippinpages</h3>
                        <p>At flippinpages, our mission for the site is to create a platform where book enthusiasts would be
                            able to connect others that have similiar interests as them. Here you would be able to find a
                            sense of community with other book enthusiasts.<br>
                            Along with the plethora of books to choose from, we also provide reviews and discussions on the
                            various books you will find throughout the site.
                            This allows you and others to be able to share and see others insights of books, authors and the
                            latest trends. We aim to have both classic and latest literature to cater to a diverse range of
                            readers. </p>
                    </div>
                    <div class="image-section">
                        <img class= "w-full flex justify-center items-center" src="/images/about-us1.jpg" alt="">
                    </div>
                </div>
            </div>
        </section>

        <section class="">
            <div class="about-us">
                <div class="container flex justify-center items-center flex-col">
                    <div class="image-section w-full">
                        <img calss="w-full flex justify-center items-center" src="/images/about-us2.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3 class="">Our Vision</h3>
                        <p>Our vision for flippinpages is to allow you to experience an online community where book
                            enthusiasts like you and others can engage with each other in meaningful discussions, explore
                            new books and connect with like-minded people. </p>
                    </div>
                </div>
            </div>
        </section>


        <section class="">
            <div class="about-us w-full">
                <div class="container flex justify-center items-center flex-col ">
                    <div class="content">
                        <h3 class="">The Founders</h3>
                        <p>Meet the people who have created this platform: <br>
                            <br>
                            Polina Bovykina - Project Leader<br>
                            Joel Campbell - Front-end Developer<br>
                            Mubtasim Bepari - Front-end Developer<br>
                            Nihar Priyadarshi - Back-end Developer<br>
                            Oliver Burnett-Kiernan - Back-end Developer<br>
                            Saiya Begum - Back-end Developer<br>
                            <br>
                            With our combined experiences in literature and technology, we have brought you flippinpages,
                            with the goal of changing the way you discover new books and find other book enthusiasts like
                            you.
                        </p>
                    </div>
                    <div class="image-section w-full">
                        <img class="w-full flex justify-center items-center" src="/images/about-us3.jpg" alt="">
                    </div>
                </div>
            </div>
        </section>
        <section class="">
            <div class="about-us w-full">
                <div class="container flex justify-center items-center flex-col">
                    <div class="content ">
                        <h3 class="">Find Us</h3>
                        <p>Address:</p> <br>
                        <br>
                        WHSmith<br>
                        Steelhouse Ln, Birmingham<br>
                        B4 6NH<br>
                        <br>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="">
            <div class="about-us w-full">
                <div class="container">
                    <div class="content">
                        <div class="image-section">
                            <p><iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9718.706562870428!2d-1.912077069282534!3d52.48499024451066!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4870bde61d75f16b%3A0xf002564bfd828e35!2sWHSmith!5e0!3m2!1sen!2suk!4v1707905131077!5m2!1sen!2suk"
                                    width="800" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe></p>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
