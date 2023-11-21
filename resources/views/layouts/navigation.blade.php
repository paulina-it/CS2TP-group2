<nav x-data="{ open: false }">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- <div class="flex h-16"> --}}
        <div class="flex justify-between">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('home') }}">
                    <img id="nav-logo" src="/images/No text black logo.png" alt="">
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="nav-links hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    {{-- <p>Home</p> --}}
                    <img src="https://www.svgrepo.com/show/361198/home.svg" alt="" class="nav-icon">
                </x-nav-link>
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    {{-- <p>Discover</p> --}}
                    <img src="https://www.svgrepo.com/show/361091/compass.svg" alt="" class="nav-icon">
                </x-nav-link>
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    {{-- <p>Wishlist</p> --}}
                    <img src="https://www.svgrepo.com/show/361197/heart.svg" alt="" class="nav-icon">
                </x-nav-link>
                @guest
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        {{-- <p>Account</p> --}}
                        <img src="https://www.svgrepo.com/show/361411/account.svg" alt="" class="nav-icon">
                    </x-nav-link>
                @else
                    <x-dropdown-link :href="route('profile.edit')">
                        {{-- {{ __('Profile') }} --}}
                        <img src="https://www.svgrepo.com/show/361411/account.svg" alt="" class="nav-icon">
                        </x-nav-link>
                @endguest
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    {{-- <p>Cart</p> --}}
                    <img src="https://www.svgrepo.com/show/506558/shopping-cart.svg" alt=""
                        class="nav-icon">
                </x-nav-link>
            </div>
            
            
            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

</nav>
