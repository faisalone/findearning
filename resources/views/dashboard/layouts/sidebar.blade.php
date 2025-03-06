<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            @if(auth()->user()->role)
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ url('/dashboard') }}">
                    <i class="bi bi-house-door"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard/products*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                    <i class="bi bi-box"></i>
                    Products
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard/categories*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                    <i class="bi bi-tags"></i>
                    Categories
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard/orders*') ? 'active' : '' }}" href="{{ route('orders.index') }}">
                    <i class="bi bi-receipt"></i>
                    Orders
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard/wallet*') ? 'active' : '' }}" href="{{ route('wallet') }}">
                    <i class="bi bi-wallet2"></i>
                    eWallet Recharges
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard/pages*') ? 'active' : '' }}" href="{{ route('pages.index') }}">
                    <i class="bi bi-file-earmark-text"></i>
                    Pages
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard/customers*') ? 'active' : '' }}" href="{{ route('customers') }}">
                    <i class="bi bi-people"></i>
                    Customers
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard/sliders*') ? 'active' : '' }}" href="{{ route('sliders.index') }}">
                    <i class="bi bi-sliders"></i>
                    Sliders
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard/payment-methods*') ? 'active' : '' }}" href="{{ route('payment-methods.index') }}">
					<i class="bi bi-credit-card"></i>
                    Payment Methods
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard/contact*') ? 'active' : '' }}" href="{{ route('contact.index') }}">
                    Messages
                </a>
            </li>

            @else
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard/my-profile*') ? 'active' : '' }}" href="{{ route('myProfile') }}">
                    <i class="bi bi-person"></i>
                    My Profile
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard/my-orders*') ? 'active' : '' }}" href="{{ route('myOrders') }}">
                    <i class="bi bi-receipt"></i>
                    My Orders
                </a>
            </li>
            @endif
        </ul>
    </div>
</nav>