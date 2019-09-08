<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Church & Sermons | @yield('title')</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
        @yield('styles')
    </head>

    <body class="has-navbar-fixed-top">
        <div id="app">

            <!-- Partials -->
            @include('_partials.nav.main')

            <div id="wrapper">
                @yield('content')


            </div>


        </div>
         <!-- Scripts -->

         <script src="{{ asset('js/scripts.js') }}"></script>
         @yield('scripts')
    </body>

</html>
