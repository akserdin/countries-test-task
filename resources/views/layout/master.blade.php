<!doctype html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <title>Welcome to Countries app</title>
</head>
<body>

<div class="container">
    <h1>Welcome to Countries testing task app</h1>
    <hr>
    @yield('content')
</div>

<script src="{{ mix('js/app.js') }}"></script>
@stack('js')
</body>
</html>
