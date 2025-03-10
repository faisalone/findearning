@extends('layout.layout')
@php
    $css = '<link rel="stylesheet" href="' . asset('assets/css/variables/variable4.css') . '" />';
    $title = 'Reset Password';
    $subTitle = 'Home';
    $subTitle2 = 'Reset Password';
    $script = '<script src="' . asset('assets/js/vendors/zoom.js') . '"></script>';
@endphp

@section('content')
<!-- reset-area start -->
<div class="login-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                <div class="login-form">
                    <div class="section-title">
                        <h2>{{ __('Reset Password') }}</h2>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form">
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Email address*" value="{{ $email ?? old('email') }}" required autofocus>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Password*" required>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form">
                                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation"
                                        placeholder="Confirm Password*" required>
                                </div>
                                <div class="form">
                                    <button type="submit" class="btn">{{ __('Reset Password') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- reset-area end -->
@endsection
