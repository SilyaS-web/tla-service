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
                    <label for="city">Ваш город</label>
                    <input type="text" id="city" name="city" placeholder="Введите название города" class="input input--city" value="{{ old('city') }}">
                    @error('city')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="country">Ваша страна (Страны СНГ)</label>
                    <select name="country" id="country" name="country" class="input input--country select">
                        <option value="1">Россия</option>
                    </select>
                    @error('country')
                        <span class="error">{{ $message }}</span>
                    @enderror
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
                    <label for="desc">Описание канала</label>
                    <textarea name="desc" id="desc" cols="30" rows="10" class="textarea" placeholder="Введите текст"></textarea>
                </div>
                <div class="form-group" style="flex-direction: column;">
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
                <div class="popup__form-row popup__form-stat form-stat">
                    <div class="form-stat__title">
                        Telegram
                    </div>
                    <div class="form-stat__content">
                        <div class="form-stat__row">
                            <div class="form-group" style="width:100%; max-width:100%">
                                <label for="tg_link">Ссылка</label>
                                <input id = "tg_link" type="text" class="input" name = "" style="width:100%; max-width:100%">
                            </div>
                        </div>
                        <div class="form-stat__row">
                            <div class="form-group">
                                <label for="tg_subs">Подписчики</label>
                                <input id = "tg_subs" type="text" class="input" name = "">
                            </div>
                            <div class="form-group">
                                <label for="tg_cover">Охваты</label>
                                <input id = "tg_cover" type="text" class="input" name = "">
                            </div>
                        </div>
                        <div class="form-stat__row">
                            <div class="form-group">
                                <label for="tg_er">ER</label>
                                <input id = "tg_er" type="text" class="input" name = "">
                            </div>
                            <div class="form-group">
                                <label for="tg_cpm">CPM</label>
                                <input id = "tg_cpm" type="text" class="input" name = "">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="popup__form-row popup__form-stat form-stat">
                    <div class="form-stat__title">
                        Instagram
                    </div>
                    <div class="form-stat__content">
                        <div class="form-stat__row">
                            <div class="form-group" style="width:100%; max-width:100%">
                                <label for="inst_link">Ссылка</label>
                                <input id = "inst_link" type="text" class="input" name = "" style="width:100%; max-width:100%">
                            </div>
                        </div>
                        <div class="form-stat__row">
                            <div class="form-group">
                                <label for="inst_subs">Подписчики</label>
                                <input id = "inst_subs" type="text" class="input" name = "">
                            </div>
                            <div class="form-group">
                                <label for="inst_cover">Охваты</label>
                                <input id = "inst_cover" type="text" class="input" name = "">
                            </div>
                        </div>
                        <div class="form-stat__row">
                            <div class="form-group">
                                <label for="inst_er">ER</label>
                                <input id = "inst_er" type="text" class="input" name = "">
                            </div>
                            <div class="form-group">
                                <label for="inst_cpm">CPM</label>
                                <input id = "inst_cpm" type="text" class="input" name = "">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="popup__form-row popup__form-stat form-stat">
                    <div class="form-stat__title">
                        Youtube
                    </div>
                    <div class="form-stat__content">
                        <div class="form-stat__row">
                            <div class="form-group" style="width:100%; max-width:100%">
                                <label for="yt_link">Ссылка</label>
                                <input id = "yt_link" type="text" class="input" name = "" style="width:100%; max-width:100%">
                            </div>
                        </div>
                        <div class="form-stat__row">
                            <div class="form-group">
                                <label for="yt_subs">Подписчики</label>
                                <input id = "yt_subs" type="text" class="input" name = "">
                            </div>
                            <div class="form-group">
                                <label for="yt_cover">Охваты</label>
                                <input id = "yt_cover" type="text" class="input" name = "">
                            </div>
                        </div>
                        <div class="form-stat__row">
                            <div class="form-group">
                                <label for="yt_er">ER</label>
                                <input id = "yt_er" type="text" class="input" name = "">
                            </div>
                            <div class="form-group">
                                <label for="yt_cpm">CPM</label>
                                <input id = "yt_cpm" type="text" class="input" name = "">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="popup__form-row popup__form-stat form-stat">
                    <div class="form-stat__title">
                        Вконтакте
                    </div>
                    <div class="form-stat__content">
                        <div class="form-stat__row" >
                            <div class="form-group" style="width:100%; max-width:100%">
                                <label for="vk_link">Ссылка</label>
                                <input id = "vk_link" type="text" class="input" name = "" style="width:100%; max-width:100%">
                            </div>
                        </div>
                        <div class="form-stat__row">
                            <div class="form-group">
                                <label for="vk_subs">Подписчики</label>
                                <input id = "vk_subs" type="text" class="input" name = "">
                            </div>
                            <div class="form-group">
                                <label for="vk_cover">Охваты</label>
                                <input id = "vk_cover" type="text" class="input" name = "">
                            </div>
                        </div>
                        <div class="form-stat__row">
                            <div class="form-group">
                                <label for="vk_er">ER</label>
                                <input id = "vk_er" type="text" class="input" name = "">
                            </div>
                            <div class="form-group">
                                <label for="vk_cpm">CPM</label>
                                <input id = "vk_cpm" type="text" class="input" name = "">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-btns auth__form-btns" style="margin-top:32px">
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
