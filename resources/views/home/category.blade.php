@extends('layout.layout')

@php
    $css='<link rel="stylesheet" href="' . asset('assets/css/jquery.nstSlider.min.css') . '"/>
          <link rel="stylesheet" href="' . asset('assets/css/variables/variable4.css') . '"/>';     
    $title='Catagory';
    $subTitle = 'Home';
    $subTitle2 = 'Catagory';
    $script = '<script src="' . asset('assets/js/vendors/jquery.nstSlider.min.js') . '"></script>
               <script src="' . asset('assets/js/vendors/zoom.js') . '"></script>'; 
@endphp

@section('content')

    <!-- ..::Shop Section Start Here::.. -->
    <div class="rts-shop-section section-gap">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <div class="shop-product-topbar">
                        <span class="items-onlist">Showing 1-12 of 70 results</span>
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
                    <div class="products-area products-area3">
                        <div class="row justify-content-center">
                            <div class="col-xl-3 col-md-4 col-sm-6">
                                <div class="product-item product-item2 element-item3">
                                    <a href="{{ route('productDetails') }}" class="product-image">
                                        <img src="{{ asset('assets/images/products/home3/1.jpg') }}" alt="product-image">
                                    </a>
                                    <div class="bottom-content">
                                        <span class="product-category">Hand Craft</span>
                                        <a href="{{ route('productDetails') }}" class="product-name">Minimalist Beard Mug</a>
                                        <div class="action-wrap">
                                            <span class="product-price">$31.00</span>
                                            <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i>
                                                Add To
                                                Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6">
                                <div class="product-item product-item2 element-item2">
                                    <a href="{{ route('productDetails') }}"
                                        class="product-image image-slider-variations image-slider-variations3">
                                        <div class="swiper productSlide">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <div class="image-vari1 image-vari"><img
                                                            src="{{ asset('assets/images/products/home3/2.jpg') }}"
                                                            alt="product-image">
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="image-vari2 image-vari"><img
                                                            src="{{ asset('assets/images/products/home3/7.jpg') }}"
                                                            alt="product-image">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="slider-buttons">
                                            <div class="button-prev slider-btn"><i class="fal fa-long-arrow-left"></i>
                                            </div>
                                            <div class="button-next slider-btn"><i class="fal fa-long-arrow-right"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="bottom-content">
                                        <span class="product-category">Hand Craft</span>
                                        <a href="{{ route('productDetails') }}" class="product-name">Minimalist Beard Mug</a>
                                        <div class="action-wrap">
                                            <span class="product-price">$31.00</span>
                                            <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i>
                                                Add To
                                                Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6">
                                <div class="product-item product-item2 element-item3 popular">
                                    <a href="{{ route('productDetails') }}"
                                        class="product-image image-gallery-variations image-gallery-variations3">
                                        <div class="swiper productGallerySlide">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <div class="image-vari1 image-vari"><img
                                                            src="{{ asset('assets/images/products/home3/3.jpg') }}"
                                                            alt="product-image">
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="image-vari2 image-vari"><img
                                                            src="{{ asset('assets/images/products/home3/9.jpg') }}"
                                                            alt="product-image">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="thumbs-area">
                                        <div class="swiper productGallerySlideThumb">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <div class="image-vari1 image-vari"><img
                                                            src="{{ asset('assets/images/products/home3/3.jpg') }}"
                                                            alt="product-image">
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="image-vari2 image-vari"><img
                                                            src="{{ asset('assets/images/products/home3/9.jpg') }}"
                                                            alt="product-image">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bottom-content">
                                        <span class="product-category">Hand Craft</span>
                                        <a href="{{ route('productDetails') }}" class="product-name">Minimalist Beard Mug</a>
                                        <div class="action-wrap">
                                            <span class="product-price">$31.00</span>
                                            <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i>
                                                Add To
                                                Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6">
                                <div class="product-item product-item2 element-item1">
                                    <a href="{{ route('productDetails') }}" class="product-image">
                                        <img src="{{ asset('assets/images/products/home3/4.jpg') }}" alt="product-image">
                                    </a>
                                    <div class="bottom-content">
                                        <span class="product-category">Hand Craft</span>
                                        <a href="{{ route('productDetails') }}" class="product-name">Minimalist Beard Mug</a>
                                        <div class="action-wrap">
                                            <span class="product-price">$31.00</span>
                                            <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i>
                                                Add To
                                                Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6">
                                <div class="product-item product-item2 element-item1">
                                    <a href="{{ route('productDetails') }}" class="product-image">
                                        <img src="{{ asset('assets/images/products/home3/5.jpg') }}" alt="product-image">
                                    </a>
                                    <div class="bottom-content">
                                        <span class="product-category">Hand Craft</span>
                                        <a href="{{ route('productDetails') }}" class="product-name">Minimalist Beard Mug</a>
                                        <div class="action-wrap">
                                            <span class="product-price">$31.00</span>
                                            <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i>
                                                Add To
                                                Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6">
                                <div class="product-item product-item2 element-item1">
                                    <a href="{{ route('productDetails') }}" class="product-image">
                                        <img src="{{ asset('assets/images/products/home3/6.jpg') }}" alt="product-image">
                                    </a>
                                    <div class="bottom-content">
                                        <span class="product-category">Hand Craft</span>
                                        <a href="{{ route('productDetails') }}" class="product-name">Minimalist Beard Mug</a>
                                        <div class="action-wrap">
                                            <span class="product-price">$31.00</span>
                                            <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i>
                                                Add To
                                                Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6">
                                <div class="product-item product-item2 element-item1">
                                    <a href="{{ route('productDetails') }}" class="product-image">
                                        <img src="{{ asset('assets/images/products/home3/7.jpg') }}" alt="product-image">
                                    </a>
                                    <div class="bottom-content">
                                        <span class="product-category">Hand Craft</span>
                                        <a href="{{ route('productDetails') }}" class="product-name">Minimalist Beard Mug</a>
                                        <div class="action-wrap">
                                            <span class="product-price">$31.00</span>
                                            <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i>
                                                Add To
                                                Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6">
                                <div class="product-item product-item2 element-item1">
                                    <a href="{{ route('productDetails') }}" class="product-image">
                                        <img src="{{ asset('assets/images/products/home3/8.jpg') }}" alt="product-image">
                                    </a>
                                    <div class="bottom-content">
                                        <span class="product-category">Hand Craft</span>
                                        <a href="{{ route('productDetails') }}" class="product-name">Minimalist Beard Mug</a>
                                        <div class="action-wrap">
                                            <span class="product-price">$31.00</span>
                                            <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i>
                                                Add To
                                                Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6">
                                <div class="product-item product-item2 element-item1">
                                    <a href="{{ route('productDetails') }}" class="product-image">
                                        <img src="{{ asset('assets/images/products/home3/9.jpg') }}" alt="product-image">
                                    </a>
                                    <div class="bottom-content">
                                        <span class="product-category">Hand Craft</span>
                                        <a href="{{ route('productDetails') }}" class="product-name">Minimalist Beard Mug</a>
                                        <div class="action-wrap">
                                            <span class="product-price">$31.00</span>
                                            <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i>
                                                Add To
                                                Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6">
                                <div class="product-item product-item2 element-item1">
                                    <a href="{{ route('productDetails') }}" class="product-image">
                                        <img src="{{ asset('assets/images/products/home3/10.jpg') }}" alt="product-image">
                                    </a>
                                    <div class="bottom-content">
                                        <span class="product-category">Hand Craft</span>
                                        <a href="{{ route('productDetails') }}" class="product-name">Minimalist Beard Mug</a>
                                        <div class="action-wrap">
                                            <span class="product-price">$31.00</span>
                                            <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i>
                                                Add To
                                                Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6">
                                <div class="product-item product-item2 element-item1">
                                    <a href="{{ route('productDetails') }}" class="product-image">
                                        <img src="{{ asset('assets/images/products/home3/1.jpg') }}" alt="product-image">
                                    </a>
                                    <div class="bottom-content">
                                        <span class="product-category">Hand Craft</span>
                                        <a href="{{ route('productDetails') }}" class="product-name">Minimalist Beard Mug</a>
                                        <div class="action-wrap">
                                            <span class="product-price">$31.00</span>
                                            <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i>
                                                Add To
                                                Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6">
                                <div class="product-item product-item2 element-item1">
                                    <a href="{{ route('productDetails') }}" class="product-image">
                                        <img src="{{ asset('assets/images/products/home3/2.jpg') }}" alt="product-image">
                                    </a>
                                    <div class="bottom-content">
                                        <span class="product-category">Hand Craft</span>
                                        <a href="{{ route('productDetails') }}" class="product-name">Minimalist Beard Mug</a>
                                        <div class="action-wrap">
                                            <span class="product-price">$31.00</span>
                                            <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i>
                                                Add To
                                                Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6">
                                <div class="product-item product-item2 element-item1">
                                    <a href="{{ route('productDetails') }}" class="product-image">
                                        <img src="{{ asset('assets/images/products/home3/3.jpg') }}" alt="product-image">
                                    </a>
                                    <div class="bottom-content">
                                        <span class="product-category">Hand Craft</span>
                                        <a href="{{ route('productDetails') }}" class="product-name">Minimalist Beard Mug</a>
                                        <div class="action-wrap">
                                            <span class="product-price">$31.00</span>
                                            <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i>
                                                Add To
                                                Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6">
                                <div class="product-item product-item2 element-item1">
                                    <a href="{{ route('productDetails') }}" class="product-image">
                                        <img src="{{ asset('assets/images/products/home3/4.jpg') }}" alt="product-image">
                                    </a>
                                    <div class="bottom-content">
                                        <span class="product-category">Hand Craft</span>
                                        <a href="{{ route('productDetails') }}" class="product-name">Minimalist Beard Mug</a>
                                        <div class="action-wrap">
                                            <span class="product-price">$31.00</span>
                                            <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i>
                                                Add To
                                                Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6">
                                <div class="product-item product-item2 element-item1">
                                    <a href="{{ route('productDetails') }}" class="product-image">
                                        <img src="{{ asset('assets/images/products/home3/5.jpg') }}" alt="product-image">
                                    </a>
                                    <div class="bottom-content">
                                        <span class="product-category">Hand Craft</span>
                                        <a href="{{ route('productDetails') }}" class="product-name">Minimalist Beard Mug</a>
                                        <div class="action-wrap">
                                            <span class="product-price">$31.00</span>
                                            <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i>
                                                Add To
                                                Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6">
                                <div class="product-item product-item2 element-item1">
                                    <a href="{{ route('productDetails') }}" class="product-image">
                                        <img src="{{ asset('assets/images/products/home3/6.jpg') }}" alt="product-image">
                                    </a>
                                    <div class="bottom-content">
                                        <span class="product-category">Hand Craft</span>
                                        <a href="{{ route('productDetails') }}" class="product-name">Minimalist Beard Mug</a>
                                        <div class="action-wrap">
                                            <span class="product-price">$31.00</span>
                                            <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i>
                                                Add To
                                                Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6">
                                <div class="product-item product-item2 element-item1">
                                    <a href="{{ route('productDetails') }}" class="product-image">
                                        <img src="{{ asset('assets/images/products/home3/7.jpg') }}" alt="product-image">
                                    </a>
                                    <div class="bottom-content">
                                        <span class="product-category">Hand Craft</span>
                                        <a href="{{ route('productDetails') }}" class="product-name">Minimalist Beard Mug</a>
                                        <div class="action-wrap">
                                            <span class="product-price">$31.00</span>
                                            <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i>
                                                Add To
                                                Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6">
                                <div class="product-item product-item2 element-item1">
                                    <a href="{{ route('productDetails') }}" class="product-image">
                                        <img src="{{ asset('assets/images/products/home3/8.jpg') }}" alt="product-image">
                                    </a>
                                    <div class="bottom-content">
                                        <span class="product-category">Hand Craft</span>
                                        <a href="{{ route('productDetails') }}" class="product-name">Minimalist Beard Mug</a>
                                        <div class="action-wrap">
                                            <span class="product-price">$31.00</span>
                                            <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i>
                                                Add To
                                                Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6">
                                <div class="product-item product-item2 element-item1">
                                    <a href="{{ route('productDetails') }}" class="product-image">
                                        <img src="{{ asset('assets/images/products/home3/9.jpg') }}" alt="product-image">
                                    </a>
                                    <div class="bottom-content">
                                        <span class="product-category">Hand Craft</span>
                                        <a href="{{ route('productDetails') }}" class="product-name">Minimalist Beard Mug</a>
                                        <div class="action-wrap">
                                            <span class="product-price">$31.00</span>
                                            <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i>
                                                Add To
                                                Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4 col-sm-6">
                                <div class="product-item product-item2 element-item1">
                                    <a href="{{ route('productDetails') }}" class="product-image">
                                        <img src="{{ asset('assets/images/products/home3/10.jpg') }}" alt="product-image">
                                    </a>
                                    <div class="bottom-content">
                                        <span class="product-category">Hand Craft</span>
                                        <a href="{{ route('productDetails') }}" class="product-name">Minimalist Beard Mug</a>
                                        <div class="action-wrap">
                                            <span class="product-price">$31.00</span>
                                            <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i>
                                                Add To
                                                Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-pagination-area mt--20">
                        <button class="prev"><i class="far fa-long-arrow-left"></i></button>
                        <button class="number active">01</button>
                        <button class="number">02</button>
                        <button class="skip-number">---</button>
                        <button class="number">07</button>
                        <button class="number">08</button>
                        <button class="next"><i class="far fa-long-arrow-right"></i></button>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="side-sticky">
                        <div class="shop-side-action">
                            <div class="action-item">
                                <div class="action-top">
                                    <span class="action-title">category</span>
                                </div>
                                <div class="category-item">
                                    <div class="category-item-inner">
                                        <div class="category-title-area">
                                            <span class="point"></span>
                                            <span class="category-title">Kids (10)</span>
                                        </div>
                                        <div class="down-icon"><i class="far fa-angle-down"></i></div>
                                    </div>
                                    <ul class="sub-categorys">
                                        <div class="sub-categorys-inner">
                                            <li><span class="point"></span><a href="shop.php">Clothes</a></li>
                                            <li><span class="point"></span><a href="shop.php">Shoes</a></li>
                                            <li><span class="point"></span><a href="shop.php">Toys</a></li>
                                        </div>
                                    </ul>
                                </div>
                                <div class="category-item">
                                    <div class="category-item-inner">
                                        <div class="category-title-area">
                                            <span class="point"></span>
                                            <span class="category-title">Mens (23)</span>
                                        </div>
                                        <div class="down-icon"><i class="far fa-angle-down"></i></div>
                                    </div>
                                    <ul class="sub-categorys">
                                        <div class="sub-categorys-inner">
                                            <li><span class="point"></span><a href="shop.php">Clothes</a></li>
                                            <li><span class="point"></span><a href="shop.php">Shoes</a></li>
                                            <li><span class="point"></span><a href="shop.php">Glasses</a></li>
                                            <li><span class="point"></span><a href="shop.php">Watches</a></li>
                                            <li><span class="point"></span><a href="shop.php">Assesories</a></li>
                                        </div>
                                    </ul>
                                </div>
                                <div class="category-item">
                                    <div class="category-item-inner">
                                        <div class="category-title-area">
                                            <span class="point"></span>
                                            <span class="category-title">Women (14)</span>
                                        </div>
                                        <div class="down-icon"><i class="far fa-angle-down"></i></div>
                                    </div>
                                    <ul class="sub-categorys">
                                        <div class="sub-categorys-inner">
                                            <li><span class="point"></span><a href="shop.php">Clothes</a></li>
                                            <li><span class="point"></span><a href="shop.php">Shoes</a></li>
                                            <li><span class="point"></span><a href="shop.php">Glasses</a></li>
                                            <li><span class="point"></span><a href="shop.php">Makeups</a></li>
                                            <li><span class="point"></span><a href="shop.php">Assesories</a></li>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                            <div class="action-item">
                                <div class="action-top">
                                    <span class="action-title">Filter</span>
                                </div>
                                <div class="nstSlider" data-range_min="50" data-range_max="20000" data-cur_min="20"
                                    data-cur_max="10000">

                                    <div class="bar"></div>
                                    <div class="leftGrip price-range-grip"></div>
                                    <div class="rightGrip price-range-grip"></div>
                                </div>
                                <div class="range-label-area">
                                    <div class="min-price d-flex">
                                        <span class="range-lbl">Min:</span>
                                        <span class="currency-symbol">$</span>
                                        <div class="leftLabel price-range-label"></div>
                                    </div>
                                    <div class="min-price d-flex">
                                        <span class="range-lbl">Max:</span>
                                        <span class="currency-symbol">$</span>
                                        <div class="rightLabel price-range-label"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="action-item">
                                <div class="action-top">
                                    <span class="action-title">Color</span>
                                </div>
                                <div class="color-item">
                                    <div class="color black"><i class="fas fa-check"></i></div>
                                    <span class="color-name">Black</span>
                                    <div class="color-arrow"><i class="far fa-long-arrow-right"></i></div>
                                </div>
                                <div class="color-item">
                                    <div class="color blue"><i class="fas fa-check"></i></div>
                                    <span class="color-name">blue</span>
                                    <div class="color-arrow"><i class="far fa-long-arrow-right"></i></div>
                                </div>
                                <div class="color-item selected">
                                    <div class="color gray"><i class="fas fa-check"></i></div>
                                    <span class="color-name">Gray</span>
                                    <div class="color-arrow"><i class="far fa-long-arrow-right"></i></div>
                                </div>
                                <div class="color-item">
                                    <div class="color green"><i class="fas fa-check"></i></div>
                                    <span class="color-name">Green</span>
                                    <div class="color-arrow"><i class="far fa-long-arrow-right"></i></div>
                                </div>
                                <div class="color-item">
                                    <div class="color red"><i class="fas fa-check"></i></div>
                                    <span class="color-name">Red</span>
                                    <div class="color-arrow"><i class="far fa-long-arrow-right"></i></div>
                                </div>
                                <div class="color-item">
                                    <div class="color yellow"><i class="fas fa-check"></i></div>
                                    <span class="color-name">Yellow</span>
                                    <div class="color-arrow"><i class="far fa-long-arrow-right"></i></div>
                                </div>
                            </div>
                            <div class="action-item">
                                <div class="action-top">
                                    <span class="action-title">Brand</span>
                                </div>
                                <div class="product-brands">
                                    <div class="brands-inner">
                                        <ul>
                                            <li><a class="product-brand" href="shop.php">Alexander McQueen</a></li>
                                            <li><a class="product-brand" href="shop.php">Adidas</a></li>
                                            <li><a class="product-brand" href="shop.php">Balenciaga</a></li>
                                            <li><a class="product-brand" href="shop.php">Balmain</a></li>
                                            <li><a class="product-brand" href="shop.php">Burberry</a></li>
                                            <li><a class="product-brand" href="shop.php">Chloé</a></li>
                                            <li><a class="product-brand" href="shop.php">Dsquared2</a></li>
                                            <li><a class="product-brand" href="shop.php">Givenchy</a></li>
                                            <li><a class="product-brand" href="shop.php">Kenzo</a></li>
                                            <li><a class="product-brand" href="shop.php">Leo</a></li>
                                            <li><a class="product-brand" href="shop.php">Maison Margiela</a></li>
                                            <li><a class="product-brand" href="shop.php">Moschino</a></li>
                                            <li><a class="product-brand" href="shop.php">Nike</a></li>
                                            <li><a class="product-brand" href="shop.php">Versace</a></li>
                                            <li><a class="product-brand" href="shop.php">Alexander McQueen</a></li>
                                            <li><a class="product-brand" href="shop.php">Adidas</a></li>
                                            <li><a class="product-brand" href="shop.php">Balenciaga</a></li>
                                            <li><a class="product-brand" href="shop.php">Balmain</a></li>
                                            <li><a class="product-brand" href="shop.php">Burberry</a></li>
                                            <li><a class="product-brand" href="shop.php">Chloé</a></li>
                                            <li><a class="product-brand" href="shop.php">Dsquared2</a></li>
                                            <li><a class="product-brand" href="shop.php">Givenchy</a></li>
                                            <li><a class="product-brand" href="shop.php">Kenzo</a></li>
                                            <li><a class="product-brand" href="shop.php">Leo</a></li>
                                            <li><a class="product-brand" href="shop.php">Maison Margiela</a></li>
                                            <li><a class="product-brand" href="shop.php">Moschino</a></li>
                                            <li><a class="product-brand" href="shop.php">Nike</a></li>
                                            <li><a class="product-brand" href="shop.php">Versace</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <a href="shop.php" class="banner-item">
                                <div class="banner-inner">
                                    <span class="pretitle">Winter Fashion</span>
                                    <h1 class="title">Behind the
                                        deseart</dih1v>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ..::Shop Section Section End Here::.. -->
     
@endsection