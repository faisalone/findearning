@extends('layout.layout')

@php
    $title = 'News Details';
    $subTitle='Blog';
    $subTitle2='News Details';
@endphp

@section('content')

    <!--news-feed-area start-->
    <section class="news-feed-area pt-120 pb-75 pt-md-60 pb-md-15 pt-xs-50 pb-xs-10">
        <div class="container">
            <div class="row mb-15">
                <div class="col-lg-8 pe-xl-0">
                    <div class="news-left2">
                        <div class="news-top">
                            <div class="icon-text">
                                <span class="viewers fs-10"><a href="#"><i class="fal fa-eye"></i> 100 Views</a></span>
                                <span class="comment fs-10"><a href="#"><i class="fal fa-comments"></i> 30
                                        Comments</a></span>
                                <span class="date fs-10"><a href="#"><i class="fal fa-calendar-alt"></i> 24th March
                                        2024</a></span>
                            </div>
                            <p class="description">
                                A great commerce experience cannot be distilled to a single number. It’s not a
                                Lighthouse
                                score, or a set of Core Web Vitals figures, although both are important inputs. A great
                                commerce experience is a trilemma that carefully balances competing needs of delivering
                                great customer experience, dynamic storefront
                                capabilities, and long-term business — conversion, retention, re-engagement —
                                objectives. As
                                developers, we rightfully obsess about the customer experience, relentlessly working to
                                squeeze every millisecond out of the critical rendering path, optimize input latency,
                                and
                                eliminate jank. At the limit, statically generated, edge delivered, and HTML-first pages
                                look like the optimal strategy. That is until you are confronted with the realization
                                that
                                the next step function in improving conversion rates and business.
                            </p>
                            <p class="description">
                                The term electronic commerce (ecommerce) refers to a business model that allows
                                companies
                                and individuals to buy and sell goods and services over the Internet. Ecommerce operates
                                in
                                four major market segments and can be conducted over computers, tablets, smartphones,
                                and
                                other smart devices. Nearly every imaginable product and service is available through
                                ecommerce transactions, including books, music, plane tickets, and financial services
                                such
                                as stock investing and online banking. As such, it is considered a very disruptive
                                technology.
                            </p>
                            <div class="image-section">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="image-1">
                                            <img src="{{ asset('assets/images/blog-details/img-1.jpg') }}" alt="img">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="image-2">
                                            <img src="{{ asset('assets/images/blog-details/img-2.jpg') }}" alt="img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="description">
                                Once that's determined, you need to come up with a name and set up a legal structure,
                                such
                                as a corporation. Next, set up an ecommerce site with a payment gateway. For instance, a
                                small business owner who runs a dress shop can set up a website promoting their clothing
                                and
                                other related products online and allow customers to make payments with a credit card or
                                through a payment processing service, such as PayPal.
                            </p>
                        </div>
                        <div class="feature-section">
                            <h2 class="section-title">Ecommerce operates in all four of the following major market
                                segments. These are:</h2>
                            <ul class="title-inner">
                                <li class="sect-title">
                                    <h3>Business to business (B2B), which is the direct sale of goods and
                                        services between businesses</h3>
                                </li>
                                <li class="sect-title">
                                    <h3>Providing goods and services isn't as easy as it may seem. It
                                        a lot of research about the products</h3>
                                </li>
                                <li class="sect-title">
                                    <h3>Consumer to consumer, which allows individuals to sell to one
                                        usually through a third-party site like eBay</h3>
                                </li>
                                <li class="sect-title">
                                    <h3>Services you wish to sell, the market, audience, competition, as
                                        as expected business costs.</h3>
                                </li>
                            </ul>
                        </div>
                        <div class="quote-section text-center">
                            <div class="icon">
                                <img src="{{ asset('assets/images/blog-details/quote.png') }}" alt="">
                            </div>
                            <div class="text">
                                <h3>“ Once that's determined, you need to come up with a name and set up a legal
                                    structure, such as a corporation. Next, set up an ecommerce site with a payment
                                    gateway.
                                    For instance, a small business owner who runs a dress shop ”</h3>
                            </div>
                            <div class="author2">
                                <span class="name">Rosalina D. William </span>
                                <span class="intro"> / Head Of Idea, Rosalina Co.</span>
                            </div>
                        </div>
                        <p class="description2">
                            Ecommerce has changed the way people shop and consume products and services. More and more
                            people are turning to their computers and smart devices to order goods, which can easily be
                            delivered to their homes. As such, it has disrupted the retail landscape. Amazon and Alibaba
                            have gained considerable
                            popularity, forcing traditional retailers to make changes to the way they do business.
                        </p>
                        <div class="button-area">
                            <div class="row justify-content-between">
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="tag-area">
                                        <h3>Related Tags</h3>
                                        <div class="button-tag">
                                            <ul>
                                                <li><a href="#">Popular</a></li>
                                                <li><a href="#">Design</a></li>
                                                <li><a href="#">UX</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-12 text-sm-end text-start">
                                    <div class="social-area">
                                        <div class="social-title">
                                            <h3>Social Share</h3>
                                        </div>
                                        <div class="social-icon">
                                            <ul>
                                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fab fa-behance"></i></a></li>
                                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                                <li><a href="#"><i class="fab fa-tumblr"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="post-area">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-lg-4 col-sm-4 col-12 text-start">
                                        <div class="previous-post">
                                            <div class="post-img">
                                                <a href="#"><img src="{{ asset('assets/images/blog-details/prev-post.jpg') }}"
                                                        alt="prev-post"></a>
                                            </div>
                                            <div class="post-text">
                                                <h3 class="sub-title">Prev Post</h3>
                                                <h2 class="sect-title"><a href="#">Tips On Minimalist</a></h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-12 text-sm-center text-start">
                                        <div class="icon-area">
                                            <a href="#"><img src="{{ asset('assets/images/blog-details/shape.png') }}" alt="img"></a>
                                        </div>
                                    </div>
                                    <div
                                        class="col-lg-4 col-sm-4 col-12 text-sm-end text-start justify-content-sm-end justify-content-start">
                                        <div class="next-post">
                                            <div class="post-text">
                                                <h3 class="sub-title">Next Post</h3>
                                                <h2 class="sect-title"><a href="#">Less Is More</a></h2>
                                            </div>
                                            <div class="post-img">
                                                <a href="#"><img src="{{ asset('assets/images/blog-details/next-post.jpg') }}"
                                                        alt="next-post"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="comment-header">
                                <div class="comment">
                                    <h3>04 Comment</h3>
                                </div>
                                <div class="icon">
                                    <a href="#"><i class="fal fa-comments"></i></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="comment-section">
                                        <div class="comment-text">
                                            <div class="commentator">
                                                <a href="#"><img src="{{ asset('assets/images/blog-details/commentator-1.jpg') }}"
                                                        alt="commentator"></a>
                                            </div>
                                            <div class="text">
                                                <div class="section-title">
                                                    <div class="title">
                                                        <h2 class="sub-title">Rosalina Kelian</h2>
                                                        <span class="sect-title"><a href="#"><i
                                                                    class="fal fa-calendar-alt"></i>
                                                                24th
                                                                March
                                                                2024</a></span>
                                                    </div>
                                                    <div class="button">
                                                        <a href="#"><i class="fal fa-reply"></i> Reply</a>
                                                    </div>
                                                </div>
                                                <p class="description">But that's not all. Not to be outdone, individual
                                                    sellers
                                                    have increasingly engaged in e-commerce transactions via their own
                                                    personal
                                                    websites. And digital marketplaces such as eBay or Etsy serve as
                                                    exchanges
                                                    where multitudes of buyers and sellers come together to conduct
                                                    business.
                                                    commerce has changed the way people shop and consume products and
                                                    services.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-10">
                                    <div class="comment-section">
                                        <div class="comment-text">
                                            <div class="commentator">
                                                <a href="#"><img src="{{ asset('assets/images/blog-details/commentator-2.jpg') }}"
                                                        alt="commentator"></a>
                                            </div>
                                            <div class="text">
                                                <div class="section-title">
                                                    <div class="title">
                                                        <h2 class="sub-title">Alonso William</h2>
                                                        <span class="sect-title"><a href="#"><i
                                                                    class="fal fa-calendar-alt"></i>
                                                                24th
                                                                March
                                                                2024</a></span>
                                                    </div>
                                                    <div class="button">
                                                        <a href="#"><i class="fal fa-reply"></i> Reply</a>
                                                    </div>
                                                </div>
                                                <p class="description">Ecommerce has changed the way people shop and
                                                    consume products and services. More and more people are turning to
                                                    their computers and smart devices to order goods, which can easily
                                                    be delivered to their homes. As such, it has disrupted the retail
                                                    landscape. Amazon and Alibaba have gained considerable popularity.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-10">
                                    <div class="comment-section">
                                        <div class="comment-text">
                                            <div class="commentator">
                                                <a href="#"><img src="{{ asset('assets/images/blog-details/commentator-3.jpg') }}"
                                                        alt="commentator"></a>
                                            </div>
                                            <div class="text">
                                                <div class="section-title">
                                                    <div class="title">
                                                        <h2 class="sub-title">Miranda Halim</h2>
                                                        <span class="sect-title"><a href="#"><i
                                                                    class="fal fa-calendar-alt"></i>
                                                                24th
                                                                March
                                                                2024</a></span>
                                                    </div>
                                                    <div class="button">
                                                        <a href="#"><i class="fal fa-reply"></i> Reply</a>
                                                    </div>
                                                </div>
                                                <p class="description">commerce has changed the way people shop and
                                                    consume products and services. More and more people are turning to
                                                    their computers and smart devices to order goods, which can easily
                                                    be delivered to their homes. As such, it has disrupted the retail
                                                    landscape. Amazon and Alibaba have gained considerable popularity
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="rating-area">
                                <div class="rating-text">
                                    <h2 class="text">Give Your Opinion</h2>
                                </div>
                                <div class="rating-icon">
                                    <span class="one"><a href="#"> <i class="fas fa-star"></i></a></span>
                                    <span class="two"><a href="#"> <i class="fas fa-star"></i></a></span>
                                    <span class="three"><a href="#"> <i class="fas fa-star"></i></a></span>
                                    <span class="four"><a href="#"> <i class="fal fa-star"></i></a></span>
                                    <span class="five"><a href="#"> <i class="fal fa-star"></i></a></span>
                                </div>
                            </div>
                            <div class="comment-form mb-10">
                                <div class="contact-form">
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="input-box text-input mb-20">
                                                <textarea name="Message" id="validationDefault01"  cols="30" rows="10"
                                                    placeholder="Type Your Comments..." required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="col-lg-12">
                                                <div class="input-box mb-20">
                                                    <input type="text" id="validationDefault02" placeholder="Type Your Name..." required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="input-box mail-input mb-20">
                                                    <input type="text" id="validationDefault03" placeholder="Type Your E-mail..." required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="input-box sub-input mb-30">
                                                    <input type="text" id="validationDefault04" placeholder="Type Your Website..." required>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-15">
                                                <button class="form-btn form-btn4">
                                                    <i class="fal fa-comment">
                                                    </i>
                                                    Post Comments
                                                </button>
                                            </div>
                                        </div>
                                    </div>
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
                                <input type="text" placeholder="Search your keyword...">
                                <button class="widget-btn"><i class="fal fa-search"></i></button>
                            </form>
                        </div>
                        <div class="widget widget-post mb-40">
                            <div class="widget-title-box pb-25 mb-30">
                                <h4 class="widget-sub-title2 fs-20">Popular Feeds</h4>
                            </div>
                            <ul class="post-list">
                                <li>
                                    <div class="blog-post mb-30">
                                        <a href="{{ route('newsDetails') }}"><img src="{{ asset('assets/images/blog/img-14.jpg') }}"
                                                alt="Post Img"></a>
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
                                        <a href="{{ route('newsDetails') }}"><img src="{{ asset('assets/images/blog/img-15.jpg') }}"
                                                alt="Post Img"></a>
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
                                        <a href="{{ route('newsDetails') }}"><img src="{{ asset('assets/images/blog/img-16.jpg') }}"
                                                alt="Post Img"></a>
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
                                        <a href="{{ route('newsDetails') }}"><img src="{{ asset('assets/images/blog/img-17.jpg') }}"
                                                alt="Post Img"></a>
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
                                <li><a href="#">Business <span class="f-right">26</span></a></li>
                                <li><a href="#">Consultant <span class="f-right">30</span></a></li>
                                <li><a href="#">Creative <span class="f-right">71</span></a></li>
                                <li><a href="#">UI/UX <span class="f-right">56</span></a></li>
                                <li><a href="#">Technologys <span class="f-right">60</span></a></li>
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