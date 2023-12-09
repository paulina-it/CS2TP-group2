<nav>
    <!-- Primary Navigation Menu -->
    <div class="primary-nav">
        {{-- <div class="flex h-16"> --}}
        <div class="desktop-nav flex flex-col">
            <!-- Logo -->
            <div class="top-bar flex justify-between">
                <div class="shrink-0 flex items-center flex">
                    <a href="{{ route('home') }}" class="flex">
                        <img id="nav-logo" src="https://i.postimg.cc/2SKjcxtT/No-text-black-logo.png" alt="" class="mr-5">
                        <h2 class="text-black text-xl m-auto">flippinpages</h2>
                    </a>
                </div>
                <div class="account-nav flex">
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        {{-- <p>Wishlist</p> --}}
                        <img src="https://www.svgrepo.com/show/361197/heart.svg" alt="" class="nav-icon">
                    </x-nav-link>
                    <x-nav-link :href="route('basket')" :active="request()->routeIs('basket')">
                        {{-- <p>Basket</p> --}}
                        <img src="https://www.svgrepo.com/show/506558/shopping-cart.svg" alt=""
                            class="nav-icon">
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
                        <x-nav-link :href="route('profile.edit')"  :active="request()->routeIs('edit')">
                            {{-- {{ __('Profile') }} --}}
                            <img src="https://www.svgrepo.com/show/361411/account.svg" alt="" class="nav-icon">
                        </x-nav-link>
                        <form method="POST" action="{{ route('logout') }}" class="m-0 ">
                            @csrf
                            <x-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="mt-2.5 pb-2.5">
                                <img src="https://www.svgrepo.com/show/502760/logout.svg" alt="" class="nav-icon">
                            </x-nav-link>
                        </form>
                    @endguest
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="nav-links flex justify-between sm:hidden">
                <div class="nav-links-main">
                    <x-nav-link :href="route('home')">
                        <p class="nav-link-text">Home</p>
                    </x-nav-link>
                    {{-- <x-nav-link :href="route('languages')">
                        <p>Languages</p>
                    </x-nav-link> --}}
                    <x-nav-link :href="route('books.index')">
                        <p>Books</p>
                    </x-nav-link>
                    <x-nav-link :href="route('about-us')">
                        <p>About Us</p>
                    </x-nav-link>
                    <x-nav-link :href="route('contact.show')">
                        <p>Contact Us</p>
                    </x-nav-link>
                </div>
                <div class="nav-search">
                    <form action="{{ route('books.index') }}" method="GET">
                        <label for="default-search" class="sr-only">Search</label>
                        <div class="relative mt-0">
                            <input name="search" type="search" id="default-search"
                                class="block w-full text-sm text-gray-400 rounded-lg" placeholder="Search for books..."
                                required>
                            <button type="submit"
                                class="search-btn text-white absolute bg-white font-medium rounded-lg text-sm px-2">
                                <img src="https://www.svgrepo.com/show/532555/search.svg" alt=""
                                    class="nav-icon">
                            </button>
                        </div>
                        {{-- @if (!empty($search))
                            <label style="color: black">Search results for {{ $search }}</label><br>
                            <a style="color: black" href="{{ route('books.index') }}">Clear Search</a>
                        @endif --}}
                    </form>
                </div>
            </div>
        </div>


        <!-- Hamburger -->
        <div class="mobile-nav icon -mr-2 flex items-center sm:hidden">
            <div class="shrink-0 flex items-center flex">
                <a href="{{ route('home') }}" class="flex">
                    <img id="nav-logo" src="/images/No text black logo.png" alt="" class=" mr-5">
                </a>
            </div>
            <button id="toggleButton"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 
                dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                <svg class="hidden h-6 w-6" id="iconClose" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"
                    fill="#000000">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <defs>
                            <style>
                                .cls-1 {
                                    fill: none;
                                    stroke: #3f3f3f;
                                    stroke-linecap: round;
                                    stroke-linejoin: round;
                                    stroke-width: 2px;
                                }
                            </style>
                        </defs>
                        <title></title>
                        <g id="cross">
                            <line class="cls-1" x1="7" x2="25" y1="7" y2="25"></line>
                            <line class="cls-1" x1="7" x2="25" y1="25" y2="7"></line>
                        </g>
                    </g>
                </svg>
                <svg id="iconOpen" class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path id="path1" class="inline-flex" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path id="path2" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>

            </button>
            <div class="nav-search">
                <form action="{{ route('books.index') }}" method="GET">
                    <label for="default-search" class="sr-only">Search</label>
                    <div class="relative mt-0">
                        <input name="search" type="search" id="default-search"
                            class="block w-full text-sm text-gray-400 rounded-lg" placeholder="Search for books..."
                            required>
                        <button type="submit"
                            class="search-btn text-white absolute bg-white font-medium rounded-lg text-sm px-2">
                            <img src="https://www.svgrepo.com/show/532555/search.svg" alt=""
                                class="nav-icon">
                        </button>
                    </div>
                    @if (!empty($search))
                        <label style="color: black">Search results for {{ $search }}</label><br>
                        <a style="color: black" href="{{ route('books.index') }}">Clear Search</a>
                    @endif
                </form>
            </div>
            <x-nav-link :href="route('profile.edit')">
                {{-- {{ __('Profile') }} --}}
                <img src="https://www.svgrepo.com/show/361411/account.svg" alt="" class="nav-icon">
            </x-nav-link>
            <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{-- <p>Cart</p> --}}
                <img src="https://www.svgrepo.com/show/506558/shopping-cart.svg" alt="" class="nav-icon">
            </x-nav-link>
            <div id="menu" class="mobile-nav-link-div hidden lg:flex">
                <ul class="lg:flex space-x-4">
                    <li class="mobile-nav-link"><a class="" href=" {{ route('home') }} "
                            :active="request() - > routeIs('home')">Home</a></li>
                    <li class="mobile-nav-link"><a class="" href=" {{ route('books.index') }} ">Books</a></li>
                    <li class="mobile-nav-link"><a class="" href=" {{ route('about-us') }} ">About Us</a></li>
                    <li class="mobile-nav-link"><a class="" href=" {{ route('contact.show') }} ">Contact Us</a></li>
                </ul>
            </div>

        </div>
    </div>

</nav>
