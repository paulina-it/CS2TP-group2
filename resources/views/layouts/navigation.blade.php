<nav>
    <!-- Primary Navigation Menu -->
    <div class="primary-nav">
        @if (str_contains(Request::url(), 'admin') || str_contains(Request::url(), 'edit') || str_contains(Request::url(), 'create'))
            @include('layouts.admin-navbar')
        @else
            @include('layouts.customer-navbar')
        @endif
    </div>


    @include('layouts.mobile-navbar')

</nav>
