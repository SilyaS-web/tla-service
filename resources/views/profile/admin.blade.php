<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Unbounded:wght@200..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/libs/owl/owl.carousel.min.css">
    <link rel="stylesheet" href="/libs/owl/owl.theme.default.css">

    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">

    <script src="{{ asset('libs/jquery/jquery-3.7.1.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('libs/jquery/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('/libs/owl/owl.carousel.min.js') }}"></script>

    <title>Панель управления</title>
</head>
<body>
<div class="wrapper" id = "app">
    <admin-index></admin-index>
</div>
@include('shared.success-message')
</body>

<script src="{{ asset('admin/js/script.js') }}"></script>
<script src = "{{ mix('js/app.ts') }}"></script>
</html>
