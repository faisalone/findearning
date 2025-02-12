<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
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
				<a class="nav-link {{ request()->is('dashboard/attributes*') ? 'active' : '' }}" href="{{ route('attributes.index') }}">
					<i class="bi bi-sliders"></i>
					Attributes
				</a>
			</li>
            <!-- Add more menu items here -->
        </ul>
    </div>
</nav>