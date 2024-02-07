<div class="sidebar">
    <ul>
        <li>
            <a href="">
                <img src="https://www.svgrepo.com/show/533406/book.svg" alt="Book Icon" class="sidebar-icon">
                <p class="font-semibold">Book Inventory</p>
            </a>
        </li>
        <ul>
            <li class="sub-list-item">
                <a href="{{ route('books.create') }}" @if (Request::is('books.create')) class="highlight" @endif>
                    <img src="https://www.svgrepo.com/show/521942/add-ellipse.svg" alt="Add Icon"
                        class="sidebar-icon">
                    <p>Add Books</p>
                </a>
            </li>
            <li class="sub-list-item">
                <a href="{{ route('admin-books') }}" @if (Request::is('admin-books')) class="highlight" @endif>
                    <img src="https://www.svgrepo.com/show/521620/edit.svg" alt="Add Icon"
                        class="sidebar-icon">
                    <p>Edit or Delete Books</p>
                </a>
            </li>
        </ul>
        <li>
            <a href="{{ route('previous-orders') }}" @if (Request::is('previous-orders')) class="highlight" @endif>
                <img src="https://www.svgrepo.com/show/532378/user-pen-alt.svg" alt="User Icon" class="sidebar-icon">
                <p class="font-semibold">User Management</p>
            </a>
        </li>
        <li>
            <a href="{{ route('wishlist') }}" @if (Request::is('wishlist')) class="highlight" @endif>
                <img src="https://www.svgrepo.com/show/383791/parcel.svg" alt="Orders Icon" class="sidebar-icon">
                <p class="font-semibold">Order Management</p>
            </a>
        </li>
        <li>
            <a href="{{ route('wishlist') }}" @if (Request::is('wishlist')) class="highlight" @endif>
                <img src="https://www.svgrepo.com/show/340875/query.svg" alt="Query Icon" class="sidebar-icon">
                <p class="font-semibold">User Queries</p>
            </a>
        </li>
        <li>
            <a href="{{ route('wishlist') }}" @if (Request::is('wishlist')) class="highlight" @endif>
                <img src="https://www.svgrepo.com/show/381827/report-analytics-business-office.svg" alt="Query Icon" class="sidebar-icon">
                <p class="font-semibold">Reports</p>
            </a>
        </li>
    </ul>
</div>
