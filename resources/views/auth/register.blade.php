{{-- filepath: /Users/faisal/Desktop/OYELAB/findearning/resources/views/auth/register.blade.php --}}
@extends('layout.layout')
@php
// ...existing code...
$css= '<link rel="stylesheet" href="' . asset('assets/css/variables/variable4.css') . '" />';
$title = 'Register';
$subTitle='Home';
$subTitle2='Register';
$script = '<script src="' . asset('assets/js/vendors/zoom.js') . '"></script>';
@endphp

@section('content')

    <!--register-area start-->
    <div class="login-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                    <div class="register-form">
                        <div class="section-title">
                            <h2>Registration</h2>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Name*" value="{{ old('name') }}" required />
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form">
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Email address*" value="{{ old('email') }}" required />
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form">
                                        <div class="password-input">
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Password*" required />
                                            <span class="show-password-input"></span>
                                        </div>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form">
                                        <div class="password-input">
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                                                placeholder="Confirm Password*" required />
                                            <span class="show-password-input"></span>
                                        </div>
                                    </div>
                                    <div class="form">
                                        <button type="submit" class="btn">Register</button>
                                    </div>
                                    <!-- New container for Already has account? link -->
                                    <div class="form text-left">
                                        <a href="{{ route('login') }}" class="form-label">Already has account?</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--register-area end-->
    <!-- Removed inline password toggle script -->
@endsection