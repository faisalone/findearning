<div class="col-xl-3 col-md-4 col-sm-6">
	<div class="product-item product-item2 element-item3">
		<a href="#" class="product-image">
			<img src="{{ $product->imagePaths[0]['url'] }}" alt="{{ $product->title }}">
		</a>
		<div class="bottom-content">
			<a href="#" class="product-name">{{ $product->title }}</a>
			<div class="action-wrap">
				<span class="product-price">{{ $product->price }}</span>
				<a href="{{ route('cart') }}" class="addto-cart"><i class="fal fa-shopping-cart"></i> Add To
					Cart</a>
			</div>
		</div>
	</div>
</div>