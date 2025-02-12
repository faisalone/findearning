<!DOCTYPE html>
<html lang="en" class="darkmode" data-theme="light">
@php
    $css = '<link rel="stylesheet" href="' . asset('assets/css/variables/variable4.css') . '"/>';
@endphp
<x-head/>

<body>
    
    <div class="error-area">
        <div class="content-area">
            <div class="container">
                <div class="error-404">
                    <div class="section-inner">
                        <div class="error-img">
                            <img src="{{ asset('assets/images/error/404-1.png') }}" alt="error-img">
                        </div>
                        <div class="title">
                            <h2 class="sub-title">Page not found</h2>
                            <h3 class="sect-title">Sorry, we couldn't find the page you where looking for. We suggest <br> that you return to homepage.</h3>
                        </div>
                        <div class="section-button">
                            <a href="{{ route('index') }}"><i class="fal fa-long-arrow-left"></i> Go To Homepage</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<x-script/>

</body>

</html>