@extends('layout.layout')

@php
	$css = '<link rel="stylesheet" href="' . asset('assets/css/variables/variable4.css') . '"/>
				<link rel="stylesheet" href="' . asset('assets/css/jquery.nstSlider.min.css') . '"/>';
	$title = $title ?? 'Shop';
	$script = '<script src="' . asset('assets/js/vendors/zoom.js') . '"></script>
				   <script src="' . asset('assets/js/vendors/jquery.nstSlider.min.js') . '"></script>';
@endphp

@section('content')

<!-- ..::Shop Section Start Here::.. -->
<div class="rts-shop-section section-gap">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<div class="shop-product-topbar">
					<div class="filter-area">
						<p class="select-area">
							<select class="select">
								<option value="*">Sort by average rating</option>
								<option value=".popular">Sort by popularity</option>
								<option value=".best-rate">Sort by latest</option>
								<option value=".on-sale">Sort by price: low to high</option>
								<option value=".featured">Sort by price: high to low</option>
							</select>
						</p>
					</div>
				</div>
				@if($products->count() > 0)
					<div class="products-area products-area3">
						<div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4" id="products-container">
							@foreach ($products as $product)
								<x-product-item :product="$product" />
							@endforeach
						</div>
					</div>
					<div class="loading-indicator text-center mt-4 d-none">
						<div class="spinner-border text-primary" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>
					<input type="hidden" id="current-page" value="1">
				@else
					<p class="text-center">No products available.</p>
				@endif
			</div>
		</div>
	</div>
</div>
<!-- ..::Shop Section Section End Here::.. -->

@endsection

@push('scripts')
<script>
	$(function() {
		let loading = false;
		let currentPage = parseInt($('#current-page').val());
		let noMoreProducts = false;
        
        // Check if device is mobile
        const isMobile = window.innerWidth <= 767;
        
        // Set a more aggressive threshold for mobile devices
        const scrollThreshold = isMobile ? 1000 : 300;
		
		$(window).scroll(function() {
			if (loading || noMoreProducts) return;
			
			// Calculate distance from bottom, adjusted for mobile
			const scrollPosition = $(window).scrollTop() + $(window).height();
			const documentHeight = $(document).height() - scrollThreshold;
			
			// Check if user scrolled close enough to the bottom
			if (scrollPosition >= documentHeight) {
				loadMoreProducts();
			}
		});
        
        // Initial check in case the page doesn't fill the screen
        if ($(window).height() >= $(document).height() - scrollThreshold) {
            loadMoreProducts();
        }
		
		function loadMoreProducts() {
			loading = true;
			currentPage++;
			$('.loading-indicator').removeClass('d-none');
			
			// Build the URL based on current page context
			let url = '{{ request()->route("category") ? route("shop.category", request()->route("category")) : route("shop") }}';
			
			$.ajax({
				url: url,
				type: 'GET',
				data: { 
					page: currentPage
				},
				success: function(response) {
					if (response.html === '') {
						noMoreProducts = true;
					} else {
						$('#products-container').append(response.html);
						$('#current-page').val(currentPage);
					}
					loading = false;
					$('.loading-indicator').addClass('d-none');
                    
                    // Check again after content is loaded in case the new content doesn't fill the screen
                    if ($(window).scrollTop() + $(window).height() >= $(document).height() - scrollThreshold) {
                        setTimeout(function() {
                            if (!loading && !noMoreProducts) {
                                loadMoreProducts();
                            }
                        }, 500);
                    }
				},
				error: function() {
					loading = false;
					$('.loading-indicator').addClass('d-none');
				}
			});
		}
	});
</script>
@endpush