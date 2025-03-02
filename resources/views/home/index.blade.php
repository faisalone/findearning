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

<div class="rts-testimonial-section">
	<div class="container">
		<div class="section-inner">
			<div class="swiper testimonialSlide swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden">
				<div class="swiper-wrapper" id="swiper-wrapper-93a45101c5269964" aria-live="off" style="transition-duration: 1500ms; transform: translate3d(-2850px, 0px, 0px);"><div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-next" data-swiper-slide-index="3" style="width: 940px; margin-right: 10px;">
						<div class="slider-inner">
							<img class="icon" src="assets/images/slider/icon-testimonial.png" alt="">
							<div class="content text-white">
								<p class="description text-white">“ This is genuinely the first theme I bought for which I did
									not have to write one line of code. I would recommend everybody to get it. “</p>
							</div>
							<div class="author-box">
								<h3 class="author-name text-white">Jennifer Lopez</h3>
							</div>
						</div>
					</div>
					<div class="swiper-slide" data-swiper-slide-index="0" style="width: 940px; margin-right: 10px;">
						<div class="slider-inner">
							<img class="icon" src="assets/images/slider/icon-testimonial.png" alt="">
							<div class="content text-white">
								<p class="description text-white">“ This is genuinely the first theme I bought for which I did
									not have to write one line of code. I would recommend everybody to get it. “</p>
							</div>
							<div class="author-box">
								<h3 class="author-name text-white">Jennifer Lopez</h3>
							</div>
						</div>
					</div>
					<div class="swiper-slide swiper-slide-prev" data-swiper-slide-index="1" style="width: 940px; margin-right: 10px;">
						<div class="slider-inner">
							<img class="icon" src="assets/images/slider/icon-testimonial.png" alt="">
							<div class="content">
								<p class="description text-white">“ This is genuinely the first theme I bought for which I did
									not have to write one line of code. I would recommend everybody to get it. “</p>
							</div>
							<div class="author-box">
								<h3 class="author-name text-white">Jennifer Lopez</h3>
							</div>
						</div>
					</div>
					<div class="swiper-slide swiper-slide-active" data-swiper-slide-index="2" style="width: 940px; margin-right: 10px;">
						<div class="slider-inner">
							<img class="icon" src="assets/images/slider/icon-testimonial.png" alt="">
							<div class="content">
								<p class="description text-white">“ This is genuinely the first theme I bought for which I did
									not have to write one line of code. I would recommend everybody to get it. “</p>
							</div>
							<div class="author-box">
								<h3 class="author-name text-white">Jennifer Lopez</h3>
							</div>
						</div>
					</div>
					<div class="swiper-slide swiper-slide-next" data-swiper-slide-index="3" style="width: 940px; margin-right: 10px;">
						<div class="slider-inner">
							<img class="icon" src="assets/images/slider/icon-testimonial.png" alt="">
							<div class="content text-white">
								<p class="description text-white">“ This is genuinely the first theme I bought for which I did
									not have to write one line of code. I would recommend everybody to get it. “</p>
							</div>
							<div class="author-box ">
								<h3 class="author-name text-white">Jennifer Lopez</h3>
							</div>
						</div>
					</div>
				<div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="0" style="width: 940px; margin-right: 10px;">
						<div class="slider-inner">
							<img class="icon" src="assets/images/slider/icon-testimonial.png" alt="">
							<div class="content">
								<p class="description">“ This is genuinely the first theme I bought for which I did
									not have to write one line of code. I would recommend everybody to get it. “</p>
							</div>
							<div class="author-box">
								<h3 class="author-name text-white">Jennifer Lopez</h3>
							</div>
						</div>
					</div></div>
				<div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal"><span class="swiper-pagination-bullet" tabindex="0"></span><span class="swiper-pagination-bullet" tabindex="0"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" aria-current="true"></span><span class="swiper-pagination-bullet" tabindex="0"></span></div>
			<span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
		</div>
	</div>
</div>

@endsection