<div class="rts-new-collection-section section9 section-10">
	<div class="container">
		<div class="section-inner">
			<div class="section-header section-header3 section-header9 text-center">
				<div class="wrapper">
					<h2 class="title">Product of the Week</h2>
				</div>
			</div>
			<div class="swiper rts-cmmnSlider-over" data-swiper="pagination">
				<div class="swiper-wrapper">
					@foreach ($products as $product)
					<div class="swiper-slide">
						<div class="collection-item">
							<div class="product-image">
								@if($product->images->isNotEmpty())
									<a href="{{ route('productDetails', ['category' => $product->category->slug, 'product' => $product->slug]) }}">
										<img src="{{ $product->imagePaths[0]['url'] }}" alt="{{ $product->title }}">
									</a>
								@else
									<span>No Image</span>
								@endif

							</div>
							<div class="bottom-content">
								<h4 class="product-name">
									<a class="text-white" href="{{ route('productDetails', ['category' => $product->category->slug, 'product' => $product->slug]) }}">
										{{ $product->title }}
									</a>
								</h4>
								<p class="price">${{ $product->price }}</p>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
			<div class="swiper-pag">
			</div>
		</div>
	</div>
</div>