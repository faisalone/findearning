{{-- filepath: /Users/faisal/Desktop/OYELAB/findearning/resources/views/auth/login.blade.php --}}
@extends('layout.layout')
@php
// ...existing code...
$css= '<link rel="stylesheet" href="' . asset('assets/css/variables/variable4.css') . '" />';
$title = 'Log In';
$subTitle='Home';
$subTitle2='Log In';
$script = '<script src="' . asset('assets/js/vendors/zoom.js') . '"></script>';
@endphp

@section('content')

    <!--login-area start-->
    <div class="login-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                    <div class="login-form">
                        <div class="section-title">
                            <h2>Login</h2>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form">
                                        <!-- Changed field name from username to email -->
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="Email address*" required />
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
                                    <!-- Flex container for Remember Me and Lost your password? -->
									<div class="form d-flex justify-content-between" style="flex-wrap: nowrap;">
										<div class="d-inline-flex align-items-center">
											<input type="checkbox" class="form-check-input me-2" id="remember" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
											<label for="remember" class="form-label mb-0">Remember Me</label>
										</div>
										<div class="d-inline-flex align-items-center">
											<a class="forgot-password" href="#">Lost your password?</a>
										</div>
									</div>
                                    <div class="form">
                                        <button type="submit" class="btn">Login</button>
                                    </div>
                                    <!-- Change text-center to text-left for left alignment -->
                                    <div class="form text-left">
                                        <a href="{{ route('register') }}" class="form-label">Need account?</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--login-area end-->
@endsection