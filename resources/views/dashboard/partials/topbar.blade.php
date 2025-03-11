<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
	<!-- Sidebar Toggle (Topbar) -->
	<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
		<i class="fa fa-bars"></i>
	</button>
	<!-- New Two-Column Layout -->
	<div class="container-fluid">
		<div class="row w-100">
			<div class="col-md-10 d-none d-md-flex justify-content-center align-items-center">
				<div class="navbar-nav">
					<a class="nav-item nav-link" href="{{ route('shop') }}">Shop</a>
					<a class="nav-item nav-link" href="{{ route('allCategory') }}">All Category</a>
					<a class="nav-item nav-link" href="{{ route('contact') }}">Contact</a>
					@isset($settings['shop_tutorial'])
						<a class="nav-item nav-link" href="{{ $settings['shop_tutorial'] }}">Shop Use Tutorial</a>
					@endisset
				</div>
			</div>
			<div class="col-md-2 d-flex justify-content-end align-items-center">
				<ul class="navbar-nav">
					<li class="nav-item dropdown no-arrow">
						<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
							aria-haspopup="true" aria-expanded="false">
							<span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
							<div class="img-profile rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
								style="width:40px; height:40px;">
								{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
							</div>
						</a>
						<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
							<a class="dropdown-item" href="{{ route('myProfile') }}">
								<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
								Profile
							</a>
							@if(Auth::user()->role == 1)
							<a class="dropdown-item" href="{{ route('settings.index') }}">
								<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
								Settings
							</a>
							@endif
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
								<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
								Logout
							</a>
						</div>
					</li>
				</ul>
                <!-- New vertical dots button moved after profile -->
                <button class="btn btn-link d-md-none" type="button" data-toggle="collapse" data-target="#offCanvasMenu" aria-expanded="false" aria-controls="offCanvasMenu">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
			</div>
		</div>
	</div>
</nav>

<!-- Off-canvas container (collapsed by default) -->
<div class="collapse offcanvas-menu offcanvas-right d-md-none" id="offCanvasMenu">
	<div class="bg-white p-3">
        <!-- Remove button inside the off-canvas -->
        <div class="d-flex justify-content-end">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#offCanvasMenu" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
		<!-- Replicate nav items here -->
		<a class="nav-item nav-link" href="{{ route('shop') }}">Shop</a>
		<a class="nav-item nav-link" href="{{ route('allCategory') }}">All Category</a>
		<a class="nav-item nav-link" href="{{ route('contact') }}">Contact</a>
		@isset($settings['shop_tutorial'])
			<a class="nav-item nav-link" href="{{ $settings['shop_tutorial'] }}">Shop Use Tutorial</a>
		@endisset
	</div>
</div>

<!-- Script to hide off-canvas when clicking outside -->
<script>
document.addEventListener('click', function(event) {
    var offCanvas = document.getElementById('offCanvasMenu');
    var isClickInside = offCanvas.contains(event.target) || event.target.closest('[data-target="#offCanvasMenu"]');
    if (!isClickInside && offCanvas.classList.contains('show')) {
        // Hide the off-canvas
        $(offCanvas).collapse('hide');
    }
});
</script>