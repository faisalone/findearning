@extends('layout.layout')

@php
	$css = '<link rel="stylesheet" href="' . asset('assets/css/variables/variable4.css') . '"/>';
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
					<h3 class="sect-title">Thank you for your order! Your order id is: <strong>#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</strong>. Your order will be delivered shortly via {{ $order->delivery_method }}.</h3>
                </div>
                <div class="section-button">
                    <a class="btn-1" href="{{ route('myOrders') }}">My Orders <i class="fal fa-long-arrow-right"></i></a>
                    <h3>
                        Let's track your order or
                        <a class="btn-2" href="{{ route('contact') }}"> Contact Us</a>
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <!--thanks-area end-->

@endsection