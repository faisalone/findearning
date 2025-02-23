<div class="footer footer-3 footer-4">
	<div class="container">
		<div class="footer-inner">
			<div class="row">
				<div class="col-xl-3 col-md-6 col-sm-6 box-widget-col">
					<div class="footer-widget footer-box-widget">
						<div class="footer-logo"><img src="{{ asset('assets/images/logo-findearning.svg') }}" class="w-100" alt="footer-logo"></div>
						<p>Solid is the information & experience
							directed at an end-user</p>
						<div class="quick-contact">
							<div class="phone contact-item">
								<div class="icon"><img src="{{ asset('assets/images/icons/telegram.png') }}" alt="telegram-icon"></div>
								<div class="contact-info">
									<a href="https://t.me/username" class="telegram-handle info">@username</a>
									<span class="title">Connect on Telegram</span>
								</div>
							</div>
							<div class="email contact-item">
								<div class="icon"><img src="{{ asset('assets/images/icons/mail2.png') }}" alt="phone-icon">
								</div>
								<div class="contact-info">
									<a href="mailto:pixcelsthemes@gmail.com"
										class="email-address info">contact@findearning.com</a>
									<span class="title">Get Support</span>
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="col-xl-3 col-md-6 col-sm-6">
					<div class="footer-widget">
						<h3 class="footer-widget-title">About Us</h3>
						<p class="widget-text">Elegant pink origami design three type
							of dimensional view and decoration co
							Great for adding a decorative touch to
							any room’s decor.</p>
						<a href="#0" class="getin-touch">Get In Touch <i class="fal fa-long-arrow-right"></i></a>
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
						@foreach($myaccountPages as $page)
							<li class="widget-list-item"><a href="{{ route('pages.show', $page->slug) }}">{{ $page->title }}</a></li>
						@endforeach
					</ul>
				</div>
				<div class="col-lg-25 col-md-6 col-sm-6">
					<h3 class="footer-widget-title">Get Newsletter</h3>
					<div class="footer-widget newsletter-widget">
						<p class="widget-text">Don't miss any updates and offers!</p>
						<div class="input-div">
							<input type="email" placeholder="Enter email address">
						</div>
						<a href="#0" class="subscribe-btn">Subscribe Now <i class="fal fa-long-arrow-right"></i></a>
					</div>
				</div>
			</div>
			<div class="footer-bottombar">
				<div class="payment-methods"><img src="{{ asset('assets/images/footer/payment2.svg') }}" alt="payment-methods">
				</div>
			</div>
		</div>
	</div>
	<div class="footer-bottom-area">
		<div class="container">
			<div class="footer-bottom-inner d-flex justify-content-between">
				<span class="copyright">All rights reserved by <a href="http://findearning.us" class="brand" target="_blank">findearning.us</a></span>
				<span class="copyright">Design & developed by <a href="http://oyelab.com" class="brand" target="_blank">oyelab.com</a></span>
			</div>
		</div>
	</div>
</div>