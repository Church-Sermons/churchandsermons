<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sample Page</title>

    <!-- Styles -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">This is the card header</h4>
                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod, tempore.</p>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    @yield('scripts')
</body>
</html>
