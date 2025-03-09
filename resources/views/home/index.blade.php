@extends('layout.layout')

@php
    $css = '<link rel="stylesheet" href="' . asset('assets/css/variables/variable4.css') . '"/>';
@endphp

@section('content')    

<!-- ..::Banner Section Start Here::.. -->
<div class="banner banner-1 banner-8 bg-image">
	<div class="container">
		<div class="banner-inner">
			<div class="row">
				<div class="col-xl-2 col-md-4 col-sm-12 gutter-1">
					<div class="catagory-sidebar">
						<div class="widget-bg">
							<h2 class="widget-title">All Categories <i class="rt-angle-down"></i></h2>
							<nav>
								<ul>
									@foreach ($categories->take(8) as $category)
									<li><a href="{{ route('shop.category', $category->slug) }}">{{ $category->title }} <i class="rt rt-arrow-right-long"></i></a></li>
									@endforeach
								</ul>
							</nav>
						</div>
					</div>
				</div>
				<x-banner :banners="$banners" />
			</div>
		</div>
	</div>
</div>
<!-- ..::Banner Section End Here::.. -->

<!-- ..::Featured Product Section Start Here::.. -->
<div class="rts-featured-product-section1 featured-product7 featured-product8">
	<div class="container">
		<div class="rts-featured-product-section-inner">

			<div class="row">
				@foreach ($categories as $category)
					<div class="col-xl-3 col-md-3 col-sm-6 col-6">
						<div class="product-item element-item1">
							<a href="{{ route('shop.category', $category->slug) }}" class="product-image">
								<div class="image-vari1 image-vari"><img
										src="{{ $category->imagePath ?? asset('assets/images/products/home8/gun-410x410.webp') }}"
										alt="product-image">
								</div>
							</a>
							<div class="bottom-content">
								<a href="{{ route('shop.category', $category->slug) }}" class="product-name fs-5">{{ $category->title }}</a>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
<!-- ..::Featured Product Section End Here::.. -->

<!-- ..::Featured Product Section Start Here::.. -->
<div class="rts-featured-product-section1 featured-product7 featured-product8">
	<div class="container">
		<div class="rts-featured-product-section-inner">
			<div class="section-header section-header3">
				<div class="wrapper">
					<h2 class="title">Top Products</h2>
					<a href="{{ route('shop') }}" class="section-button">View All</a>
				</div>
			</div>
			<div class="row">
				@foreach ($topProducts as $product)
				<div class="col-xl-3 col-md-3 col-sm-6 col-6">
					<div class="product-item element-item1">
						<a href="{{ route('productDetails', ['category' => $product->category->slug, 'product' => $product->slug]) }}" class="product-image">
							<div class="image-vari1 image-vari">
								<img src="{{ $product->imagePaths[0]['url'] }}" alt="product-image">
							</div>
						</a>
						<div class="bottom-content">
							<a class="text-white fs-5" href="{{ route('productDetails', ['category' => $product->category->slug, 'product' => $product->slug]) }}">
								{{ $product->title }}
							</a>
							<div class="text-white">
								<span class="price text-white">${{ $product->price }}</span>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
<!-- ..::Featured Product Section End Here::.. -->

<!-- ..::Testimonial/Review Section Start Here::.. -->
<div class="rts-testimonial-section">
	<div class="container">
		<div class="section-inner">
			<div class="section-header4 section-header8">
                <h2 class="title text-white">Customer Reviews</h2>
            </div>
			<div class="swiper testimonialSlide">
				<div class="swiper-wrapper">
					@foreach ($reviews as $review)
						<div class="swiper-slide">
							<div class="slider-inner">
								<div class="d-flex align-items-center">
									<div class="flex-grow-1">
										<div class="content text-white">
											<p class="description text-white mb-2">" {{ $review->comment }} "</p>
											@if ($review->image_path)
												<div class="me-4">
													<img class="avatar img-fluid" src="{{ asset('storage/'.$review->image_path) }}" alt="Review image" style="max-height: 150px; object-fit: cover;">
												</div>
											@endif
										</div>
										<div class="author-box">
											<h3 class="author-name text-white mb-0">{{ $review->user->name ?? 'Anonymous' }}</h3>
										</div>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				</div>
				<div class="swiper-pagination"></div>
			</div>
		</div>
	</div>
</div>
<!-- ..::Testimonial/Review Section End Here::.. -->

@endsection