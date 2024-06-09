@extends('layout.layout')

@section('content')
<section class="auth">
    <div class="auth__container _container">
        <div class="auth__body auth__steps">
            <div class="auth__title title">
                Заполните поля
            </div>
            <form class="form auth__form" method="POST" action="{{ route('create-blogger') }}">
                <div class="form-group">
                    <label for="tg-link">Ссылка на телеграм</label>
                    <input type="text" id="tg-link" name="tg-link" placeholder="Ссылка (необязательно)" class="input input--tg-link" value="{{ old('tg-link') }}">
                    @error('tg-link')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inst-link">Ссылка на инстаграм</label>
                    <input type="text" id="inst-link" name="inst-link" placeholder="Ссылка (необязательно)" class="input input--inst-link" value="{{ old('inst-link') }}">
                    @error('inst-link')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="yt-link">Ссылка на ютуб</label>
                    <input type="text" id="yt-link" name="yt-link" placeholder="Ссылка (необязательно)" class="input input--yt-link" value="{{ old('yt-link') }}">
                    @error('yt-link')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="vk-link">Ссылка на ютуб</label>
                    <input type="text" id="vk-link" name="vk-link" placeholder="Ссылка (необязательно)" class="input input--vk-link" value="{{ old('vk-link') }}">
                    @error('vk-link')
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
                        <option value="male">Мужской</option>
                        <option value="female">Женский</option>
                    </select>
                    @error('sex')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="city">Ваш город</label>
                    <select name="city" id="city" name="city" class="input input--city select">
                        <option value="1">Димитровград</option>
                        <option value="2">Ульяновск</option>
                    </select>
                    @error('city')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="country">Ваша страна</label>
                    <select name="country" id="country" name="country" class="input input--country select">
                        <option value="1">Россия</option>
                    </select>
                    @error('country')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group" style="flex-direction: column; margin-bottom:32px">
                    <label for="">Выберите тематику</label>
                    <div class="form-formats">
                        <div class="form__row form-format">
                            <input type="checkbox" id="format-1" name="format-1" class="form-format__check">
                            <label for="format-1">Финансы</label>
                        </div>
                        <div class="form__row form-format">
                            <input type="checkbox" id="format-2" name="format-2" class="form-format__check">
                            <label for="format-2">Биология</label>
                        </div>
                        <div class="form__row form-format">
                            <input type="checkbox" id="format-3" name="format-3" class="form-format__check">
                            <label for="format-3">Животные и питомцы</label>
                        </div>
                        <div class="form__row form-format">
                            <input type="checkbox" id="format-4" name="format-4" class="form-format__check">
                            <label for="format-4">Другое</label>
                        </div>
                    </div>
                </div>
                <div class="form-btns auth__form-btns">
                    <button class="btn btn-primary next" type="submit">
                        Отправить на модерацию
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
