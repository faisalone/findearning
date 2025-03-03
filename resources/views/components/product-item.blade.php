<div class="col-6 col-sm-6 col-md-4 col-lg-3 text-center">
    <div class="product-item mx-auto">
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