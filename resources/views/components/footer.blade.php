<div class="footer footer-3 footer-4">
	<div class="container">
		<div class="footer-inner">
			<div class="row">
				<div class="col-xl-3 col-md-6 col-sm-6 box-widget-col">
					<div class="footer-widget footer-box-widget">
						<div class="footer-logo">
							<img src="{{ $settings['logo'] }}" class="w-75" alt="Findearning">
						</div>
						<p>{{ $settings['site_description'] ?? 'Solid is the information & experience directed at an end-user' }}</p>
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
						<p class="widget-text">{{ $settings['about_us_text'] ?? 'Elegant pink origami design three type of dimensional view and decoration co Great for adding a decorative touch to any room\'s decor.' }}</p>
						<a href="{{ $settings['get_in_touch_url'] ?? '#0' }}" class="getin-touch">{{ $settings['get_in_touch_text'] ?? 'Get In Touch' }} <i class="fal fa-long-arrow-right"></i></a>
					</div>
				</div>
				<div class="col-lg-13 col-md-6 col-sm-6">
					<div class="footer-widget">
						<h3 class="footer-widget-title">{{ $settings['information_title'] ?? 'Information' }}</h3>
						<ul class="widget-items cata-widget">
							@foreach($informationPages as $page)
								<li class="widget-list-item"><a href="{{ route('pages.show', $page->slug) }}">{{ $page->title }}</a></li>
							@endforeach
						</ul>
					</div>
				</div>
				<div class="col-lg-13 col-md-6 col-sm-6">
					<h3 class="footer-widget-title">{{ $settings['my_account_title'] ?? 'My Account' }}</h3>
					<ul class="footer-widget">
						@foreach($myaccountPages as $page)
							<li class="widget-list-item"><a href="{{ route('pages.show', $page->slug) }}">{{ $page->title }}</a></li>
						@endforeach
					</ul>
				</div>
				<div class="col-lg-25 col-md-6 col-sm-6">
					<h3 class="footer-widget-title">{{ $settings['newsletter_title'] ?? 'Get Newsletter' }}</h3>
					<div class="footer-widget newsletter-widget">
						<p class="widget-text">{{ $settings['newsletter_text'] ?? 'Don\'t miss any updates and offers!' }}</p>
						<div class="input-div">
							<input type="email" placeholder="{{ $settings['newsletter_placeholder'] ?? 'Enter email address' }}">
						</div>
						<a href="{{ $settings['newsletter_button_url'] ?? '#0' }}" class="subscribe-btn">{{ $settings['newsletter_button_text'] ?? 'Subscribe Now' }} <i class="fal fa-long-arrow-right"></i></a>
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
			<div class="footer-bottom-inner d-flex justify-content-between">
				<span class="copyright">{{ $settings['footer_copyright'] ?? 'All rights reserved by' }} <a href="{{ $settings['company_url'] ?? 'http://findearning.us' }}" class="brand" target="_blank">{{ $settings['company_name'] ?? 'findearning.us' }}</a></span>
				<span class="copyright">{{ $settings['footer_credits'] ?? 'Design & developed by' }} <a href="{{ $settings['developer_url'] ?? 'http://oyelab.com' }}" class="brand" target="_blank">{{ $settings['developer_name'] ?? 'oyelab.com' }}</a></span>
			</div>
		</div>
	</div>
</div>