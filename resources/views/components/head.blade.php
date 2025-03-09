<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="{{ $settings['description'] }}">
    <meta name="keywords" content="{{ $settings['keywords'] }}">
    <meta property="og:image" content="{{ $settings['og'] ?? asset('assets/images/og-image.png') }}">
    
	<title>
		@if(!empty($headTitle))
			{{ $headTitle . " - " . ($settings['title'] ?? 'Findearning') }}
		@else
			{{ $settings['title'] ?? 'Findearning' }}
			{{ !empty($settings['tagline']) ? " - " . $settings['tagline'] : '' }}
		@endif
	</title>
    
    <!-- ..::Favicon::.. -->
	<link rel="apple-touch-icon" href="{{ $settings['logo'] ?? asset('assets/images/fav.png') }}">
	<link rel="shortcut icon" type="image/x-icon" href="{{ $settings['logo'] ?? asset('assets/images/fav.png') }}">
    
    <!-- ..::Bootstrap V5 CSS::.. -->
    <link rel="stylesheet" type="text/css"  href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- ..::Font Awesome 5 CSS::.. -->
    <link rel="stylesheet" type="text/css"  href="{{ asset('assets/css/all.min.css') }}">
    <!-- ..::RT Icons CSS::.. -->
    <link rel="stylesheet" type="text/css"  href="{{ asset('assets/css/rt-icons.css') }}">
    <!-- ..::Animate css::.. -->
    <link rel="stylesheet" type="text/css"  href="{{ asset('assets/css/animate.min.css') }}">
    <!-- ..::Magnific popup Plugin::.. -->
    <link rel="stylesheet" type="text/css"  href="{{ asset('assets/css/magnific-popup.css') }}">
    <!-- ..::Swiper Slider Plugin::.. -->
    <link rel="stylesheet" type="text/css"  href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <!-- ..::Mobile Menu CSS::.. -->
    <link rel="stylesheet" type="text/css"  href="{{ asset('assets/css/metisMenu.css') }}">
    <!-- ..::Main Menu CSS::.. -->
    <link rel="stylesheet" type="text/css"  href="{{ asset('assets/css/rtsmenu.css') }}">
    <!-- ..::Preloader CSS::.. -->
    <link rel="stylesheet" type="text/css"  href="{{ asset('assets/css/preloader.css') }}">
    <!-- ..::Main Stylesheet::.. -->
    <?php echo (isset($css) ? $css   : '')?>
    <!-- ..::Main Stylesheet::.. -->
    <link rel="stylesheet" type="text/css"  href="{{ asset('assets/css/main.css') }}">
</head>