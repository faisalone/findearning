<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('index') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="{{ asset('assets/images/fav.png') }}" alt="Findearning" width="50">
        </div>
        <div class="sidebar-brand-text mx-3">Findearning</div>
    </a>
    
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Dashboard accessible by all users -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    
    <!-- Conditional Nav Items -->
    @if(auth()->user()->role)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('products.index') }}">
                <i class="fas fa-fw fa-cubes"></i>
                <span>Products</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('categories.index') }}">
                <i class="fas fa-fw fa-tags"></i>
                <span>Categories</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('orders.index') }}">
                <i class="fas fa-fw fa-shopping-cart"></i>
                <span>Orders</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('wallet') }}">
                <i class="fas fa-fw fa-wallet"></i>
                <span>eWallet Recharges</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('reviews.index') }}">
                <i class="fas fa-fw fa-star"></i>
                <span>Product Reviews</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('pages.index') }}">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Pages</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('customers') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Customers</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('sliders.index') }}">
                <i class="fas fa-fw fa-sliders-h"></i>
                <span>Sliders</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('payment-methods.index') }}">
                <i class="fas fa-fw fa-credit-card"></i>
                <span>Payment Methods</span>
            </a>
        </li>
        <!-- New Settings Menu -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('settings.index') }}">
                <i class="fas fa-fw fa-cog"></i>
                <span>Settings</span>
            </a>
        </li>
    @else
        <li class="nav-item">
            <a class="nav-link" href="{{ route('myProfile') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>My Profile</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('myOrders') }}">
                <i class="fas fa-fw fa-shopping-bag"></i>
                <span>My Orders</span>
            </a>
        </li>
    @endif
    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    
    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
