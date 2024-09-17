@extends('layout.layout')

@section('title', $title ?? '')

@section('content')
    <section id="app">
        <router-view />
    </section>
@endsection
