@extends('layout.layout')

@section('content')
<section class="auth">
    <div class="auth__container _container">
        <div class="auth__body auth__steps">
            <div class="auth__step">
                <div class="form auth__form">
                    <div class="auth__header">
                        <div class="auth__title title">
                            Ваш аккаунт находится на модерации
                        </div>
                        <p class="auth__subtitle">
                            Как только администратор обработает ваш аккаунт, вам придёт уведомление в
                            <a target="_blank" href="https://t.me/tla_service_bot" class="">телеграм-боте</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
