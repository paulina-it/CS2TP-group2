<footer class="flex w-100 justify-around content-center">
    <img src="https://i.postimg.cc/ncnLCr7K/Logo-in-colour-white-outline.png" alt="" class="footer-logo">
    <div class="footer-info flex">
        <div class="footer-discovery footer-section flex flex-col">
            <h3 class="footer-title">Discovery</h3>
            <a href="{{ route('home').'#new-books' }}">New books</a>
            <a href="{{ route('home').'#languages' }}">New languages</a>
            <a href="{{ route('home') }}">Most sold</a>
        </div>
        <div class="footer-about footer-section flex flex-col">
            <h3 class="footer-title">About</h3>
            <a href="{{ route('about-us') }}">About company</a>
            <a href="{{ route('contact.show') }}">Contact us</a>
        </div>
        {{-- <div class="footer-info footer-section flex flex-col">
            <h3 class="footer-title">Info</h3>
            <a href="">Help</a>
            <a href="">Shipping</a>
            <a href="">Terms & Conditions</a>
        </div> --}}
    </div>
</footer>
