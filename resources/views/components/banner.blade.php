@props(['banners' => null])
@php
    $defaultBanners = [
        [
            'title' => 'CALL OF <br> DUTY GAMES',
            'image' => asset('assets/images/banner/banner-1.webp'),
            'link' => route('shop')
        ],
        [
            'title' => 'BLADEPOINT MORUS <br> CUP SEASON 2',
            'image' => asset('assets/images/banner/banner-1.webp'),
            'link' => route('shop')
        ],
        [
            'title' => 'NEW GAMES <br> FOR RANDOM CLICK',
            'image' => asset('assets/images/banner/banner-1.webp'),
            'link' => route('shop')
        ],
    ];
    $banners = $banners ?: $defaultBanners;
@endphp

<div class="col-xl-10 col-md-8 col-sm-12 gutter-2">
    <div class="swiper bannerSlide2">
        <div class="swiper-wrapper">
            @foreach($banners as $banner)
            <div class="swiper-slide">
                <div class="banner-single bg-image bg-image-3-1 bg-image-8-1" style="background-image: url('{{ $banner['image'] }}')">
                </div>
            </div>
            @endforeach
        </div>
        <div class="slider-navigation">
            <div class="swiper-button-prev slider-btn prev"><i class="rt rt-arrow-left-long"></i></div>
            <div class="swiper-button-next slider-btn next"><i class="rt rt-arrow-right-long"></i></div>
        </div>
    </div>
</div>