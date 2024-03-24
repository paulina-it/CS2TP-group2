<div class="desktop-nav flex flex-col">
    <!-- Logo -->
    <div class="top-bar flex justify-between">
        <div class="shrink-0 flex items-center flex">
            <a href="{{ route('home') }}" class="flex">
                <img id="nav-logo" src="https://i.postimg.cc/2SKjcxtT/No-text-black-logo.png" alt=""
                    class="mr-5">
                <h2 class="text-black text-xl m-auto">flippinpages</h2>
            </a>
        </div>
        <div class="account-nav flex">
            @guest
            @else
                <x-nav-link :href="route('wishlist')" :active="request()->routeIs('wishlist')">
                    {{-- <p>Wishlist</p> --}}
                    <img src="https://www.svgrepo.com/show/361197/heart.svg" alt="" class="nav-icon">
                </x-nav-link>
            @endguest
            <x-nav-link :href="route('basket')" :active="request()->routeIs('basket')">
                {{-- <p>Basket</p> --}}
                <img src="https://www.svgrepo.com/show/506558/shopping-cart.svg" alt="" class="nav-icon"
                    id="basket-icon">
                <div class="basket-quantity">
                    <span class="qunatity-number">{{ Session::get('basket_qty') }}</span>
                </div>
            </x-nav-link>
            @guest
                <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    {{-- <p>Account</p> --}}
                    <p class="auth-btn login">Login</p>
                </x-nav-link>
                <x-nav-link class="" :href="route('register')" :active="request()->routeIs('register')">
                    {{-- <p>Account</p> --}}
                    <p class="auth-btn signup">Signup</p>
                </x-nav-link>
            @else
                <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('edit')">
                    {{-- {{ __('Profile') }} --}}
                    <img src="https://www.svgrepo.com/show/361411/account.svg" alt="" class="nav-icon">
                </x-nav-link>

                <x-nav-link data-modal-toggle="modal-logout" data-modal-target="modal-logout" class="mt-2.5 pb-2.5">
                    <img src="https://www.svgrepo.com/show/502760/logout.svg" alt="" class="nav-icon">
                </x-nav-link>
            @endguest
        </div>
    </div>
    <!-- Navigation Links -->
    <div class="nav-links flex justify-between sm:hidden">
        @if (Auth::check() && Auth::user()->role == 'admin')
            <x-nav-link :href="route('admin-dashboard')" id="admin-nav-link">
                <p>Admin Dashboard</p>
            </x-nav-link>
        @endif
        <div class="nav-links-main">
            <x-nav-link :href="route('home')">
                <p class="nav-link-text">Home</p>
            </x-nav-link>
            <x-nav-link :href="route('books.index', ['category_slug' => 'null'])">
                <p>Books</p>
            </x-nav-link>
            <x-nav-link :href="route('about-us')">
                <p>About Us</p>
            </x-nav-link>
            <x-nav-link :href="route('contact.show')">
                <p>Contact Us</p>
            </x-nav-link>
        </div>
        <div class="nav-search p-2">
            <form action="{{ route('books.index') }}" method="GET" class="m-0">
                @csrf
                <label for="default-search" class="sr-only">Search</label>
                <div class="relative mt-0">
                    <input name="search" type="search" id="default-search"
                        class="block w-full text-sm text-gray-800 rounded-lg" placeholder="Search for books..." required
                        @if (session()->get('search') !== null) value="{{ session()->get('search') }}" @endif>

                    <button type="submit"
                        class="search-btn text-white absolute bg-white font-medium rounded-lg text-sm px-2">
                        <img src="https://www.svgrepo.com/show/532555/search.svg" alt="" class="nav-icon">
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
