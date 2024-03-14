@extends('layouts.app')
@section('main')
    <div class="wrapper-about mx-[15%] mt-5">
        <h1 class="text-center">About Us</h1>
        <div class="about-section flex mt-[3em]">
            <div class="mr-[3em]">
                <h3>Welcome to Flippinpages</h3>
                <p>At Flippinpages, our mission is to create a platform where book enthusiasts can connect with others who
                    share similar interests. Here, you'll find a vibrant community of fellow book lovers. In addition to a
                    wide selection of books, we offer reviews and discussions to help you explore different literary works
                    and stay updated on the latest trends. Our goal is to provide both classic and contemporary literature
                    to cater to a diverse range of readers.</p>
            </div>
            <img class="w-[20em]" src="/images/about-us1.jpg" alt="">
        </div>
        <div class="about-section flex mt-[3em]">
            <img class="w-[20em] mr-[3em]"
                src="https://images.pexels.com/photos/711009/pexels-photo-711009.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                alt="">
            <div class="">
                <h3>Our Vision</h3>
                <p>Our vision for Flippinpages is to provide an online community where book enthusiasts can engage in
                    meaningful discussions, discover new books, and connect with like-minded individuals.</p>
            </div>
        </div>
        <div class="about-section mt-[3em] text-center bg-amber-50 p-[2em] rounded">
            <h3>The Founders</h3>
            <p>Meet the people behind this platform:<br>
                <br>
                Polina Bovykina - Project Leader<br>
                Mubtasim Bepari - Front-end Developer<br>
                Nihar Priyadarshi - Back-end Developer<br>
                Oliver Burnett-Kiernan - Back-end Developer<br>
                Sayira Begum - Back-end Developer<br>
                <br>
                With our combined experiences in literature and technology, we've created Flippinpages with the aim of
                revolutionizing the way you discover new books and connect with fellow book enthusiasts.
            </p>
        </div>
        <div class="about-section mt-[3em] flex">
            <div class="mr-[3em]">
            <h3>Find Us</h3>
            <p>Address:</p>
            <p>WHSmith<br>
                Steelhouse Ln, Birmingham<br>
                B4 6NH</p>
            </div>

            <div class="image-section">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9718.706562870428!2d-1.912077069282534!3d52.48499024451066!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4870bde61d75f16b%3A0xf002564bfd828e35!2sWHSmith!5e0!3m2!1sen!2suk!4v1707905131077!5m2!1sen!2suk" width="800" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
@endsection
