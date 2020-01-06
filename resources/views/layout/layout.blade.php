<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title_system')</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('scripts')
    </head>
    <body>
        @include('layout.nav')        
        <div class="container">
            @yield('content')
        </div>
        @include('layout.footer')
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
