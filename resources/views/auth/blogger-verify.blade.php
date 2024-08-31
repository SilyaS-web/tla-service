@extends('layout.layout')

@section('title', $title ?? 'Регистрация блогера')

@section('content')
<section class="auth" id="app">
    <blogger-data-page></blogger-data-page>
</section>
@endsection
