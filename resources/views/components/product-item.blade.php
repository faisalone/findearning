<div class="col-xl-3 col-md-3 col-sm-6">
	<div class="product-item product-item2 element-item3">
		<a href="{{ route('productDetails', ['category' => $product->category->slug, 'product' => $product->slug]) }}" class="product-image">
			<img src="{{ $product->imagePaths[0]['url'] }}" alt="{{ $product->title }}">
		</a>
		<div class="bottom-content">
			<a href="{{ route('productDetails', ['category' => $product->category->slug, 'product' => $product->slug]) }}" class="product-name">{{ $product->title }}</a>
			<div class="product-price-area">
				<span class="product-price">{{ $product->price }}$</span>
			</div>
		</div>
	</div>
</div>