@extends('layout.layout')

@section('content')
<section class="auth">
    <div class="auth__container _container">
        <div class="auth__body auth__steps">
            <div class="auth__step">
                <div class="form auth__form">
                    <div class="auth__header">
                        <div class="auth__title title">
                            Подтвердите личность
                        </div>
                        <p class="auth__subtitle">
                            Для того чтобы подтвердить личность нужно перейти по ссылке ниже и ответить боту в телеграме
                        </p>
                    </div>
                    <div class="auth__form-btns" style="justify-content: center;">
                        <a href="{{ route('profile') }}" class="btn btn-primary telegram-link">
                            Перейти в телеграмм
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
