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
			{{-- Flash success message --}}
			@if(session('success'))
				<div class="alert alert-success">
					{{ session('success') }}
				</div>
			@endif

            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <form class="contact-form mb-10" action="{{ route('contact.store') }}" method="POST">
                        @csrf
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
                                        <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="input-box mail-input mb-20">
                                        <input type="email" name="email" placeholder="E-mail Address" value="{{ old('email') }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="input-box number-input mb-30">
                                        <input type="text" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="input-box sub-input mb-30">
                                        <input type="text" name="subject" placeholder="Subject..." value="{{ old('subject') }}">
                                        @error('subject')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12">
                                    <div class="input-box text-input mb-20">
                                        <textarea name="message" cols="30" rows="10" placeholder="Enter message" required>{{ old('message') }}</textarea>
                                        @error('message')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 mb-15">
                                    <button type="submit" class="form-btn form-btn4">Submit</button>
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
									<li class="one">{{ $settings['email'] ?? 'contact@findearning.com' }}</li>
									<li class="two">{{ $settings['telegram'] ?? 'username' }}</li>
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