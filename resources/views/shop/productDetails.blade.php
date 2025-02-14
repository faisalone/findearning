@extends('layout.layout')

@php
    $title='Product';
    $subTitle = 'Shop';
    $subTitle2 = 'Product';
    $script= '<script src="' . asset('assets/js/vendors/zoom.js') . '"></script>';
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
                                        <img class="img-fluid" src="{{ asset($img['url']) }}" alt="{{ $product->images[$index]['alt_text'] ?? 'product-thumb' }}" style="object-fit: cover; width: 100%; height: 100%;">
                                    </div>
                                </div>
                            @endforeach

                            <div class="product-thumb-filter-group">
                                @foreach($product->imagePaths as $index => $img)
                                    @php
                                        $class = $mapping[$index] ?? ('img-' . ($index + 1));
                                    @endphp
                                    <div class="thumb-filter filter-btn {{ $index === 0 ? 'active' : '' }}" data-show=".{{ $class }}">
                                        <img class="img-fluid" src="{{ asset($img['url']) }}" alt="product-thumb-filter" style="object-fit: cover; width: 100%; height: 100%;">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="contents">
                            <div class="product-status">
                                <span class="product-catagory">{{ $product->category->title }}</span>
                                {{-- <div class="rating-stars-group">
                                    <div class="rating-star"><i class="fas fa-star"></i></div>
                                    <div class="rating-star"><i class="fas fa-star"></i></div>
                                    <div class="rating-star"><i class="fas fa-star-half-alt"></i></div>
                                    <span>10 Reviews</span>
                                </div> --}}
                            </div>
                            <h2 class="product-title">{{ $product->title }} <span class="stock">In Stock</span></h2>
                            <span class="product-price"><span class="old-price">{{ $product->price }}</span> {{ $product->price }}</span>
                            <p>
                                {{ $product->description }}
                            </p>
                            <div class="product-bottom-action">
                                <div class="cart-edit">
                                    <div class="cart-edit">
                                        <div class="quantity-edit action-item">
                                            <button class="button" type="button"><i class="fal fa-minus minus"></i></button>
                                            <!-- Add an id so we can reference the visible quantity -->
                                            <input type="text" id="quantity-input" name="visible_quantity" class="input" value="1" />
                                            <button class="button plus" type="button">+<i class="fal fa-plus plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <form id="add-to-cart-form" action="{{ route('shop.addToCart') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <!-- Hidden field to receive the quantity -->
                                    <input type="hidden" name="quantity" id="hidden-quantity" value="1">
                                    <button type="submit" class="addto-cart-btn action-item">
                                        <i class="rt-basket-shopping"></i> Add To Cart
                                    </button>
                                </form>
                            </div>
                            <script>
                                const visibleQtyInput = document.getElementById('quantity-input');
                                document.getElementById('add-to-cart-form').addEventListener('submit', function(e) {
                                    e.preventDefault();
                                    // Copy the visible input value to the hidden input before submitting.
                                    document.getElementById('hidden-quantity').value = visibleQtyInput.value;
                                    let form = this;
                                    let formData = new FormData(form);
                                    fetch(form.action, {
                                        method: 'POST',
                                        headers: { 'X-Requested-With': 'XMLHttpRequest' },
                                        body: formData
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if(document.getElementById('cart-count')) {
                                            document.getElementById('cart-count').textContent = data.count;
                                        }
                                        if(document.getElementById('mobile-cart-count')) {
                                            document.getElementById('mobile-cart-count').textContent = data.count;
                                        }
                                    })
                                    .catch(error => console.error('Error:', error));
                                });
                            </script>

                            <x-social />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ..::Product-details Section End Here::.. -->

    {{-- <div class="rts-account-section"></div> --}}

@endsection