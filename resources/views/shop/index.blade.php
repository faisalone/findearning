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
                <div class="col-xl-9 mx-auto">
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
                    @if($products->count() > 0)
						<div class="products-area products-area3">
							<div class="row justify-content-center">
								@foreach ($products as $product)
									<x-product-item :product="$product" />
								@endforeach
							</div>
						</div>
						<div class="d-flex justify-content-center mt-4">
							{{ $products->links() }}
						</div>
					@else
						<p class="text-center">No products available.</p>
					@endif
                </div>
            </div>
        </div>
    </div>
    <!-- ..::Shop Section Section End Here::.. -->
@endsection