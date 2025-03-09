<header id="rtsHeader">
	<div class="navbar-wrapper">
		<div class="navbar-part navbar-part3 navbar-part4">
			<div class="container">
				<div class="navbar-inner navbar-inner5">
					<div class="navbar-search-area">
						<form action="{{ route('shop.search') }}" method="GET">
							<div class="search-input-inner">
								<div class="input-div">
									<button type="submit" class="search-input-icon"><i class="rt-search mr--10"></i> Search</button>
									<input class="search-input input5" type="text" name="query" value="{{ request('query') }}" placeholder="Keyword here...">
								</div>
							</div>
						</form>
					</div>
					<a href="{{ route('index') }}" class="logo">
						<img src="{{ asset('assets/images/logo-findearning.svg') }}" class="w-75" alt="logo">
					</a>
					<div class="navbar-select-area">
						
					</div>
					<div class="header-action-items header-action-items1">
						<div class="search-part">
                            <div class="search-icon action-item icon"><i class="rt-search"></i></div>
                            <div class="search-input-area">
                                <div class="container">
                                    <div class="search-input-inner">
                                        <div class="input-div">
                                            <form action="{{ route('shop.search') }}" method="GET">
                                                <input id="searchInput1" name="query" class="search-input" type="text" value="{{ request('query') }}" placeholder="Search by keyword">
                                            </form>
                                        </div>
                                        <div class="search-close-icon"><i class="rt-xmark"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<a href="{{ route('cart') }}">
							<div class="cart action-item">
								<div class="cart-nav">
									<div class="cart-icon icon">
										<i class="rt-cart"></i>
										<span id="cart-count" class="wishlist-dot icon-dot">{{ count(session('cart', [])) }}</span>
									</div>
								</div>
							</div>
						</a>

						@if(Auth::check())
							<a href="{{ route('myProfile') }}" class="account"><i class="rt-user-2"></i></a>
						@else
							<a href="{{ route('login') }}" class="account"><i class="rt-user-2"></i></a>
						@endif
					</div>
					<div class="ms-2 hamburger"><span></span></div>
				</div>
			</div>
		</div>
	</div>
	<div class="navbar-sticky lower-navbar-sticky lower-navbar-sticky4">
		<div class="navbar-part navbar-part2 lower-navbar lower-navbar4">
			<div class="container">
				<div class="navbar-inner p-3">
					<a href="{{ route('index') }}" class="logo"><img src="{{ asset('assets/images/logo-findearning.svg') }}" class="w-50" alt="umart-logo"></a>
					<div class="rts-menu">
						<nav class="menus menu-toggle">
							<ul class="nav__menu">
								<li><a class="menu-item" href="{{ route('index') }}">Home</a></li>
								<li><a class="menu-item" href="{{ route('shop') }}">Shop</a></li>
								<li><a class="menu-item" href="{{ route('allCategory') }}">All Category</a></li>
								<li><a class="menu-item" href="{{ route('contact') }}">Contact</a></li>
								<li><a class="menu-item" href="{{ route('contact') }}">Shop Use Tutorial</a></li>
							</ul>
						</nav>
					</div>
					<div class="contact-info ml-auto">
						@if(Auth::check())
							@if(optional(Auth::user()->wallet)->balance)
								<a href="{{ route('myProfile') }}" class="text-white"> ${{ Auth::user()->wallet->balance }}</a>
							@else
								<a href="{{ route('myProfile') }}" class="text-white"><i class="rt-plus"></i> Recharge</a>
							@endif
						@else
							<a href="{{ route('login') }}" class="text-white"><i class="rt-plus"></i> Recharge</a>
						@endif
					</div>
					<div class="ms-2 hamburger"><span></span></div>
				</div>
			</div>
		</div>
	</div>

	<!-- slide-bar start -->
	<aside class="slide-bar">
		<div class="offset-sidebar d-flex justify-content-between align-items-center">
			<a class="hamburger-1 mobile-hamburger-1 mobile-hamburger-2 ml--30" href="#"><span><i class="rt-xmark"></i></span></a>
			<div class="e-wallet text-right ml-auto mr-3">
				@if(Auth::check())
					@if(optional(Auth::user()->wallet)->balance)
						<a href="{{ route('myProfile') }}" class="text-dark"> ${{ Auth::user()->wallet->balance }}</a>
					@else
						<a href="{{ route('myProfile') }}" class="text-dark"><i class="rt-plus"></i> Recharge</a>
					@endif
				@else
					<a href="{{ route('login') }}" class="text-dark"><i class="rt-plus"></i> Recharge</a>
				@endif
			</div>
		</div>
		<!-- side-mobile-menu start -->
		<nav class="side-mobile-menu side-mobile-menu1 side-mobile-menu2">
			<ul id="mobile-menu-active">
				<li><a class="mm-link" href="{{ route('index') }}">Home</a></li>
				<li><a class="mm-link" href="{{ route('shop') }}">Shop</a></li>
				<li><a class="mm-link" href="{{ route('allCategory') }}">All Category</a></li>
				<li><a class="mm-link" href="{{ route('contact') }}">Contact</a></li>
				<li><a class="mm-link" href="{{ route('contact') }}">Shop Use Tutorial</a></li>
			</ul>
		</nav>
	</aside>
</header>