@extends('layout.layout')

@section('content')
<section class="auth">
    <div class="auth__container _container">
        <div class="auth__body auth__steps">
            <div class="auth__title title">
                Зарегистрируйтесь
            </div>
            <form class="form auth__form" method="POST" action="{{ route('register') }}">
                <div class="form-group">
                    <label for="name">Ваше имя</label>
                    <input type="text" id="name" name="name" placeholder="Введите ваше имя" class="input input--name" value="{{ old('name') }}">
                    @error('name')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Ваш E-mail</label>
                    <input type="email" id="email" name="email" placeholder="Введите почту" class="input input--email" value="{{ old('email') }}">
                    @error('email')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Номер телефона</label>
                    <input type="phone" id="phone" name="phone" placeholder="Введите ваш номер" class="input input--phone" value="{{ old('phone') }}">
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
                    <input type="password" id="pass" name="password" placeholder="Введите ваш пароль" class="input input--password">
                    @error('password')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="repeat-pass">Повторите пароль</label>
                    <input type="password" id="repeat-pass" name="password_confirmation" placeholder="Повторите пароль" class="input input--password">
                    @error('password_confirmation')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="role">Выберите роль</label>
                    <select name="role" id="role" name="role" class="input input--role select">
                        <option value="seller">Селлер</option>
                        <option value="blogger">Блогер</option>
                        <option value="agency">Представитель бренда (Агенство)</option>
                    </select>
                    @error('role')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group tg-confirmation">
                    <div class="tg-confirmation__row">
                        <div class="tg-confirmation__col">
                            <div class="tg-confirmation__title">
                                Подтвердите личность
                            </div>
                            <div class="tg-confirmation__text">
                                Перейдите в телеграмм и подтведите свою личность, чтобы получать уведомления о новостях на площадкке.
                            </div>
                            <div class="tg-confirmation__btn">
                                <a target="_blank" href="https://t.me/tla_service_bot" class="">Перейти</a>
                            </div>
                        </div>
                        <div class="tg-confirmation__col">
                            <div class="tg-confirmation__qr" id="tg-qr">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-btns auth__form-btns">
                    <button class="btn btn-primary next" type="submit">
                        Зарегистрироваться
                    </button>
                    <a href="{{ route('login') }}" class="btn btn-secondary" type="submit">
                        Войти
                    </a>
                </div>
                <p class="form-addit">
                    Регистрируясь, вы даёте на это согласие и принимаете условия <a href="{{ route('policy') }}">Политики конфиденциальности.</a>
                </p>
            </form>
        </div>
    </div>
</section>
@endsection


@section('scripts')
<script src="libs/qr/qrcode.min.js"></script>
<script>
    var qrcode = new QRCode("tg-qr", {
        text: "https://t.me/tla_service_bot"
        , width: 125
        , height: 125
        , colorDark: "#000000"
        , colorLight: "#ffffff"
        , correctLevel: QRCode.CorrectLevel.H
    });

</script>
@endsection
