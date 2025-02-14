@props(['categories' => []])

<div class="rts-new-collection-section section-gap">
    <div class="container">
        <div class="recent-products-header section-header">
        </div>
        <div class="swiper rts-cmmnSlider-over" data-swiper="pagination">
            <div class="swiper-wrapper">
				@foreach($categories as $category)
                <div class="swiper-slide">
                    <div class="collection-item">
                        <a href="{{ route('shop.category', $category->slug ) }}">
							<img src="{{ $category->imagePath }}" alt="{{ $category->title }}" class="img-fluid img-cover">
                        </a>
                        <p class="item-quantity">20 <span>items</span></p>
                        <a href="{{ route('shop.category', $category->slug ) }}" class="item-catagory-box">
                            <h3 class="title">{{ $category->title }}</h3>
                        </a>
                    </div>
                </div>
				@endforeach
            </div>
        </div>
    </div>
</div>