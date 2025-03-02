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
									@foreach ($categories as $category)
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
					<h2 class="title">Latest Products</h2>
					<a href="{{ route('shop') }}" class="section-button">View All</a>
				</div>
			</div>
			<div class="row">
				@foreach ($randomProducts as $product)
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

@endsection