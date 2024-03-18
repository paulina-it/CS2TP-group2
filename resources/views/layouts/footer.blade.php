<footer class="flex w-100 justify-around content-center">
    <img src="https://i.postimg.cc/ncnLCr7K/Logo-in-colour-white-outline.png" alt="" class="footer-logo">
    <div class="footer-info flex">
        <div class="footer-discovery footer-section flex flex-col">
            <h2 class="footer-title">Discovery</h2>
            <a href="{{ route('home').'#new-books' }}">New books</a>
            <a href="{{ route('home').'#languages' }}">New languages</a>
            <a href="{{ route('home') }}">Most sold</a>
        </div>
        <div class="footer-about footer-section flex flex-col">
            <h2 class="footer-title">About</h2>
            <a href="{{ route('about-us') }}">About company</a>
            <a href="{{ route('contact.show') }}">Contact us</a>
        </div>
    </div>
</footer>
