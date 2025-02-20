{{-- filepath: /Users/faisal/Desktop/OYELAB/findearning/resources/views/auth/login.blade.php --}}
@extends('layout.layout')
@php
// ...existing code...
$css= '<link rel="stylesheet" href="' . asset('assets/css/variables/variable4.css') . '" />';
$title = 'Reset Password';
$subTitle='Home';
$subTitle2='Reset Password';
$script = '<script src="' . asset('assets/js/vendors/zoom.js') . '"></script>';
@endphp

@section('content')

    <!--reset-password-area start-->
    <div class="login-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                    <div class="login-form">
                        <div class="section-title">
                            <h2>{{ __('Reset Password') }}</h2>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="form">
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="Email address*" value="{{ old('email') }}" required />
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form">
                                        <button type="submit" class="btn">{{ __('Send Reset Link') }}</button>
                                    </div>
                                    <div class="form text-left">
                                        <a href="{{ route('login') }}" class="form-label">{{ __('Back to Login') }}</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--reset-password-area end-->
@endsection