<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Unbounded:wght@200..900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="img/adswap_1_2.ico" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('libs/owl/owl.carousel.min.css')  }}">
    <link rel="stylesheet" href="{{ asset('libs/owl/owl.theme.default.css')  }}">

    <link rel="stylesheet" href="{{ asset('libs/meter/style.css')  }}">

    <link rel="stylesheet" href="{{ asset('libs/range-slider/style.css')  }}">
    @php($style = 'css/style.css?v=' . rand(100000, 9999999))
    <link rel="stylesheet" href="{{ asset($style)  }}">
    <link rel="stylesheet" href="{{ asset('css/loader.css')  }}">

    <script src="{{ asset('libs/jquery/jquery-3.7.1.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('libs/jquery/jquery.maskedinput.min.js') }}"></script>

    <script src="{{ asset('libs/chart/chart.js') }}"></script>
    <script src="{{ asset('libs/funnel/funnel-chart.js') }}"></script>
    <script src="{{ asset('libs/owl/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        // (function(m,e,t,r,i,k,a){m[i]=m[i]function(){(m[i].a=m[i].a[]).push(arguments)};
        //     m[i].l=1*new Date();
        //     for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
        //     k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        // (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
        //
        // ym(98729942, "init", {
        //     clickmap:true,
        //     trackLinks:true,
        //     accurateTrackBounce:true,
        //     webvisor:true
        // });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/98729942" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

    <script async src="https://script.click-chat.ru/chat.js?wid=f12436e7-a36d-437d-8783-ec27bf222c55"></script>

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

@php($script = "js/app.js?v=" . rand(100000, 9999999))
<script src="{{ asset($script) }}"></script>
</html>
