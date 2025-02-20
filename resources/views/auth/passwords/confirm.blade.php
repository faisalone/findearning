@extends('layout.layout')
@php
    // ...existing code...
    $css = '<link rel="stylesheet" href="' . asset('assets/css/variables/variable4.css') . '" />';
    $title = 'Confirm Password';
    $subTitle = 'Home';
    $subTitle2 = 'Confirm Password';
    $script = '<script src="' . asset('assets/js/vendors/zoom.js') . '"></script>';
@endphp

@section('content')
<!-- confirm-password-area start -->
<div class="login-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                <div class="login-form">
                    <div class="section-title">
                        <h2>{{ __('Confirm Password') }}</h2>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <p>{{ __('Please confirm your password before continuing.') }}</p>
                            <form method="POST" action="{{ route('password.confirm') }}">
                                @csrf
                                <div class="form">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password*" required autocomplete="current-password">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form">
                                    <button type="submit" class="btn">{{ __('Confirm Password') }}</button>
                                </div>
                                <div class="form text-left">
                                    <a href="{{ route('password.request') }}" class="form-label">{{ __('Forgot Your Password?') }}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- confirm-password-area end -->
@endsection
