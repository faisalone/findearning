@extends('layout.layout')

@php
	$css = '<link rel="stylesheet" href="' . asset('assets/css/variables/variable4.css') . '"/>';
    $title = $page->title;
@endphp

@section('content')

    <!--news-feed-area start-->
    <section class="news-feed-area pt-120 pb-75 pt-md-60 pb-md-15 pt-xs-50 pb-xs-10">
        <div class="container">
            <div class="row mb-15">
				<div class="col-lg-8 mx-auto">
                    <div class="news-left2">
                        <div class="news-top">
							<h2 class="section-title">{{ $page->title }}</h2>
                            <p class="description">{{ $page->content }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--news-feed-area end-->
@endsection