<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('dashboard.partials.head')
    @stack('styles')
</head>
<body id="page-top">
    <div id="wrapper">
        @include('dashboard.partials.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('dashboard.partials.topbar')
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            @include('dashboard.partials.footer')
        </div>
    </div>
	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	<!-- Logout Modal-->
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<form action="{{ route('logout') }}" method="POST" style="display: inline;">
						@csrf
						<button type="submit" class="btn btn-primary">Logout</button>
					</form>
				</div>
			</div>
		</div>
	</div>
    @include('dashboard.partials.scripts')
    
    @stack('scripts')
</body>
</html>