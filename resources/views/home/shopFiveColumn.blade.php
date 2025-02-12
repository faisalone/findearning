@extends('layout.layout')

@php
    $css = '<link rel="stylesheet" href="' . asset('assets/css/variables/variable4.css') . '"/>
            <link rel="stylesheet" href="' . asset('assets/css/jquery.nstSlider.min.css') . '"/>';
    $title='Shop Five Column';
    $subTitle = 'Home';
    $subTitle2 = 'Shop Five Column';
    $script = '<script src="' . asset('assets/js/vendors/zoom.js') . '"></script>';
    

@endphp

@section('content')

    <!-- ..::Shop Section Start Here::.. -->
    <div class="rts-shop-section section-gap">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="shop-product-topbar">
                        <span class="items-onlist"><span>112</span> Item On List</span>
                        <div class="filter-area">
                            <button class="product-filter"><i class="fas fa-list"></i> Filter</button>
                            <div class="separator"></div>
                            <div class="product-show">Show<select>
                                    <option value="1">12</option>
                                    <option value="2">8</option>
                                    <option value="3">6</option>
                                    <option value="4">4</option>
                                </select></div>
                            <button class="grid-btn"><img src="{{ asset('assets/images/icons/grid-icon.png') }}"
                                    alt="grid-icon"></button>
                            <button class="list-btn"><img src="{{ asset('assets/images/icons/list-icon.png') }}"
                                    alt="list-icon"></button>
                        </div>
                    </div>
                    <div class="rts-recent_products-section">
                        <div class="container">
                            <div class="products-area">
                                <div class="row">
                                    <div class="col-lg-15 col-md-4 col-sm-6">
                                        <div class="product-item element-item1">
                                            <a href="{{ route('productDetails') }}" class="product-image image-hover-variations">
                                                <div class="image-vari1 image-vari"><img src="{{ asset('assets/images/products/1.jpg') }}"
                                                        alt="product-image">
                                                </div>
                                                <div class="image-vari2 image-vari"><img src="{{ asset('assets/images/products/1_2.jpg') }}"
                                                        alt="product-image">
                                                </div>
                                            </a>
                                            <div class="bottom-content">
                                                <a href="{{ route('productDetails') }}" class="product-name">Adapt Camo Seamless Shorts</a>
                                                <div class="action-wrap">
                                                    <span class="product-price">$31.00 <span class="old-price">$43.00</span></span>
                                                    <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i> Add To
                                                        Cart</a>
                                                </div>
                                            </div>
                                            <div class="product-features">
                                                <div class="new-tag product-tag">NEW</div>
                                                <div class="discount-tag product-tag">-35%</div>
                                            </div>
                                            <div class="product-actions">
                                                <a href="wishlist.php" class="product-action"><i class="fal fa-heart"></i></a>
                                                <button class="product-action product-details-popup-btn"><i
                                                        class="fal fa-eye"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-15 col-md-4 col-sm-6">
                                        <div class="product-item element-item2">
                                            <a href="{{ route('productDetails') }}" class="product-image image-slider-variations">
                                                <div class="swiper productSlide">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide">
                                                            <div class="image-vari1 image-vari"><img src="{{ asset('assets/images/products/2.jpg') }}"
                                                                    alt="product-image">
                                                            </div>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <div class="image-vari2 image-vari"><img
                                                                    src="{{ asset('assets/images/products/2_1.jpg') }}" alt="product-image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="slider-buttons">
                                                    <div class="button-prev slider-btn"><i class="fal fa-long-arrow-left"></i></div>
                                                    <div class="button-next slider-btn"><i class="fal fa-long-arrow-right"></i></div>
                                                </div>
                                            </a>
                                            <div class="bottom-content">
                                                <a href="{{ route('productDetails') }}" class="product-name">Seamless Sports Bra Smokey Grey
                                                    Marl</a>
                                                <div class="action-wrap">
                                                    <span class="product-price">$31.00</span>
                                                    <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i> Add To
                                                        Cart</a>
                                                </div>
                                            </div>
                                            <div class="product-actions">
                                                <a href="wishlist.php" class="product-action"><i class="fal fa-heart"></i></a>
                                                <button class="product-action product-details-popup-btn"><i
                                                        class="fal fa-eye"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-15 col-md-4 col-sm-6">
                                        <div class="product-item element-item3 popular">
                                            <a href="{{ route('productDetails') }}" class="product-image image-gallery-variations">
                                                <div class="swiper productGallerySlide">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide">
                                                            <div class="image-vari1 image-vari"><img src="{{ asset('assets/images/products/3.jpg') }}"
                                                                    alt="product-image">
                                                            </div>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <div class="image-vari2 image-vari"><img
                                                                    src="{{ asset('assets/images/products/3_1.jpg') }}" alt="product-image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="thumbs-area">
                                                <div class="swiper productGallerySlideThumb">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide">
                                                            <div class="image-vari1 image-vari"><img src="{{ asset('assets/images/products/3.jpg') }}"
                                                                    alt="product-image">
                                                            </div>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <div class="image-vari2 image-vari"><img
                                                                    src="{{ asset('assets/images/products/3_1.jpg') }}" alt="product-image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bottom-content">
                                                <a href="{{ route('productDetails') }}" class="product-name">Camo Seamless Racer Back Sports</a>
                                                <div class="action-wrap">
                                                    <span class="product-price">$31.00 <span class="old-price">$43.00</span></span>
                                                    <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i> Add To
                                                        Cart</a>
                                                </div>
                                            </div>
                                            <div class="product-features">
                                                <div class="hot-tag product-tag">HOT</div>
                                                <div class="discount-tag product-tag">-35%</div>
                                            </div>
                                            <div class="product-actions">
                                                <a href="wishlist.php" class="product-action"><i class="fal fa-heart"></i></a>
                                                <button class="product-action product-details-popup-btn"><i
                                                        class="fal fa-eye"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-15 col-md-4 col-sm-6">
                                        <div class="product-item element-item1">
                                            <a href="{{ route('productDetails') }}" class="product-image image-hover-variations">
                                                <div class="image-vari1 image-vari"><img src="{{ asset('assets/images/products/4.jpg') }}"
                                                        alt="product-image">
                                                </div>
                                                <div class="image-vari2 image-vari"><img src="{{ asset('assets/images/products/4_1.jpg') }}"
                                                        alt="product-image">
                                                </div>
                                            </a>
                                            <div class="bottom-content">
                                                <a href="{{ route('productDetails') }}" class="product-name">Marl Seamless Long Sleeve Crop
                                                    Top</a>
                                                <div class="action-wrap">
                                                    <span class="product-price">$31.00</span>
                                                    <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i> Add To
                                                        Cart</a>
                                                </div>
                                            </div>
                                            <div class="product-actions">
                                                <a href="wishlist.php" class="product-action"><i class="fal fa-heart"></i></a>
                                                <button class="product-action product-details-popup-btn"><i
                                                        class="fal fa-eye"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-15 col-md-4 col-sm-6">
                                        <div class="product-item element-item1">
                                            <a href="{{ route('productDetails') }}" class="product-image image-hover-variations">
                                                <div class="image-vari1 image-vari"><img src="{{ asset('assets/images/products/5.jpg') }}"
                                                        alt="product-image">
                                                </div>
                                                <div class="image-vari2 image-vari"><img src="{{ asset('assets/images/products/5_1.jpg') }}"
                                                        alt="product-image">
                                                </div>
                                            </a>
                                            <div class="bottom-content">
                                                <a href="{{ route('productDetails') }}" class="product-name">Adapt Camo Seamless Shorts</a>
                                                <div class="action-wrap">
                                                    <span class="product-price">$31.00</span>
                                                    <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i> Add To
                                                        Cart</a>
                                                </div>
                                            </div>
                                            <div class="product-actions">
                                                <a href="wishlist.php" class="product-action"><i class="fal fa-heart"></i></a>
                                                <button class="product-action product-details-popup-btn"><i
                                                        class="fal fa-eye"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-15 col-md-4 col-sm-6">
                                        <div class="product-item element-item1">
                                            <a href="{{ route('productDetails') }}" class="product-image image-hover-variations">
                                                <div class="image-vari1 image-vari"><img src="{{ asset('assets/images/products/6.jpg') }}"
                                                        alt="product-image">
                                                </div>
                                                <div class="image-vari2 image-vari"><img src="{{ asset('assets/images/products/6_1.jpg') }}"
                                                        alt="product-image">
                                                </div>
                                            </a>
                                            <div class="bottom-content">
                                                <a href="{{ route('productDetails') }}" class="product-name">Seamless Sports Bra Smokey Grey
                                                    Mar</a>
                                                <div class="action-wrap">
                                                    <span class="product-price">$31.00</span>
                                                    <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i> Add To
                                                        Cart</a>
                                                </div>
                                            </div>
                                            <div class="product-actions">
                                                <a href="wishlist.php" class="product-action"><i class="fal fa-heart"></i></a>
                                                <button class="product-action product-details-popup-btn"><i
                                                        class="fal fa-eye"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-15 col-md-4 col-sm-6">
                                        <div class="product-item element-item1">
                                            <a href="{{ route('productDetails') }}" class="product-image image-hover-variations">
                                                <div class="image-vari1 image-vari"><img src="{{ asset('assets/images/products/7.jpg') }}"
                                                        alt="product-image">
                                                </div>
                                                <div class="image-vari2 image-vari"><img src="{{ asset('assets/images/products/7_1.jpg') }}"
                                                        alt="product-image">
                                                </div>
                                            </a>
                                            <div class="bottom-content">
                                                <a href="{{ route('productDetails') }}" class="product-name">Vital Seamless 2.0 Vest Yellow
                                                    Marl</a>
                                                <div class="action-wrap">
                                                    <span class="product-price">$31.00</span>
                                                    <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i> Add To
                                                        Cart</a>
                                                </div>
                                            </div>
                                            <div class="product-actions">
                                                <a href="wishlist.php" class="product-action"><i class="fal fa-heart"></i></a>
                                                <button class="product-action product-details-popup-btn"><i
                                                        class="fal fa-eye"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-15 col-md-4 col-sm-6">
                                        <div class="product-item element-item1">
                                            <a href="{{ route('productDetails') }}" class="product-image image-hover-variations">
                                                <div class="image-vari1 image-vari"><img src="{{ asset('assets/images/products/8.jpg') }}"
                                                        alt="product-image">
                                                </div>
                                                <div class="image-vari2 image-vari"><img src="{{ asset('assets/images/products/8_1.jpg') }}"
                                                        alt="product-image">
                                                </div>
                                            </a>
                                            <div class="bottom-content">
                                                <a href="{{ route('productDetails') }}" class="product-name">Adapt Ombre Seamless Leggings</a>
                                                <div class="action-wrap">
                                                    <span class="product-price">$31.00</span>
                                                    <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i> Add To
                                                        Cart</a>
                                                </div>
                                            </div>
                                            <div class="product-actions">
                                                <a href="wishlist.php" class="product-action"><i class="fal fa-heart"></i></a>
                                                <button class="product-action product-details-popup-btn"><i
                                                        class="fal fa-eye"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-15 col-md-4 col-sm-6">
                                        <div class="product-item element-item2">
                                            <a href="{{ route('productDetails') }}" class="product-image image-slider-variations">
                                                <div class="swiper productSlide2">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide">
                                                            <div class="image-vari1 image-vari"><img src="{{ asset('assets/images/products/9.jpg') }}"
                                                                    alt="product-image">
                                                            </div>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <div class="image-vari2 image-vari"><img
                                                                    src="{{ asset('assets/images/products/9_1.jpg') }}" alt="product-image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="slider-buttons">
                                                    <div class="button-prev2 slider-btn"><i class="fal fa-long-arrow-left"></i></div>
                                                    <div class="button-next2 slider-btn"><i class="fal fa-long-arrow-right"></i></div>
                                                </div>
                                            </a>
                                            <div class="bottom-content">
                                                <a href="{{ route('productDetails') }}" class="product-name">WTFlex Seamless Asymmetric
                                                    Strappy</a>
                                                <div class="action-wrap">
                                                    <span class="product-price">$31.00</span>
                                                    <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i> Add To
                                                        Cart</a>
                                                </div>
                                            </div>
                                            <div class="product-actions">
                                                <a href="wishlist.php" class="product-action"><i class="fal fa-heart"></i></a>
                                                <button class="product-action product-details-popup-btn"><i
                                                        class="fal fa-eye"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-15 col-md-4 col-sm-6">
                                        <div class="product-item element-item3 popular">
                                            <a href="{{ route('productDetails') }}" class="product-image image-gallery-variations">
                                                <div class="swiper productGallerySlide2">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide">
                                                            <div class="image-vari1 image-vari"><img src="{{ asset('assets/images/products/10.jpg') }}"
                                                                    alt="product-image">
                                                            </div>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <div class="image-vari2 image-vari"><img
                                                                    src="{{ asset('assets/images/products/10_1.jpg') }}" alt="product-image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="thumbs-area">
                                                <div class="swiper productGallerySlideThumb2">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide">
                                                            <div class="image-vari1 image-vari"><img src="{{ asset('assets/images/products/10.jpg') }}"
                                                                    alt="product-image">
                                                            </div>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <div class="image-vari2 image-vari"><img
                                                                    src="{{ asset('assets/images/products/10_1.jpg') }}" alt="product-image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bottom-content">
                                                <a href="{{ route('productDetails') }}" class="product-name">Asymmetric Strappy Sports Bra</a>
                                                <div class="action-wrap">
                                                    <span class="product-price">$31.00</span>
                                                    <a href="cart.php" class="addto-cart"><i class="fal fa-shopping-cart"></i> Add To
                                                        Cart</a>
                                                </div>
                                            </div>
                                            <div class="product-features">
                                                <div class="new-tag product-tag">NEW</div>
                                            </div>
                                            <div class="product-actions">
                                                <a href="wishlist.php" class="product-action"><i class="fal fa-heart"></i></a>
                                                <button class="product-action product-details-popup-btn"><i
                                                        class="fal fa-eye"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ..::Recent Products Section End Here::.. -->

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
            </div>
        </div>
    </div>
    <!-- ..::Shop Section Section End Here::.. -->

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
                                style="background-image: url('{{ asset('assets/images/products/product-details.jpg') }}')"><img
                                    src="{{ asset('assets/images/products/product-details.jpg') }}" alt="product-thumb">
                            </div>
                        </div>
                        <div class="thumb-wrapper two filterd-items hide">
                            <div class="product-thumb zoom" onmousemove="zoom(event)"
                                style="background-image: url('{{ asset('assets/images/products/product-filt2.jpg') }}')"><img
                                    src="{{ asset('assets/images/products/product-filt2.jpg') }}" alt="product-thumb">
                            </div>
                        </div>
                        <div class="thumb-wrapper three filterd-items hide">
                            <div class="product-thumb zoom" onmousemove="zoom(event)"
                                style="background-image: url('{{ asset('assets/images/products/product-filt3.jpg') }}')"><img
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
                            <a href="cart.php" class="addto-cart-btn action-item"><i class="rt-basket-shopping"></i>
                                Add To
                                Cart</a>
                            <a href="wishlist.php" class="wishlist-btn action-item"><i class="rt-heart"></i></a>
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

@endsection