<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- <!-- CSRF Token --> --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Management</title>

        {{-- <!-- Fonts --> --}}
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        {{-- <!-- Styles --> --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @yield('styles')
    </head>

    <body class="has-navbar-fixed-top">
        <div id="app">
            {{-- <!-- Partials --> --}}
            {{-- Navbar --}}
            @include('_partials.nav.main')

            <div class="inner-container">
                <div class="left-side" >
                    {{-- SideNav --}}
                    @include('_partials.nav.manage')
                </div>
                <div class="right-side" >
                    {{-- Content --}}
                    @yield('content')
                </div>
            </div>
        </div>

        {{-- <!-- Scripts --> --}}
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('scripts')
    </body>
</html>
