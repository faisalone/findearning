<div class="share-social">
	<span>Share:</span>
	<a class="platform" target="_blank" href="https://t.me/share/url?url={{ urlencode(request()->fullUrl()) }}">
		<i class="fab fa-telegram-plane"></i>
	</a>
	<a class="platform" target="_blank" href="https://api.whatsapp.com/send?text={{ urlencode(request()->fullUrl()) }}">
		<i class="fab fa-whatsapp"></i>
	</a>
	<a class="platform" target="_blank" href="mailto:?body={{ urlencode(request()->fullUrl()) }}">
		<i class="fas fa-envelope"></i>
	</a>
	<a class="platform" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}">
		<i class="fab fa-facebook-f"></i>
	</a>
	<a class="platform" target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}">
		<i class="fab fa-linkedin"></i>
	</a>
	<a class="platform" target="_blank" href="https://x.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}">
		<i class="fab fa-twitter"></i>
	</a>
	<a class="platform" target="_blank" href="fb-messenger://share/?link={{ urlencode(request()->fullUrl()) }}">
		<i class="fab fa-facebook-messenger"></i>
	</a>
</div>