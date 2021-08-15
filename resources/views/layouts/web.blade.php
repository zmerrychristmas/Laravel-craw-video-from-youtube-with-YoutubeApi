<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" ></script>
        <link href="//vjs.zencdn.net/7.10.2/video-js.min.css" rel="stylesheet">
        <script src="//vjs.zencdn.net/7.10.2/video.min.js"></script>
        <script>window.HELP_IMPROVE_VIDEOJS = false;</script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-full bg-gray-100">
            @include('layouts.navigation')

            <!-- Page -->
            <div class="bg-white min-h-full">
                <div class="max-w-7xl border-t-2 border-gray-900 mx-auto py-6 px-4 sm:px-6 lg:px-8 min-h-full">
                    {{ $content }}
                </div>
            </div>
        </div>

        <script type="text/javascript" src="{{ asset('js/youtube.min.js') }}"></script>
        @stack('footer_scripts')

    </body>
</html>
