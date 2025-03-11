<div class="footer footer-3 footer-4">
	<div class="container">
		<div class="footer-inner">
			<div class="row">
				<div class="col-xl-3 col-md-6 col-sm-6 box-widget-col">
					<div class="footer-widget footer-box-widget">
						<div class="footer-logo">
							<img src="{{ $settings['logo'] ?? asset('assets/images/fav.png') }}" class="w-75" alt="Findearning">
						</div>
						<p>{{ $settings['description'] ?? 'Findearning - Earn Money' }}</p>
						<div class="quick-contact">
							<div class="phone contact-item">
								<div class="icon"><img src="{{ asset('assets/images/icons/telegram.png') }}" alt="telegram-icon"></div>
								<div class="contact-info">
									<a href="https://t.me/{{ $settings['telegram'] ?? 'username' }}" class="telegram-handle info">{{ '@' . ($settings['telegram'] ?? 'username') }}</a>
									<span class="title">{{ $settings['telegram_label'] ?? 'Connect on Telegram' }}</span>
								</div>
							</div>
							<div class="email contact-item">
								<div class="icon"><img src="{{ asset('assets/images/icons/mail2.png') }}" alt="phone-icon">
								</div>
								<div class="contact-info">
									<a href="mailto:{{ $settings['email'] ?? 'contact@findearning.com' }}"
										class="email-address info">{{ $settings['email'] ?? 'contact@findearning.com' }}</a>
									<span class="title">{{ $settings['email_label'] ?? 'Get Support' }}</span>
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="col-xl-3 col-md-6 col-sm-6">
					<div class="footer-widget">
						<h3 class="footer-widget-title">{{ $settings['about_us_title'] ?? 'About Us' }}</h3>
						<p class="widget-text">{{ $settings['description2'] ?? 'Findearning - Earn Money' }}</p>

						<div class="d-flex flex-wrap">
							@if(isset($settings['facebook_page']) && !empty($settings['facebook_page']))
							<a class="social-icon me-3 mb-3 fs-3 text-white" target="_blank" href="https://www.facebook.com/{{ $settings['facebook_page'] }}">
								<i class="fab fa-facebook-f"></i>
							</a>
							@endif

							@if(isset($settings['youtube_channel']) && !empty($settings['youtube_channel']))
							<a class="social-icon me-3 mb-3 fs-3 text-white" target="_blank" href="https://www.youtube.com/{{ $settings['youtube_channel'] }}">
								<i class="fab fa-youtube"></i>
							</a>
							@endif

							@if(isset($settings['telegram_channel']) && !empty($settings['telegram_channel']))
							<a class="social-icon me-3 mb-3 fs-3 text-white" target="_blank" href="https://t.me/{{ $settings['telegram_channel'] }}">
								<i class="fab fa-telegram-plane"></i>
							</a>
							@endif
						</div>
					</div>
				</div>
				<div class="col-lg-13 col-md-6 col-sm-6">
					<div class="footer-widget">
						<h3 class="footer-widget-title">Information</h3>
						<ul class="widget-items cata-widget">
							@foreach($informationPages as $page)
								<li class="widget-list-item"><a href="{{ route('pages.show', $page->slug) }}">{{ $page->title }}</a></li>
							@endforeach
						</ul>
					</div>
				</div>
				<div class="col-lg-13 col-md-6 col-sm-6">
					<h3 class="footer-widget-title">My Account</h3>
					<ul class="footer-widget">
						<li class="widget-list-item"><a href="{{ route('myProfile')}}">My Profile</a></li>
						<li class="widget-list-item"><a href="{{ route('myOrders')}}">My Orders</a></li>
					</ul>
				</div>
				<div class="col-lg-25 col-md-6 col-sm-6" id="newsletter-section">
					<h3 class="footer-widget-title">Get Newsletter</h3>
					<div class="footer-widget newsletter-widget">
						<p class="widget-text">Don't miss any updates and offers!</p>
						@if(session('success'))
							<div class="alert alert-success">{{ session('success') }}</div>
						@endif

						@if($errors->has('email'))
							<small class="text-danger">{{ $errors->first('email') }}</small>
						@endif

						<form action="{{ route('newsletter.subscribe') }}" method="POST">
							@csrf
							<div class="input-div">
								<input type="email" name="email" placeholder="Enter email address">
							</div>
							<button type="submit" class="subscribe-btn">Subscribe Now <i class="fal fa-long-arrow-right"></i></button>
						</form>
					</div>
				</div>
			</div>
			<div class="footer-bottombar">
				<div class="payment-methods d-flex justify-content-center">
					@foreach($paymentMethods as $method)
						<img src="{{ $method->imagePath }}" alt="{{ $method->name }}" class="mx-2">
					@endforeach
				</div>
			</div>
		</div>
	</div>
	<div class="footer-bottom-area">
		<div class="container">
			<div class="footer-bottom-inner d-flex justify-content-center">
				<span class="copyright">All rights reserved by <a href="{{ $settings['url'] ?? 'http://findearning.net' }}" class="brand" target="_blank">{{ $settings['site_name'] ?? 'findearning.net' }}</a></span>
			</div>
		</div>
	</div>
</div>