@extends('layout.layout')

@php
    $title = 'News';
    $subTitle='Blog';
    $subTitle2='News';
@endphp

@section('content')

    <!--news-feed-area start-->
    <section class="news-feed-area pt-120 pb-75 pt-md-60 pb-md-15 pt-xs-50 pb-xs-10">
        <div class="container">
            <div class="row mb-15">
                <div class="col-lg-8 pe-xl-0">
                    <div class="news-left">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="feed-item2">
                                    <a href="{{ route('newsDetails') }}" class="feed-image"><img
                                            src="{{ asset('assets/images/featured/img-1.jpg') }}" alt="feed-image"></a>
                                    <div class="feed-content">
                                        <span class="feed-catagory">Winter Dress</span>
                                        <div class="author"><img src="{{ asset('assets/images/featured/author.png') }}" alt=""> PixcelsThemes</div>
                                        <h2 class="feed-title"><a href="{{ route('newsDetails') }}">Once determined you need to come up with a name</a></h2>
                                        <p>The term electronic commerce (ecommerce) refers to a business model that allows companies and individuals to buy and sell goods and services over the Internet. Ecommerce operates in four...</p>
                                        <div class="feed-info">
                                            <span class="feed-date">
                                                <i class="rt-calendar-days"></i> March 23, 2021</span>
                                            <span class="comments"><i class="rt-comments"></i>0 Comment</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="feed-item2">
                                    <a href="{{ route('newsDetails') }}" class="feed-image"><img
                                            src="{{ asset('assets/images/featured/img-2.jpg') }}" alt="feed-image"></a>
                                    <div class="feed-content">
                                        <span class="feed-catagory">Winter Dress</span>
                                        <div class="author"><img src="{{ asset('assets/images/featured/author.png') }}" alt=""> PixcelsThemes</div>
                                        <h2 class="feed-title"><a href="{{ route('newsDetails') }}">Legal structure, can make profit buisness</a></h2>
                                        <p>Re-engagement — objectives. As developers, we rightfully obsess about the customer experience, relentlessly working to squeeze every millisecond out of the critical rendering path, optimize input latency, and eliminate...</p>
                                        <div class="feed-info">
                                            <span class="feed-date">
                                                <i class="rt-calendar-days"></i> March 23, 2021</span>
                                            <span class="comments"><i class="rt-comments"></i>0 Comment</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="feed-item2">
                                    <a href="{{ route('newsDetails') }}" class="feed-image"><img
                                            src="{{ asset('assets/images/featured/img-3.jpg') }}" alt="feed-image"></a>
                                    <div class="feed-content">
                                        <span class="feed-catagory">Winter Dress</span>
                                        <div class="author"><img src="{{ asset('assets/images/featured/author.png') }}" alt=""> PixcelsThemes</div>
                                        <h2 class="feed-title"><a href="{{ route('newsDetails') }}">At the limit, statically generated, edge a food</a></h2>
                                        <p>Re-engagement — objectives. As developers, we rightfully obsess about the customer experience, relentlessly working to squeeze every millisecond out of the critical rendering path, optimize input latency, and eliminate...</p>
                                        <div class="feed-info">
                                            <span class="feed-date">
                                            <i class="rt-calendar-days"></i> March 23, 2021</span>
                                            <span class="comments"><i class="rt-comments"></i>0 Comment</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="feed-item2">
                                    <a href="{{ route('newsDetails') }}" class="feed-image"><img
                                            src="{{ asset('assets/images/blog/img-1.jpg') }}" alt="feed-image"></a>
                                    <div class="feed-content">
                                        <span class="feed-catagory">Smart Dress</span>
                                        <div class="author"><img src="{{ asset('assets/images/featured/author.png') }}" alt=""> PixcelsThemes</div>
                                        <h2 class="feed-title"><a href="{{ route('newsDetails') }}">Best red carpet looks from the NAACP image Awards is nominate.</a></h2>
                                        <p>A great commerce experience cannot be distilled to a single number. It’s not a Lighthouse score, or a set of Core Web Vitals figures, although both are important inputs....</p>
                                        <div class="feed-info">
                                            <span class="feed-date">
                                            <i class="rt-calendar-days"></i> March 23, 2021</span>
                                            <span class="comments"><i class="rt-comments"></i>0 Comment</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="feed-item2">
                                    <a href="{{ route('newsDetails') }}" class="feed-image"><img
                                            src="{{ asset('assets/images/blog/img-2.jpg') }}" alt="feed-image"></a>
                                    <div class="feed-content">
                                        <span class="feed-catagory">Smart Dress</span>
                                        <div class="author"><img src="{{ asset('assets/images/featured/author.png') }}" alt=""> PixcelsThemes</div>
                                        <h2 class="feed-title"><a href="{{ route('newsDetails') }}">Cloth red carpet looks from the ACP image Awards is worldwide.</a></h2>
                                        <p>A great commerce experience cannot be distilled to a single number. It’s not a Lighthouse score, or a set of Core Web Vitals figures, although both are important inputs....</p>
                                        <div class="feed-info">
                                            <span class="feed-date"><i class="rt-calendar-days"></i> March 23, 2021</span>
                                            <span class="comments"><i class="rt-comments"></i>0 Comment</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="feed-item2">
                                    <a href="{{ route('newsDetails') }}" class="feed-image"><img
                                            src="{{ asset('assets/images/blog/img-3.jpg') }}" alt="feed-image"></a>
                                    <div class="feed-content">
                                        <span class="feed-catagory">Smart Dress</span>
                                        <div class="author"><img src="{{ asset('assets/images/featured/author.png') }}" alt=""> PixcelsThemes</div>
                                        <h2 class="feed-title"><a href="{{ route('newsDetails') }}">Modern young boy looks from the nice image position is late.</a></h2>
                                        <p>A great commerce experience cannot be distilled to a single number. It’s not a Lighthouse score, or a set of Core Web Vitals figures, although both are important inputs....</p>
                                        <div class="feed-info">
                                            <span class="feed-date">
                                            <i class="rt-calendar-days"></i> March 23, 2021</span>
                                            <span class="comments"><i class="rt-comments"></i>0 Comment</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center text-center mb-30">
                            <div class="col-lg-12">
                                <div class="page-navigation">
                                    <ul class="pagination">
                                        <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                        <li class="page-item1"><a class="page-link" href="#">02</a></li>
                                        <li class="page-item"><a class="page-link" href="#"><i class="far fa-chevron-double-right"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 pl-30 pl-lg-15 pl-md-15 pl-xs-15">
                    <div class="news-right-widget">
                        <div class="widget widget-search mb-40">
                            <div class="widget-title-box pb-25 mb-30">
                                <h4 class="widget-sub-title2 fs-20">Search Here</h4>
                            </div>
                            <form class="subscribe-form mb-10" action="#">
                                <input type="text" placeholder="Searching...">
                                <button class="widget-btn"><i class="fal fa-search"></i></button>
                            </form>
                        </div>
                        <div class="widget widget-post mb-40">
                            <div class="widget-title-box pb-25 mb-30">
                                <h4 class="widget-sub-title2 fs-20">Recent Posts</h4>
                            </div>
                            <ul class="post-list">
                                <li>
                                    <div class="blog-post mb-30">
                                        <a href="{{ route('newsDetails') }}"><img src="{{ asset('assets/images/blog/img-14.jpg') }}" alt="Post Img"></a>
                                        <div class="post-content">
                                            <h6 class="mb-10"><a href="{{ route('newsDetails') }}">Having education in
                                                    an area helps</a></h6>
                                            <span class="fs-14"><i class="fal fa-calendar-alt"></i> 24th March
                                                2024</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="blog-post mb-30">
                                        <a href="{{ route('newsDetails') }}"><img src="{{ asset('assets/images/blog/img-15.jpg') }}" alt="Post Img"></a>
                                        <div class="post-content">
                                            <h6 class="mb-10"><a href="{{ route('newsDetails') }}">People think, feel, &
                                                    behave in a way</a></h6>
                                            <span class="fs-14"><i class="fal fa-calendar-alt"></i> 24th March
                                                2024</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="blog-post mb-30">
                                        <a href="{{ route('newsDetails') }}"><img src="{{ asset('assets/images/blog/img-16.jpg') }}" alt="Post Img"></a>
                                        <div class="post-content">
                                            <h6 class="mb-10"><a href="{{ route('newsDetails') }}">That contributes to
                                                    their success</a></h6>
                                            <span class="fs-14"><i class="fal fa-calendar-alt"></i> 24th March
                                                2024</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="blog-post">
                                        <a href="{{ route('newsDetails') }}"><img src="{{ asset('assets/images/blog/img-17.jpg') }}" alt="Post Img"></a>
                                        <div class="post-content">
                                            <h6 class="mb-10"><a href="{{ route('newsDetails') }}">Improves not only
                                                    their personal</a></h6>
                                            <span class="fs-14"><i class="fal fa-calendar-alt"></i> 24th March
                                                2024</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="widget widget-categories-list mb-40">
                            <div class="widget-title-box pb-25 mb-30">
                                <h4 class="widget-sub-title2 fs-20">Categories</h4>
                            </div>
                            <ul class="list-none">
                                <li><a href="#">Business <span class="f-right">(1)</span></a></li>
                                <li><a href="#">Consultant <span class="f-right">(1)</span></a></li>
                                <li><a href="#">Creative <span class="f-right">(1)</span></a></li>
                                <li><a href="#">UI/UX <span class="f-right">(4)</span></a></li>
                                <li><a href="#">Technologys <span class="f-right">(3)</span></a></li>
                            </ul>
                        </div>
                        <div class="widget widget-categories-tag mb-40">
                            <div class="widget-title-box pb-25 mb-25">
                                <h4 class="widget-sub-title2 fs-20">Instagram Feeds</h4>
                            </div>
                            <div class="tag-list">
                                <a href="#">Popular</a>
                                <a href="#">Design</a>
                                <a href="#">UX</a>
                                <a href="#">Usability</a>
                                <a href="#">Develop</a>
                                <a href="#">Icon</a>
                                <a href="#">Business</a>
                                <a href="#">Consult</a>
                                <a href="#">Kit</a>
                                <a href="#">Keyboard</a>
                                <a href="#">Mouse</a>
                                <a href="#">Tech</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--news-feed-area end-->

@endsection