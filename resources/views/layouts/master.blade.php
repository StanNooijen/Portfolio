<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stan Nooijen</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&family=Luckiest+Guy&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/js/app.js', 'resources/sass/Main.sass'])
    @else

    @endif

</head>

<div id="loading-screen" class="loading-screen">
    <div class="container-placeholder" id="loading-screen">
        <div class="image-placeholder"></div>
        <div class="content-placeholder">
            <div class="title-yes">
                <div class="title-placeholder"></div>
                <div class="title-placeholder"></div>
            </div>
            <div class="text-placeholder"></div>
            <div class="buttons-placeholder">
                <div class="button-placeholder"></div>
                <div class="button-placeholder"></div>
            </div>
        </div>
    </div>
</div>
<div class="navigation">
    <div class="navigator">
        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="nav-links">
        <div class="links">
            <a href="#about">Over mij</a>
            <a href="#skills">Skills</a>
            <a href="#ervaring">Ervaring</a>
            <a href="#projecten">Projecten</a>
            {{--            <a href="{{ route('lang.switch', ['locale' => 'en']) }}">English</a>--}}
            {{--            <a href="{{ route('lang.switch', ['locale' => 'nl']) }}">Dutch</a>--}}
        </div>
    </div>
</div>
    @yield('content')
</html>
