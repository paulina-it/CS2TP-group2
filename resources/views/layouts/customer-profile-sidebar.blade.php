<div class="sidebar">
    <ul>
        <li>
            <a href="{{ route('profile.edit')}}"
            @if (Request::is('profile'))
                class="highlight"
            @endif>
                <img src="https://www.svgrepo.com/show/361411/account.svg" alt="" class="sidebar-icon">
                <p>Main Info</p>
            </a>
        </li>
        <li>
            <a href="{{ route('order.previous')}}"
            @if (Request::is('previous-orders'))
                class="highlight"
            @endif>
                <img src="https://www.svgrepo.com/show/493951/order.svg" alt="" class="sidebar-icon">
                <p>Previous orders</p>
            </a>
        </li>
        <li id="wishlist">
            <a href="{{ route('wishlist')}}"
            @if (Request::is('wishlist'))
                class="highlight"
            @endif>
                <img src="https://www.svgrepo.com/show/361197/heart.svg" alt="" class="sidebar-icon">
                <p>Wishlist</p>
            </a>
        </li>
        <li id="coupons">
            <a href="{{ route('wishlist' )}}"
            @if (Request::is('wishlist'))
                class="highlight"
            @endif>
                <img src="https://www.svgrepo.com/show/428556/coupon.svg" alt="" class="sidebar-icon" id="coupon-icon">
                <p>Coupons</p>
            </a>
        </li>
    </ul>
</div>