@extends('layout.layout')

@section('title', $title ?? 'Регистрация')

@section('content')
<section class="auth" id = "app">
    <register-page></register-page>
</section>
@endsection


@section('scripts')
<script src="libs/qr/qrcode.min.js"></script>
<script>
    var qrcode = new QRCode("tg-qr", {
        text: "https://t.me/adswap_bot"
        , width: 125
        , height: 125
        , colorDark: "#000000"
        , colorLight: "#ffffff"
        , correctLevel: QRCode.CorrectLevel.H
    });

</script>
<script src="{{ asset('js/tg.js') }}"></script>
@endsection
