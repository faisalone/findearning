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
    <x-chatButton />
    <x-script script='{!! isset($script) ? $script : "" !!}' />
    @stack('scripts')
</body>
</html>