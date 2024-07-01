@extends('layout.layout')

@section('content')
<section class="auth">
    <div class="auth__container _container">
        <div class="auth__body auth__steps">
            <div class="auth__step">
                <div class="form auth__form">
                    <div class="auth__header">
                        <div class="auth__title title">
                            Ваш аккаунт был заблокирован модерцией
                        </div>
                        <p class="auth__subtitle">
                            Напишете на почту
                            <a target="_blank" href="mailto:hello@tla-agency.ru">hello@tla-agency.ru</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
