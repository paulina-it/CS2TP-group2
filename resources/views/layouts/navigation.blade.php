<nav>
    <!-- Primary Navigation Menu -->
    <div class="primary-nav">
        @if (str_contains(Request::url(), 'admin'))
            @include('layouts.admin-navbar')
        @else
            @include('layouts.customer-navbar')
        @endif
    </div>


    @include('layouts.mobile-navbar')

</nav>
