@extends('layout.layout')

@php
    $title = $product->title;
    $script = '<script src="' . asset('assets/js/vendors/zoom.js') . '"></script><script src="' . asset('assets/js/product-cart.js') . '"></script>';
    $css = '<link rel="stylesheet" href="' . asset('assets/css/variables/variable4.css') . '"/>';
@endphp

@section('content')
    <!-- ..::Product-details Section Start Here::.. -->
    <div class="rts-product-details-section section-gap">
        <div class="container">
            <div class="details-product-area mb--70">
                <div class="row justify-content-between align-items-start">
                    <!-- Product images section - centered -->
                    <div class="col-md-7 d-flex justify-content-center">
                        <div class="product-thumb-area" style="max-width: 550px; width: 100%;">
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
                    
                    <!-- Product information section -->
                    <div class="col-md-5">
                        <div class="contents d-flex flex-column justify-content-between h-100">
                            <div class="product-status">
                                <span class="product-catagory">{{ $product->category->title }}</span>
                                <div class="rating-stars-group d-flex align-items-center">
                                    <div class="stars-container">
                                        {!! $product->stars_html !!}
                                    </div>
                                    <span class="ms-2">
                                        {{ $product->reviews_count }} {{ $product->reviews_count === 1 ? 'Review' : 'Reviews' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Enhanced contact options -->
                            <div class="contact-options p-3 mb-3 rounded bg-light border">
                                <h6 class="mb-2"><i class="fas fa-question-circle me-2"></i>Have questions about this product?</h6>
                                <p class="small text-muted mb-3">Contact our team directly for quick assistance or share this product with others.</p>
                                <div class="d-flex justify-content-center justify-content-md-start flex-wrap gap-2">
                                    <a href="https://wa.me/?text={{ urlencode('Check out this product: ' . $product->title . ' - ' . url()->current()) }}" 
                                        target="_blank" 
                                        class="btn btn-sm btn-success d-inline-flex align-items-center">
                                        <i class="fab fa-whatsapp me-2"></i> WhatsApp
                                    </a>
									<a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode('Check out this product: ' . $product->title) }}" 
										target="_blank" 
										class="btn btn-sm d-inline-flex align-items-center text-white"
										style="background-color: #0088cc;">
										<i class="fab fa-telegram-plane me-2"></i> Telegram
									</a>
                                </div>
                            </div>

                            <h2 class="product-title">
                                {{ $product->title }}
                                @if($product->quantity > 0)
                                    @if($product->quantity > 5)
                                        <span class="stock text-success">In Stock</span>
                                    @else
                                        <span class="stock text-warning">Low Stock ({{ $product->quantity }} left)</span>
                                    @endif
                                @else
                                    <span class="stock text-danger">Out of Stock</span>
                                @endif
                            </h2>

                            <div class="d-flex justify-content-start align-items-center">
                                <span class="product-price">${{ $product->price }}</span>
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

                            <x-social />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews & Ratings Section Start -->
            <div class="row mb-5" id="review-section">
                <div class="col-lg-10 mx-auto">
                    <div class="ratings-review-section p-4 bg-light rounded shadow-sm">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                            <div class="ratings-display d-flex flex-column flex-md-row align-items-md-center">
                                <!-- Rating number and out of 5.0 text -->
                                <div class="d-flex align-items-center mb-2 mb-md-0 me-md-4">
                                    <span class="display-4 fw-bold">{{ $product->average_rating }}</span>
                                    <span class="ms-2 text-muted">out of 5.0</span>
                                </div>
                                
                                <!-- Stars and review count -->
                                <div class="d-flex align-items-center mb-3 mb-md-0">
                                    <div class="star-rating me-3">
                                        {!! $product->stars_html !!}
                                    </div>
                                    <div class="review-count">
                                        <span class="text-muted">({{ $product->reviews_count }} Reviews)</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Button in separate row on mobile -->
                            <div class="rate-product mt-2 mt-md-0">
                                @auth
                                    <button class="btn btn-primary w-100 w-md-auto" id="rate-product-btn">Rate This Product</button>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary w-100 w-md-auto">Rate This Product</a>
                                @endauth
                            </div>
                        </div>
                        
                        <!-- Individual Customer Reviews Section -->
                        <div class="customer-reviews mt-5">
                            <h4 class="mb-4">Customer Reviews</h4>
                            
                            @if($product->approvedReviews->count() > 0)
                                @foreach($product->approvedReviews as $review)
                                    <div class="review-item {{ !$loop->last ? 'mb-4 pb-4 border-bottom' : '' }}">
                                        <div class="d-flex flex-column flex-md-row">
                                            <div class="review-content flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <h5 class="mb-0">{{ $review->user->name }}</h5>
                                                    <span class="text-muted small">{{ $review->created_at->format('F j, Y') }}</span>
                                                </div>
                                                <div class="star-rating mb-2">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $review->rating)
                                                            <i class="fas fa-star text-warning"></i>
                                                        @else
                                                            <i class="far fa-star text-warning"></i>
                                                        @endif
                                                    @endfor
                                                    <span class="ms-2">({{ $review->rating }}.0)</span>
                                                </div>
                                                <p class="mb-0">{{ $review->comment }}</p>
                                            </div>
                                            @if($review->image_path)
                                                <div class="review-image ms-md-3 mt-3 mt-md-0">
                                                    <img src="{{ asset('storage/' . $review->image_path) }}" 
                                                        alt="Product Review Image" class="rounded-2 img-fluid" style="max-width: 120px; object-fit: contain;">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-4">
                                    <p class="text-muted">No reviews yet. Be the first to review this product!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Reviews & Ratings Section End -->

            <!-- Add Review Modal -->
            <div class="modal fade" id="addReviewModal" tabindex="-1" aria-labelledby="addReviewModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addReviewModalLabel">Write a Review</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="reviewForm" action="{{ route('product.addReview', $product) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-bold">{{ $product->title }}</label>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Rating</label>
                                    <div class="star-rating-input">
                                        <div class="rating-stars d-flex">
                                            <span class="rating-star-input me-2" data-value="1"><i class="far fa-star"></i></span>
                                            <span class="rating-star-input me-2" data-value="2"><i class="far fa-star"></i></span>
                                            <span class="rating-star-input me-2" data-value="3"><i class="far fa-star"></i></span>
                                            <span class="rating-star-input me-2" data-value="4"><i class="far fa-star"></i></span>
                                            <span class="rating-star-input me-2" data-value="5"><i class="far fa-star"></i></span>
                                            <input type="hidden" name="rating" id="ratingValue" value="0" required>
                                        </div>
                                        <small class="text-muted">Click on a star to rate</small>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="reviewComment" class="form-label">Comment</label>
                                    <textarea class="form-control" id="reviewComment" name="comment" rows="4" required placeholder="Write your review here..."></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="reviewImage" class="form-label">Upload Image (Optional)</label>
                                    <input type="file" class="form-control" id="reviewImage" name="image" accept="image/*">
                                    <div class="mt-2">
                                        <img id="imagePreview" src="#" alt="Preview" class="img-fluid rounded d-none" style="max-height: 150px; max-width: 100%;">
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Submit Review</button>
                                </div>
                            </form>
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