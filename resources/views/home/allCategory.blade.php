@extends('layout.layout')

@php
    $css = '<link rel="stylesheet" href="' . asset('assets/css/variables/variable4.css') . '"/>';
    $title='All Catagory';
    $subTitle = 'Home';
    $subTitle2 = 'All Catagory';
@endphp

@section('content')

    <!-- ..::Newsletter Section Start Here::.. -->
    <div class="rts-best-catagory-section2 section-gap">
        <div class="container">
            <div class="row justify-content-center">
				@foreach ($categories as $category)
				<div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="catagory-card">
                        <div class="contents">
							<h3 class="catagory-title"><a href="{{ route('shop.category', $category->slug) }}">{{ $category->title }}</a></h3>
							<div class="category-thumb mb-3">
								<img src="{{ $category->imagePath }}" alt="category-thumb">
							</div>
                            <a href="{{ route('shop.category', $category->slug) }}" class="all-btn">All {{ $category->title }} <i class="fal fa-long-arrow-right ml--5"></i></a>
                        </div>
                    </div>
                </div>
				@endforeach
            </div>
        </div>
    </div>
    <!-- ..::Newsletter Section End Here::.. -->

@endsection