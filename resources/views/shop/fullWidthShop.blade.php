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
							<select class="select" id="product-sort">
								<option value="popularity" {{ (request('sort') == 'popularity' || !request('sort')) ? 'selected' : '' }}>Sort by popularity</option>
								<option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Sort by latest</option>
								<option value="price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>Sort by price: low to high</option>
								<option value="price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>Sort by price: high to low</option>
							</select>
						</p>
					</div>
				</div>
				@if($products->count() > 0)
					<div class="products-container row gx-3 gx-lg-2 gx-xl-4 mt--20 mt-lg-0" 
						data-current-page="{{ $products->currentPage() }}"
						data-last-page="{{ $products->lastPage() }}"
						data-total="{{ $products->total() }}">
						@foreach ($products as $product)
							<div class="col-6 col-sm-6 col-md-4 col-lg-3 text-center">
								<div class="product-item mx-auto">
									<a href="{{ route('productDetails', ['category' => $product->category->slug, 'product' => $product->slug]) }}" class="product-image">
										<img src="{{ $product->imagePaths[0]['url'] }}" alt="{{ $product->title }}">
									</a>
									<div class="bottom-content">
										<a href="{{ route('productDetails', ['category' => $product->category->slug, 'product' => $product->slug]) }}" class="product-name">
											{{ $product->title }}
										</a>
										<div class="product-price-area">
											<span class="product-price">{{ $product->price }}$</span>
										</div>
									</div>
								</div>
							</div>
						@endforeach
					</div>
					<div class="loading-spinner mt-4 text-center" style="display:none;">
						<i class="fas fa-spinner fa-spin fa-2x"></i>
						<p>Loading more products...</p>
					</div>
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
<script src="{{ asset('assets/js/infinite-scroll.js') }}"></script>
<script>
	document.getElementById('product-sort').addEventListener('change', function() {
		const sortValue = this.value;
		const currentUrl = new URL(window.location.href);
		
		// Preserve all existing query parameters
		currentUrl.searchParams.set('sort', sortValue);
		
		// Reset to page 1 when sorting changes
		if (currentUrl.searchParams.has('page')) {
			currentUrl.searchParams.set('page', '1');
		}
		
		window.location.href = currentUrl.toString();
	});
</script>
@endpush