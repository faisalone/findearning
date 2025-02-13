@props(['categories' => []])
@foreach($categories as $category)
<div class="col-xl-3 col-md-4 col-sm-6 col-12">
	<div class="product-item element-item1">
		<a href="{{ $category->detailsLink ?? route('productDetails', $category->slug ?? null) }}" class="product-image">
			<div class="image-vari1 image-vari">
				<img src="{{ $category->imagePath }}" alt="{{ $category->title }}" class="img-fluid img-cover">
			</div>
		</a>
		<div class="bottom-content">
			<a href="{{ $category->detailsLink ?? route('productDetails', $category->slug ?? null) }}" class="product-name">
				{{ $category->title ?? 'Online Action Game' }}
			</a>
		</div>
	</div>
</div>
@endforeach