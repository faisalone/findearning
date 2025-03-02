@extends('layout.layout')

@php
	$title = $product->title;
	$script = '<script src="' . asset('assets/js/vendors/zoom.js') . '"></script>';
	$css = '<link rel="stylesheet" href="' . asset('assets/css/variables/variable4.css') . '"/>';
@endphp

@section('content')

	<!-- ..::Product-details Section Start Here::.. -->
	<div class="rts-product-details-section section-gap">
		<div class="container">
			<div class="details-product-area mb--70">
				<div class="row">
					<div class="col-md-7">
						<div class="product-thumb-area">
							<div class="cursor"></div>
							@php
								$mapping = ['one', 'two', 'three'];
							@endphp
							@foreach($product->imagePaths as $index => $img)
								@php
									$class = $mapping[$index] ?? ('img-' . ($index + 1));
									$wrapperClasses = $index === 0 ? "thumb-wrapper $class filterd-items figure" : "thumb-wrapper $class filterd-items hide";
								@endphp
								<div class="{{ $wrapperClasses }}">
									<div class="product-thumb zoom" onmousemove="zoom(event)"
										style="background-image: url('{{ asset($img['url']) }}')">
										<img class="img-fluid" src="{{ asset($img['url']) }}"
											alt="{{ $product->images[$index]['alt_text'] ?? 'product-thumb' }}"
											style="object-fit: cover; width: 100%; height: 100%;">
									</div>
								</div>
							@endforeach

							<div class="product-thumb-filter-group">
								@foreach($product->imagePaths as $index => $img)
									@php
										$class = $mapping[$index] ?? ('img-' . ($index + 1));
									@endphp
									<div class="thumb-filter filter-btn {{ $index === 0 ? 'active' : '' }}"
										data-show=".{{ $class }}">
										<img class="img-fluid" src="{{ asset($img['url']) }}" alt="product-thumb-filter"
											style="object-fit: cover; width: 100%; height: 100%;">
									</div>
								@endforeach
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="contents">
							<div class="product-status">
								<span class="product-catagory">{{ $product->category->title }}</span>
								<div class="rating-stars-group">
									<div class="rating-star"><i class="fas fa-star"></i></div>
									<div class="rating-star"><i class="fas fa-star"></i></div>
									<div class="rating-star"><i class="fas fa-star-half-alt"></i></div>
									<span>10 Reviews</span>
								</div>
							</div>
							<div class="d-flex justify-content-start align-items-center mb-3">
								<span class="badge bg-success me-5">Inhouse Product</span>
								<a href="#" class="btn btn-primary">
									<i class="fas fa-comments"></i> Chat with Seller
								</a>
							</div>
							<h2 class="product-title">{{ $product->title }} <span class="stock">In Stock</span></h2>
							<div class="d-flex justify-content-start align-items-center">
								<span class="product-price">{{ $product->price }}</span>
								<span>/Email Delivery</span>
							</div>
							<p>
								{{ $product->description }}
							</p>
							<div class="cart-edit">
								<div class="cart-edit">
									<div class="quantity-edit action-item">
										<button class="button" type="button"><i class="fal fa-minus minus"></i></button>
										<!-- Add an id so we can reference the visible quantity -->
										<input type="text" id="quantity-input" name="visible_quantity" class="input"
											value="1" />
										<button class="button plus" type="button">+<i class="fal fa-plus plus"></i></button>
									</div>
								</div>
							</div>
							<div class="product-bottom-action">
								<form id="add-to-cart-form" action="{{ route('shop.addToCart') }}" method="POST">
									@csrf
									<input type="hidden" name="product_id" value="{{ $product->id }}">
									<!-- Hidden field to receive the quantity -->
									<input type="hidden" name="quantity" id="hidden-quantity" value="1">
									<!-- Hidden field to track which button was clicked -->
									<input type="hidden" name="action_type" id="action-type" value="add-to-cart">
									<div class="d-flex">
										<button type="button" class="addto-cart-btn action-item me-2" id="add-to-cart-btn">
											<i class="rt-basket-shopping"></i> Add To Cart
										</button>
										<button type="button" class="buy-now-btn action-item" id="buy-now-btn">
											<i class="rt-basket-shopping"></i> Buy Now
										</button>
									</div>
								</form>
							</div>
							<script>
								const visibleQtyInput = document.getElementById('quantity-input');
								const form = document.getElementById('add-to-cart-form');
								const actionTypeInput = document.getElementById('action-type');

								// Add to Cart button handler
								document.getElementById('add-to-cart-btn').addEventListener('click', function () {
									actionTypeInput.value = 'add-to-cart';
									document.getElementById('hidden-quantity').value = visibleQtyInput.value;

									let formData = new FormData(form);
									fetch(form.action, {
										method: 'POST',
										headers: { 'X-Requested-With': 'XMLHttpRequest' },
										body: formData
									})
										.then(response => response.json())
										.then(data => {
											if (document.getElementById('cart-count')) {
												document.getElementById('cart-count').textContent = data.count;
											}
											if (document.getElementById('mobile-cart-count')) {
												document.getElementById('mobile-cart-count').textContent = data.count;
											}
										})
										.catch(error => console.error('Error:', error));
								});

								// Buy Now button handler
								document.getElementById('buy-now-btn').addEventListener('click', function () {
									actionTypeInput.value = 'buy-now';
									document.getElementById('hidden-quantity').value = visibleQtyInput.value;

									// Submit the form and redirect to checkout
									form.submit();
								});
							</script>

							<x-social />
						</div>
					</div>
				</div>

			</div>
			@if($topProducts && $topProducts->isNotEmpty())
				<!-- ..::Related Product Section Start Here::.. -->
				<div class="rts-featured-product-section1 related-product related-product1">
					<div class="container">
						<div class="rts-featured-product-section-inner">
							<div class="section-header section-header3 section-header6">
								<div class="wrapper">
									<h2 class="title">TOP PRODUCTS</h2>
								</div>
							</div>
							<div class="row">
								@foreach ($topProducts as $product)
									<div class="col-xl-3 col-md-4 col-sm-6 col-12">
										<div class="product-item element-item1">
											<a href="{{ route('productDetails', ['category' => $product->category->slug, 'product' => $product->slug]) }}"
												class="product-image">
												<div class="image-vari1 image-vari"><img src="{{ $product->imagePaths[0]['url'] }}"
														alt="{{ $product->title }}">
												</div>
											</a>
											<div class="bottom-content">
												<a href="{{ route('productDetails', ['category' => $product->category->slug, 'product' => $product->slug]) }}"
													class="product-name">{{ $product->title }}</a>
												<div class="action-wrap">
													<span class="price">${{ $product->price }}</span>
												</div>
											</div>
										</div>
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
				<!-- ..::Related Product Section End Here::.. -->
			@endif
		</div>
	</div>
	<!-- ..::Product-details Section End Here::.. -->
@endsection