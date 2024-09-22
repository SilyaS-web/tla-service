<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Unbounded:wght@200..900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('img/adswap_1_2.svg') }}" type="image/x-icon">

    <link rel="stylesheet" href="/libs/owl/owl.carousel.min.css">
    <link rel="stylesheet" href="/libs/owl/owl.theme.default.css">

    <link rel="stylesheet" href="/libs/meter/style.css">

    <link rel="stylesheet" href="/libs/range-slider/style.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/loader.css">

    <script src="{{ asset('libs/jquery/jquery-3.7.1.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('libs/jquery/jquery.maskedinput.min.js') }}"></script>

    <script src="{{ asset('/libs/chart/chart.js') }}"></script>
    <script src="{{ asset('/libs/funnel/funnel-chart.js') }}"></script>
    <script src="{{ asset('/libs/owl/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/js/script.js') }}"></script>

    <title>@yield('title')</title>
</head>
<body>
<div class="wrapper" style="background-color: #fff;">
    <section id="app">
        <router-view />
    </section>
</div>
@include('shared.success-message')
</body>
<script src="{{ asset("js/app.js") }}"></script>
@yield('scripts')
</html>
