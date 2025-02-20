@extends('layout.layout')
@php
    $css = '<link rel="stylesheet" href="' . asset('assets/css/variables/variable4.css') . '" />';
    $title = 'Verify Email';
    $subTitle = 'Home';
    $subTitle2 = 'Verify Email';
    $script = '<script src="' . asset('assets/js/vendors/zoom.js') . '"></script>';
@endphp

@section('content')
<!-- verify-email-area start -->
<div class="login-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                <div class="login-form">
                    <div class="section-title">
                        <h2>{{ __('Verify Your Email Address') }}</h2>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            @if (session('resent'))
                                <div class="alert alert-success">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif
                            <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                            <p>{{ __('If you did not receive the email') }},</p>
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn">{{ __('Click here to request another') }}</button>.
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- verify-email-area end -->
@endsection
