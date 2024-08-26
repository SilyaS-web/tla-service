<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Unbounded:wght@200..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">

    <script src="{{ asset('libs/jquery/jquery-3.7.1.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('libs/jquery/jquery.maskedinput.min.js') }}"></script>

    <title>Панель управления</title>
</head>
<body>
    <div class="wrapper" id = "admin-app" data-is-admin="{{ auth()->user()->is_admin ? 1 : 0 }}">
        <admin-index></admin-index>
    </div>
</body>
<script src="{{ asset('admin/js/script.js') }}"></script>
<script src = "./js/app.js"></script>
</html>
