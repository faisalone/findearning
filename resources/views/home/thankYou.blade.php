@extends('layout.layout')

@php
    $title='Thank You';
    $subTitle = 'Home';
    $subTitle2 = 'Thank You';
    $script = '<script src="' . asset('assets/js/vendors/zoom.js') . '"></script>';
@endphp

@section('content')

    <!--thanks-area start-->
    <div class="thanks-area">
        <div class="container">
            <div class="section-inner">
                <div class="section-icon">
                    <i class="fal fa-check"></i>
                </div>
                <div class="section-title">
                    <h2 class="sub-title">Thanks For your Order</h2>
                    <h3 class="sect-title">Sorry, we couldn't find the page you where looking for. We suggest that <br> you return to homepage.</h3>
                </div>
                <div class="section-button">
                    <a class="btn-1" href="index.php"><i class="fal fa-long-arrow-left"></i> Go To Homepage</a>
                    <h3>
                        Let's track your order or
                        <a class="btn-2" href="contact.php"> Contact Us</a>
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <!--thanks-area end-->

@endsection