@extends('layout.layout')

@php
    $css = '<link rel="stylesheet" href="' . asset('assets/css/variables/variable4.css') . '"/>';
    $title = 'Contact ';
    $subTitle='Contact';
    $subTitle2='Contact ';
@endphp

@section('content')
     
    <!--contact-area start-->
    <div class="contact-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <form class="contact-form mb-10">
                        <div class="section-header section-header5 text-start">
                            <div class="wrapper">
                                <div class="sub-content">
                                    <img class="line-1" src="{{ asset('assets/images/banner/wvbo-icon.png') }}" alt="">
                                    <span class="sub-text">Contact Us</span>
                                </div>
                                <h2 class="title">MAKE CUSTOM REQUEST</h2>
                            </div>
                        </div>
                        <div class="info-form">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="input-box mb-20">
                                        <input type="text" id="validationDefault01" placeholder="Full Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="input-box mail-input mb-20">
                                        <input type="email" id="validationDefault02" placeholder="E-mail Address"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="input-box number-input mb-30">
                                        <input type="number" id="validationDefault03" placeholder="Phone Number"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="input-box sub-input mb-30">
                                        <input type="text" id="validationDefault04" placeholder="Subject..." required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12">
                                    <div class="input-box text-input mb-20">
                                        <textarea name="Message" id="validationDefault05" cols="30" rows="10"
                                            placeholder="Enter message" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12 mb-15">
                                    <a href="#" class="form-btn form-btn4">
                                        Get A Quote
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="right-side">
                        <div class="get-in-touch">
                            <h3 class="section-title2">
                                GET IN TOUCH
                            </h3>
                            <div class="contact">
                                <ul>
                                    <li class="one">{{ $address->subtitle }}</li>
                                    <li class="two">{{ $contact->url }} ({{ $contact->name }})</li>
                                    <li class="three">Store Hours: <br>{{ $storeHours->subtitle }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--contact-area end-->
    
@endsection