@extends('layout.layout')

@section('content')
<section class="auth">
    <div class="auth__container _container">
        <div class="auth__body auth__steps">
            <div class="auth__title title">
                Заполните поля
            </div>
            <form class="form auth__form" method="POST" action="{{ route('') }}">
                <div class="form-group">
                    <label for="tg-link">Ссылка на телеграм</label>
                    <input type="text" id="tg-link" name="tg-link" placeholder="Ссылка" class="input input--tg-link" value="{{ old('tg-link') }}">
                    @error('tg-link')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inst-link">Ссылка на инстаграм</label>
                    <input type="text" id="inst-link" name="inst-link" placeholder="Ссылка" class="input input--inst-link" value="{{ old('inst-link') }}">
                    @error('inst-link')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="yt-link">Ссылка на ютуб</label>
                    <input type="text" id="yt-link" name="yt-link" placeholder="Ссылка" class="input input--yt-link" value="{{ old('yt-link') }}">
                    @error('yt-link')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="desc">Описание канала</label>
                    <textarea name="desc" id="desc" cols="30" rows="10" class="textarea" placeholder="Введите текст"></textarea>
                </div>
                <div class="form-group">
                    <label for="sex">Ваш пол</label>
                    <select name="sex" id="sex" name="sex" class="input input--sex select">
                        <option value="seller">Мужской</option>
                        <option value="blogger">Женский</option>
                    </select>
                    @error('role')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-btns auth__form-btns">
                    <button class="btn btn-primary next" type="submit">
                        Сохранить
                    </button>
                </div>
                <p class="form-addit">
                    Заполняя поля, вы даёте на это согласие и принимаете условия <a href="{{ route('policy') }}">Политики конфиденциальности.</a>
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
<script src="{{ asset('js/tg.js') }}"></script>
@endsection
