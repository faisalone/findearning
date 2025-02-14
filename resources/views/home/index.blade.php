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
				<x-banner />
			</div>
		</div>
	</div>
</div>
<!-- ..::Banner Section End Here::.. -->

<!-- ..::New Collection Section Start Here::.. -->
<x-category :categories="$categories" />
<!-- ..::New Collection Section End Here::.. -->

<x-product :products="$randomProducts" />

<x-newslettter />

<x-brand />

@endsection