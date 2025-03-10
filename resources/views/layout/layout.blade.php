<!DOCTYPE html>
<html lang="en" class="darkmode" data-theme="light">
<x-head :headTitle="$title ?? ''" css='{!! isset($css) ? $css : "" !!}'/>
<body>
    <!-- ..::Preloader Section Start Here::.. -->
    {{-- <x-preloader /> --}}
    <!-- ..::Preloader End Here::.. -->
    <div class="anywere"></div>
    <?php 
        if (!isset($header)) {
            ?>
            <x-header title='{{ isset($title) ? $title : "" }}' subTitle='{{ isset($subTitle) ? $subTitle : "" }}' subTitle2='{{ isset($subTitle2) ? $subTitle2 : "" }}' :categories="$categories"/>
            <?php
        }
    ?>
    @yield('content')
    <?php 
        if (!isset($footer)) {
            ?>
            <x-footer/>
            <?php
        }
    ?>
    <div class="sticky-footer">
		<div class="chat-float">
			<a href="https://wa.me/{{ $settings['whatsapp'] }}" class="btn chat-button whatsapp-button text-white">
				<i class="fab fa-whatsapp whatsapp-icon"></i>
			</a>
			<a href="https://t.me/{{ $settings['telegram'] }}" class="btn chat-button telegram-button text-white">
				<i class="fab fa-telegram telegram-icon"></i>
			</a>
		</div>
		<!-- Include this div only when you want the scrolling text to be displayed -->
		@if(isset($settings['scroll']))
				<div class="scrolling-text">
					<marquee behavior="scroll" direction="left" style="font-size: 1.2em;">
						{{ $settings['scroll'] }}
					</marquee>
				</div>
		@endif
	</div>

    <x-script script='{!! isset($script) ? $script : "" !!}' />
    @stack('scripts')
</body>
</html>