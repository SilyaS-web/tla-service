@extends('layout.layout')

@section('title', $title ?? 'Авторизация')

@section('content')
<section class="auth" id = "app">
    <auth-page></auth-page>
</section>
@endsection
