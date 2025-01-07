<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&family=Luckiest+Guy&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
              rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://kit.fontawesome.com/57f8169d29.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        @vite(['resources/css/app.css','resources/sass/admin/main.sass', 'resources/js/cms.js'])
    </head>
    <body>
        @include('layouts.navigation')
        @isset($header)
            <header>
                {{ $header }}
            </header>
        @endisset
        <div class="container">
            <div class="flex-row h-100 gap-1">
                <div class="flex-column gap-1 w-100">
                    {{ $slot }}
                    @include('partials.below-slot-block', ['data' => $entries])
                </div>
                <div class="">
                    @include('partials.side-block', ['data' => $popups])
                </div>
            </div>
        </div>

    </body>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
</html>
