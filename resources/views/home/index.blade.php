@extends('layout.layout')

@php
    $css = '<link rel="stylesheet" href="' . asset('assets/css/variables/variable4.css') . '"/>';
@endphp

@section('content')    

    <!-- ..::Header Section Start Here::.. -->
    
    <!-- ..::Header Section End Here::.. -->

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
                                        <li><a href="{{ route('shop') }}">Action <i class="rt rt-arrow-right-long"></i></a></li>
                                        <li><a href="{{ route('shop') }}">Adventure <i class="rt rt-arrow-right-long"></i></a></li>
                                        <li><a href="{{ route('shop') }}">Ghost Story <i class="rt rt-arrow-right-long"></i></a></li>
                                        <li><a href="{{ route('shop') }}">Racing <i class="rt rt-arrow-right-long"></i></a></li>
                                        <li><a href="{{ route('shop') }}">Cell Phones <i class="rt rt-arrow-right-long"></i></a></li>
                                        <li><a href="{{ route('shop') }}">Electronics <i class="rt rt-arrow-right-long"></i></a></li>
                                        <li><a href="{{ route('shop') }}">Gaming <i class="rt rt-arrow-right-long"></i></a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-10 col-md-8 col-sm-12 gutter-2">
                        <div class="swiper bannerSlide2">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="banner-single bg-image bg-image-3-1 bg-image-8-1">
                                        <div class="container">
                                            <div class="single-inner">
                                                <div class="content-box">
                                                    <h2 class="slider-title"> CALL OF <br> DUTY GAMES</h2>
                                                    <a href="{{ route('shop') }}" class="slider-btn2">View Collections</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="banner-single bg-image bg-image-3-3 bg-image-8-2">
                                        <div class="container">
                                            <div class="single-inner">
                                                <div class="content-box">
                                                    <h2 class="slider-title"> BLADEPOINT MORUS <br> CUP SEASON 2</h2>
                                                    <a href="{{ route('shop') }}" class="slider-btn2">View Collections</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="banner-single bg-image bg-image-3-4 bg-image-8-3">
                                        <div class="container">
                                            <div class="single-inner">
                                                <div class="content-box">
                                                    <h2 class="slider-title"> NEW GAMES <br> FOR RANDOM CLICK</h2>
                                                    <a href="{{ route('shop') }}" class="slider-btn2">View Collections</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slider-navigation">
                                <div class="swiper-button-prev slider-btn prev"><i
                                        class="rt rt-arrow-left-long"></i></div>
                                <div class="swiper-button-next slider-btn next"><i
                                        class="rt rt-arrow-right-long"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ..::Banner Section End Here::.. -->

    <!-- ..::Offer Section Start Here::.. -->
    <div class="rts-offer-section section-8">
        <div class="container">
            <div class="section-inner">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="product-item7">
                            <div class="product-image">
                                <img src="{{ asset('assets/images/products/home8/game01.webp') }}" alt="">
                            </div>
                            <div class="bottom-text">
                                <a href="{{ route('shop') }}" class="sub-title">New Collections</a>
                                <h3 class="title">X24 Remote Game</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="product-item7">
                            <div class="product-image">
                                <img src="{{ asset('assets/images/products/home8/fifa.webp') }}" alt="">
                            </div>
                            <div class="bottom-text">
                                <a href="{{ route('shop') }}" class="sub-title">New Collections</a>
                                <h3 class="title">Fifa World Cup 2023</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="product-item7">
                            <div class="product-image">
                                <img src="{{ asset('assets/images/products/home8/samuri.webp') }}" alt="">
                            </div>
                            <div class="bottom-text">
                                <a href="{{ route('shop') }}" class="sub-title">New Collections</a>
                                <h3 class="title">Samurai Boost Game</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ..::Offer Section End Here::.. -->

    <!-- ..::Featured Product Section Start Here::.. -->
    <div class="rts-featured-product-section1 featured-product7 featured-product8">
        <div class="container">
            <div class="rts-featured-product-section-inner">
                <div class="section-header section-header3">
                    <div class="wrapper">
                        <h2 class="title">Latest Games</h2>
                        <a href="{{ route('shop') }}" class="section-button">Veiw All</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-4 col-sm-6 col-12">
                        <div class="product-item element-item1">
                            <a href="{{ route('productDetails') }}" class="product-image">
                                <div class="image-vari1 image-vari"><img
                                        src="{{ asset('assets/images/products/home8/gun-410x410.webp') }}" alt="product-image">
                                </div>
                            </a>
                            <div class="bottom-content">
                                <a href="{{ route('productDetails') }}" class="product-name">Online Action Game</a>
                                <div class="action-wrap">
                                    <span class="price">$39.00</span>
                                    <a href="{{ route('cart') }}" class="addto-cart"><i class="fal fa-shopping-cart"></i> Add to Cart</a>
                                </div>
                            </div>
                            <div class="quick-action-button">
                                <div class="cta-single cta-quickview">
                                    <button class="product-details-popup-btn"><i class="far fa-eye"></i></button>
                                </div>
                                <div class="cta-single cta-wishlist">
                                    <a href="{{ route('wishlist') }}"><i class="far fa-heart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-4 col-sm-6 col-12">
                        <div class="product-item element-item1">
                            <a href="{{ route('productDetails') }}" class="product-image">
                                <div class="image-vari1 image-vari"><img
                                        src="{{ asset('assets/images/products/home8/action-410x410.webp') }}" alt="product-image">
                                </div>
                            </a>
                            <div class="bottom-content">
                                <a href="{{ route('productDetails') }}" class="product-name">Life Of Gun</a>
                                <div class="action-wrap">
                                    <span class="price">$220.00</span>
                                    <a href="{{ route('cart') }}" class="addto-cart"><i class="fal fa-shopping-cart"></i> Add to Cart</a>
                                </div>
                            </div>
                            <div class="quick-action-button">
                                <div class="cta-single cta-quickview">
                                    <button class="product-details-popup-btn"><i class="far fa-eye"></i></button>
                                </div>
                                <div class="cta-single cta-wishlist">
                                    <a href="{{ route('wishlist') }}"><i class="far fa-heart"></i></a>
                                </div>
                            </div>
                            <div class="product-features">
                                <div class="discount-tag product-tag tag-2">-38%</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-4 col-sm-6 col-12">
                        <div class="product-item element-item1">
                            <a href="{{ route('productDetails') }}" class="product-image">
                                <div class="image-vari1 image-vari"><img
                                        src="{{ asset('assets/images/products/home8/racing-410x410.webp') }}" alt="product-image">
                                </div>
                            </a>
                            <div class="bottom-content">
                                <a href="{{ route('productDetails') }}" class="product-name">Speed Racing Game</a>
                                <div class="action-wrap">
                                    <span class="price">$220.00</span>
                                    <a href="{{ route('cart') }}" class="addto-cart"><i class="fal fa-shopping-cart"></i> Add to Cart</a>
                                </div>
                            </div>
                            <div class="quick-action-button">
                                <div class="cta-single cta-quickview">
                                    <button class="product-details-popup-btn"><i class="far fa-eye"></i></button>
                                </div>
                                <div class="cta-single cta-wishlist">
                                    <a href="{{ route('wishlist') }}"><i class="far fa-heart"></i></a>
                                </div>
                            </div>
                            <div class="product-features">
                                <div class="new-tag product-tag tag-2">HOT</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-4 col-sm-6 col-12">
                        <div class="product-item element-item1">
                            <a href="{{ route('productDetails') }}" class="product-image">
                                <div class="image-vari1 image-vari"><img
                                        src="{{ asset('assets/images/products/home8/Carmaker-410x410.webp') }}" alt="product-image">
                                </div>
                            </a>
                            <div class="bottom-content">
                                <a href="{{ route('productDetails') }}" class="product-name">Action With Jailer</a>
                                <div class="action-wrap">
                                    <span class="price">$250.00</span>
                                    <a href="{{ route('cart') }}" class="addto-cart"><i class="fal fa-shopping-cart"></i> Add to Cart</a>
                                </div>
                            </div>
                            <div class="quick-action-button">
                                <div class="cta-single cta-quickview">
                                    <button class="product-details-popup-btn"><i class="far fa-eye"></i></button>
                                </div>
                                <div class="cta-single cta-wishlist">
                                    <a href="{{ route('wishlist') }}"><i class="far fa-heart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-4 col-sm-6 col-12">
                        <div class="product-item element-item1">
                            <a href="{{ route('productDetails') }}" class="product-image">
                                <div class="image-vari1 image-vari"><img
                                        src="{{ asset('assets/images/products/home8/game2-410x410.webp') }}" alt="product-image">
                                </div>
                            </a>
                            <div class="bottom-content">
                                <a href="{{ route('productDetails') }}" class="product-name">Legends Of Runeterra</a>
                                <div class="action-wrap">
                                    <span class="price">$100.00</span>
                                    <a href="{{ route('cart') }}" class="addto-cart"><i class="fal fa-shopping-cart"></i> Add to Cart</a>
                                </div>
                            </div>
                            <div class="quick-action-button">
                                <div class="cta-single cta-quickview">
                                    <button class="product-details-popup-btn"><i class="far fa-eye"></i></button>
                                </div>
                                <div class="cta-single cta-wishlist">
                                    <a href="{{ route('wishlist') }}"><i class="far fa-heart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-4 col-sm-6 col-12">
                        <div class="product-item element-item1">
                            <a href="{{ route('productDetails') }}" class="product-image">
                                <div class="image-vari1 image-vari"><img
                                        src="{{ asset('assets/images/products/home8/gaming-410x410.webp') }}" alt="product-image">
                                </div>
                            </a>
                            <div class="bottom-content">
                                <a href="{{ route('productDetails') }}" class="product-name">Genchin Impact</a>
                                <div class="action-wrap">
                                    <span class="price">$220.00</span>
                                    <a href="{{ route('cart') }}" class="addto-cart"><i class="fal fa-shopping-cart"></i> Add to Cart</a>
                                </div>
                            </div>
                            <div class="quick-action-button">
                                <div class="cta-single cta-quickview">
                                    <button class="product-details-popup-btn"><i class="far fa-eye"></i></button>
                                </div>
                                <div class="cta-single cta-wishlist">
                                    <a href="{{ route('wishlist') }}"><i class="far fa-heart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-4 col-sm-6 col-12">
                        <div class="product-item element-item1">
                            <a href="{{ route('productDetails') }}" class="product-image">
                                <div class="image-vari1 image-vari"><img
                                        src="{{ asset('assets/images/products/home8/ghost-410x410.webp') }}" alt="product-image">
                                </div>
                            </a>
                            <div class="bottom-content">
                                <a href="{{ route('productDetails') }}" class="product-name">Royale Ghost Story</a>
                                <div class="action-wrap">
                                    <span class="price">$220.00</span>
                                    <a href="{{ route('cart') }}" class="addto-cart"><i class="fal fa-shopping-cart"></i> Add to Cart</a>
                                </div>
                            </div>
                            <div class="quick-action-button">
                                <div class="cta-single cta-quickview">
                                    <button class="product-details-popup-btn"><i class="far fa-eye"></i></button>
                                </div>
                                <div class="cta-single cta-wishlist">
                                    <a href="{{ route('wishlist') }}"><i class="far fa-heart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-4 col-sm-6 col-12">
                        <div class="product-item element-item1">
                            <a href="{{ route('productDetails') }}" class="product-image">
                                <div class="image-vari1 image-vari"><img
                                        src="{{ asset('assets/images/products/home8/cod-410x410.jpg') }}" alt="product-image">
                                </div>
                            </a>
                            <div class="bottom-content">
                                <a href="{{ route('productDetails') }}" class="product-name">Call Of Duty</a>
                                <div class="action-wrap">
                                    <span class="price">$220.00</span>
                                    <a href="{{ route('cart') }}" class="addto-cart"><i class="fal fa-shopping-cart"></i> Add to Cart</a>
                                </div>
                            </div>
                            <div class="quick-action-button">
                                <div class="cta-single cta-quickview">
                                    <button class="product-details-popup-btn"><i class="far fa-eye"></i></button>
                                </div>
                                <div class="cta-single cta-wishlist">
                                    <a href="{{ route('wishlist') }}"><i class="far fa-heart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ..::Featured Product Section End Here::.. -->

    <!-- ..::Brand Section Start Here::.. -->
    <div class="rts-brands-section2 brand-bg3 brand-bg8">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="brands-section-inner">
                        <div class="slider-div">
                            <div class="swiper rts-brandSlide1">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <a class="brand-front" href="#"><img src="{{ asset('assets/images/brands/panther4.webp') }}"
                                                alt="Brand Logo"></a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a class="brand-front" href="#"><img src="{{ asset('assets/images/brands/231.webp') }}"
                                                alt="Brand Logo"></a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a class="brand-front" href="#"><img src="{{ asset('assets/images/brands/531.webp') }}"
                                                alt="Brand Logo"></a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a class="brand-front" href="#"><img src="{{ asset('assets/images/brands/5466967.webp') }}"
                                                alt="Brand Logo"></a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a class="brand-front" href="#"><img src="{{ asset('assets/images/brands/5485618.webp') }}"
                                                alt="Brand Logo"></a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a class="brand-front" href="#"><img src="{{ asset('assets/images/brands/5572905.webp') }}"
                                                alt="Brand Logo"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ..::Brand Section End Here::.. -->

    <!-- ..::Newsletter Section Start Here::.. -->
    <div class="newsletter-banner newsletter-banner2 newsletter-banner8">
        <div class="container">
            <div class="newsletter-contents">
                <span class="section-pretitle">Newsletter</span>
                <span class="section-title-2">Join Our Newsletter</span>
                <p class="mb--30">Hey you, sign up it only takes a second to be the first to find out about <br>
                    our latest news and promotions…</p>

                <div class="newsletter-input">
                    <input type="email" placeholder="Your email address">
                    <button type="submit" class="subscribe-btn"><i class="rt-envelope mr--10"></i>
                        Subscribe</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ..::Newsletter Section End Here::.. -->

    <!-- ..::Newsletter Section Start Here::.. -->
    <div class="rts-services-section section-gap services-section8">
        <div class="container">
            <div class="row">
                <div class="col-lg-15 col-md-4 col-sm-6">
                    <a href="{{ route('shop') }}" class="service-item">
                        <div class="service-icon"><img src="{{ asset('assets/images/products/home8/cat-action.jpg') }}" alt="service-icon"></div>
                        <div class="contents">
                            <h3 class="service-title">Action</h3>
                            <p>3 Items</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-15 col-md-4 col-sm-6">
                    <a href="{{ route('shop') }}" class="service-item">
                        <div class="service-icon"><img src="{{ asset('assets/images/products/home8/game2.webp') }}" alt="service-icon">
                        </div>
                        <div class="contents">
                            <h3 class="service-title">Adventure</h3>
                            <p>3 Items</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-15 col-md-4 col-sm-6">
                    <a href="{{ route('shop') }}" class="service-item">
                        <div class="service-icon"><img src="{{ asset('assets/images/products/home8/modern-cars.jpg') }}" alt="service-icon">
                        </div>
                        <div class="contents">
                            <h3 class="service-title">Ghost Story</h3>
                            <p>3 Items</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-15 col-md-4 col-sm-6">
                    <a href="{{ route('shop') }}" class="service-item">
                        <div class="service-icon"><img src="{{ asset('assets/images/products/home8/120.jpg') }}" alt="service-icon"></div>
                        <div class="contents">
                            <h3 class="service-title">Racing</h3>
                            <p>3 Items</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-15 col-md-4 col-sm-6">
                    <a href="{{ route('shop') }}" class="service-item">
                        <div class="service-icon"><img src="{{ asset('assets/images/products/home8/samuri.webp') }}" alt="service-icon"></div>
                        <div class="contents">
                            <h3 class="service-title">Gaming</h3>
                            <p>3 Items</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- ..::Newsletter Section End Here::.. -->

    <!-- ..::Feeds Section Start Here::.. -->
    <div class="rts-feeds-section rts-feeds-section2 rts-feeds-section8 section-gap">
        <div class="container">
            <div class="section-header section-header4 section-header8">
                <span class="section-pretitle">News</span>
                <span class="section-title-2">Latest News</span>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-4 col-md-6">
                    <div class="feed-item">
                        <a href="{{ route('newsDetails') }}" class="feed-image"><img src="{{ asset('assets/images/products/home8/modern-gamepads.webp') }}"
                                alt="feed-image"></a>
                        <div class="contents">
                            <p class="date"> June 11, 2024 </p>
                            <h2 class="feed-title"><a href="{{ route('newsDetails') }}">Online Game Competition</a></h2>
                            <a href="{{ route('newsDetails') }}" class="content-button">Read More <i class="fa fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="feed-item">
                        <a href="{{ route('newsDetails') }}" class="feed-image"><img src="{{ asset('assets/images/products/home8/e-sport-arena.webp') }}"
                                alt="feed-image"></a>
                        <div class="contents">
                            <p class="date"> June 7, 2024 </p>
                            <h2 class="feed-title"><a href="{{ route('newsDetails') }}">Pubg News 2023</a></h2>
                            <a href="{{ route('newsDetails') }}" class="content-button">Read More <i class="fa fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="feed-item last-child">
                        <a href="{{ route('newsDetails') }}" class="feed-image"><img src="{{ asset('assets/images/products/home8/202k-768x512.webp') }}"
                                alt="feed-image"></a>
                        <div class="contents">
                            <p class="date"> June 3, 2024 </p>
                            <h2 class="feed-title"><a href="{{ route('newsDetails') }}">WWE 2k22 Review</a></h2>
                            <a href="{{ route('newsDetails') }}" class="content-button">Read More <i class="fa fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ..::Feeds Section End Here::.. -->

    <!-- ..::Newsletter Popup Start Here::.. -->
    {{-- <div class="rts-newsletter-popup">
        <div class="newsletter-close-btn"><i class="fal fa-times"></i></div>
        <div class="newsletter-inner">
            <h3 class="newsletter-heading">Get Weekly Newsletter</h3>
            <p>Priyoshop has brought to you the Hijab 3 Pieces Combo Pack
                PS23. It is a completely modern design</p>
            <form>
                <div class="input-area">
                    <div class="input-div"><input type="text" placeholder="Your name">
                        <div class="input-icon"><i class="far fa-user"></i></div>
                    </div>
                    <div class="input-div"><input type="email" placeholder="Email address" required>
                        <div class="input-icon"><i class="far fa-envelope"></i></div>
                    </div>
                </div>
                <button type="submit" class="subscribe-btn">Subscribe Now <i
                        class="fal fa-long-arrow-right ml--5"></i></button>
            </form>
        </div>
    </div> --}}
    <!-- ..::Newsletter Popup End Here::.. -->

    <!-- ..::Product-details Section Start Here::.. -->
    <div class="product-details-popup-wrapper">
        <div class="rts-product-details-section rts-product-details-section2 product-details-popup-section">
            <div class="product-details-popup">
                <button class="product-details-close-btn"><i class="fal fa-times"></i></button>
                <div class="details-product-area">
                    <div class="product-thumb-area">
                        <div class="cursor"></div>
                        <div class="thumb-wrapper one filterd-items figure">
                            <div class="product-thumb zoom" onmousemove="zoom(event)"
                                style="background-image: url('{{ asset('assets/images/products/product-details.jpg') }}"><img
                                    src="{{ asset('assets/images/products/product-details.jpg') }}" alt="product-thumb">
                            </div>
                        </div>
                        <div class="thumb-wrapper two filterd-items hide">
                            <div class="product-thumb zoom" onmousemove="zoom(event)"
                                style="background-image: url('{{ asset('assets/images/products/product-filt2.jpg') }}"><img
                                    src="{{ asset('assets/images/products/product-filt2.jpg') }}" alt="product-thumb">
                            </div>
                        </div>
                        <div class="thumb-wrapper three filterd-items hide">
                            <div class="product-thumb zoom" onmousemove="zoom(event)"
                                style="background-image: url('{{ asset('assets/images/products/product-filt3.jpg') }}"><img
                                    src="{{ asset('assets/images/products/product-filt3.jpg') }}" alt="product-thumb">
                            </div>
                        </div>
                        <div class="product-thumb-filter-group">
                            <div class="thumb-filter filter-btn active" data-show=".one"><img
                                    src="{{ asset('assets/images/products/product-filt1.jpg') }}" alt="product-thumb-filter"></div>
                            <div class="thumb-filter filter-btn" data-show=".two"><img
                                    src="{{ asset('assets/images/products/product-filt2.jpg') }}" alt="product-thumb-filter"></div>
                            <div class="thumb-filter filter-btn" data-show=".three"><img
                                    src="{{ asset('assets/images/products/product-filt3.jpg') }}" alt="product-thumb-filter"></div>
                        </div>
                    </div>
                    <div class="contents">
                        <div class="product-status">
                            <span class="product-catagory">Dress</span>
                            <div class="rating-stars-group">
                                <div class="rating-star"><i class="fas fa-star"></i></div>
                                <div class="rating-star"><i class="fas fa-star"></i></div>
                                <div class="rating-star"><i class="fas fa-star-half-alt"></i></div>
                                <span>10 Reviews</span>
                            </div>
                        </div>
                        <h2 class="product-title">Wide Cotton Tunic Dress <span class="stock">In Stock</span></h2>
                        <span class="product-price"><span class="old-price">$9.35</span> $7.25</span>
                        <p>
                            Priyoshop has brought to you the Hijab 3 Pieces Combo Pack PS23. It is a
                            completely modern design and you feel comfortable to put on this hijab.
                            Buy it at the best price.
                        </p>
                        <div class="product-bottom-action">
                            <div class="cart-edit">
                                <div class="quantity-edit action-item">
                                    <button class="button minus"><i class="fal fa-minus minus"></i></button>
                                    <input type="text" class="input" value="01" />
                                    <button class="button plus">+<i class="fal fa-plus plus"></i></button>
                                </div>
                            </div>
                            <a href="{{ route('cart') }}" class="addto-cart-btn action-item"><i class="rt-basket-shopping"></i>
                                Add To
                                Cart</a>
                            <a href="{{ route('wishlist') }}" class="wishlist-btn action-item"><i class="rt-heart"></i></a>
                        </div>
                        <div class="product-uniques">
                            <span class="sku product-unipue"><span>SKU: </span> BO1D0MX8SJ</span>
                            <span class="catagorys product-unipue"><span>Categories: </span> T-Shirts, Tops, Mens</span>
                            <span class="tags product-unipue"><span>Tags: </span> fashion, t-shirts, Men</span>
                        </div>
                        <div class="share-social">
                            <span>Share:</span>
                            <a class="platform" href="http://facebook.com" target="_blank"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="platform" href="http://twitter.com" target="_blank"><i
                                    class="fab fa-twitter"></i></a>
                            <a class="platform" href="http://behance.com" target="_blank"><i
                                    class="fab fa-behance"></i></a>
                            <a class="platform" href="http://youtube.com" target="_blank"><i
                                    class="fab fa-youtube"></i></a>
                            <a class="platform" href="http://linkedin.com" target="_blank"><i
                                    class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ..::Product-details Section End Here::.. -->

    <!-- ..::Footer Start Here::.. -->
    
    <!-- ..::Footer End Here::.. -->

@endsection