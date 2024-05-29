@extends('layout.layout')

@section('title', $title ?? 'Авторизация')

@section('content')
<section class="auth">
    <div class="auth__container _container">
        <div class="auth__body">
            <div class="auth__title title">
                Авторизуйтесь
            </div>
            <form class="form auth__form" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="phone">Номер телефона</label>
                    <input type="text" name="phone" id="phone" placeholder="Введите ваш номер" class="input input--phone">
                    @error('phone')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <script>
                    $(function() {
                        $("#phone").mask("8(999) 999-9999");
                    });

                </script>
                <div class="form-group">
                    <label for="pass">Пароль</label>
                    <input type="password" name="password" id="pass" placeholder="Введите ваш пароль" class="input input--password">
                    @error('password')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <p class="form-addit">
                    <a href="#" id="change-password-btn">Восстановить пароль</a>
                </p>
                <div class="form-btns auth__form-btns">
                    <button class="btn btn-primary" type="submit">
                        Войти
                    </button>
                    <a href="{{ route('register') }}" class="btn btn-secondary"  style="cursor: pointer">
                        Зарегистрируйтесь
                    </a>
                </div>
                <p class="form-addit">Авторизуясь, вы даёте на это согласие и принимаете условия <a href="{{ route('policy') }}">Политики конфиденциальности.</a> </p>
            </form>
        </div>
    </div>
</section>
@endsection
