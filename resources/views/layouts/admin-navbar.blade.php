<div class="desktop-nav flex flex-col">
    <!-- Logo -->
    <div class="top-bar flex justify-between" id="admin-top-navbar">
        <div class="shrink-0 flex items-center flex">
            <a href="{{ route('home') }}" class="flex">
                <img id="nav-logo" src="https://i.postimg.cc/2SKjcxtT/No-text-black-logo.png" alt=""
                    class="mr-5">
                <h2 class="text-black text-xl m-auto">flippinpages</h2>
            </a>
        </div>
        <div class="account-nav flex">
            <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('edit')">
                {{-- {{ __('Profile') }} --}}
                <img src="https://www.svgrepo.com/show/361411/account.svg" alt="" class="nav-icon">
            </x-nav-link>
            <x-nav-link data-modal-toggle="modal-logout" data-modal-target="modal-logout" class="mt-2.5 pb-2.5">
                <img src="https://www.svgrepo.com/show/502760/logout.svg" alt="" class="nav-icon">
            </x-nav-link>
        </div>
    </div>
    <!-- Navigation Links -->
    <div class="nav-links flex justify-between sm:hidden" id="admin-navbar">
        <x-nav-link :href="route('home')" id="customer-nav-link">
            <p>Customer View</p>
        </x-nav-link>
        <div class="nav-links-main">
            <x-nav-link :href="route('admin-dashboard')">
                <p class="nav-link-text">Dashboard</p>
            </x-nav-link>
            <x-nav-link :href="route('admin-books')">
                <p>Books</p>
            </x-nav-link>
            <x-nav-link :href="route('admin-orders')">
                <p>Orders</p>
            </x-nav-link>
            <x-nav-link :href="route('admin-dashboard')">
                <p>Users</p>
            </x-nav-link>
            <x-nav-link :href="route('queries')">
                <p>Queries</p>
            </x-nav-link>
        </div>
    </div>

</div>
