@extends('layout.layout')

@php
    $css = '<link rel="stylesheet" href="' . asset('assets/css/variables/variable4.css') . '"/>
            <link rel="stylesheet" href="' . asset('assets/css/jquery.nstSlider.min.css') . '"/>';
    $title='Shop';
    $subTitle = 'Shop';
    $subTitle2 = 'Shop';
    $script= '<script src="' . asset('assets/js/vendors/zoom.js') . '"></script>
              <script src="' . asset('assets/js/vendors/jquery.nstSlider.min.js') . '"></script>';
@endphp

@section('content')

    <!-- ..::Shop Section Start Here::.. -->
    <div class="rts-shop-section">
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
                            <div class="col-xl-4 col-md-4 col-sm-6">
                                <x-product-item :products="$category->products" />
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
                                    <span class="action-title">PRODUCT CATEGORY</span>
                                </div>
                                <div class="category-item">
                                    <div class="category-item-inner">
                                        <div class="category-title-area">
                                            <span class="point"></span>
                                            <span class="category-title">Kids (10)</span>
                                        </div>
                                        <div class="down-icon"><i class="far fa-angle-down"></i></div>
                                    </div>
                                    <div class="sub-categorys">
                                        <ul class="sub-categorys-inner">
                                            <li><span class="point"></span><a href="{{ route('shop') }}">Clothes</a></li>
                                            <li><span class="point"></span><a href="{{ route('shop') }}">Shoes</a></li>
                                            <li><span class="point"></span><a href="{{ route('shop') }}">Toys</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="category-item">
                                    <div class="category-item-inner">
                                        <div class="category-title-area">
                                            <span class="point"></span>
                                            <span class="category-title">Mens (23)</span>
                                        </div>
                                        <div class="down-icon"><i class="far fa-angle-down"></i></div>
                                    </div>
                                    <div class="sub-categorys">
                                        <ul class="sub-categorys-inner">
                                            <li><span class="point"></span><a href="{{ route('shop') }}">Clothes</a></li>
                                            <li><span class="point"></span><a href="{{ route('shop') }}">Shoes</a></li>
                                            <li><span class="point"></span><a href="{{ route('shop') }}">Glasses</a></li>
                                            <li><span class="point"></span><a href="{{ route('shop') }}">Watches</a></li>
                                            <li><span class="point"></span><a href="{{ route('shop') }}">Assesories</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="category-item">
                                    <div class="category-item-inner">
                                        <div class="category-title-area">
                                            <span class="point"></span>
                                            <span class="category-title">Women (14)</span>
                                        </div>
                                        <div class="down-icon"><i class="far fa-angle-down"></i></div>
                                    </div>
                                    <div class="sub-categorys">
                                        <ul class="sub-categorys-inner">
                                            <li><span class="point"></span><a href="{{ route('shop') }}">Clothes</a></li>
                                            <li><span class="point"></span><a href="{{ route('shop') }}">Shoes</a></li>
                                            <li><span class="point"></span><a href="{{ route('shop') }}">Glasses</a></li>
                                            <li><span class="point"></span><a href="{{ route('shop') }}">Makeups</a></li>
                                            <li><span class="point"></span><a href="{{ route('shop') }}">Assesories</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="action-item">
                                <div class="action-top">
                                    <span class="action-title">FILTER BY PRICE</span>
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
                                    <span class="action-title">FILTER BY COLOR</span>
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
                                    <span class="action-title">FILTER BY BRAND</span>
                                </div>
                                <div class="product-brands">
                                    <div class="brands-inner">
                                        <ul>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Alexander McQueen</a></li>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Adidas</a></li>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Balenciaga</a></li>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Balmain</a></li>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Burberry</a></li>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Chloé</a></li>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Dsquared2</a></li>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Givenchy</a></li>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Kenzo</a></li>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Leo</a></li>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Maison Margiela</a></li>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Moschino</a></li>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Nike</a></li>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Versace</a></li>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Alexander McQueen</a></li>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Adidas</a></li>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Balenciaga</a></li>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Balmain</a></li>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Burberry</a></li>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Chloé</a></li>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Dsquared2</a></li>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Givenchy</a></li>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Kenzo</a></li>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Leo</a></li>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Maison Margiela</a></li>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Moschino</a></li>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Nike</a></li>
                                            <li><a class="product-brand" href="{{ route('shop') }}">Versace</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('shop') }}" class="banner-item">
                                    <div class="banner-inner">
                                        <span class="pretitle">Winter Fashion</span>
                                        <h1 class="title">Behind the
                                            deseart</h1>
                                    </div>
                                </a>
                            </div>
                        </div>
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

@endsection