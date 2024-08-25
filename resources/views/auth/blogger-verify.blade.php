@extends('layout.layout')

@section('title', $title ?? 'Регистрация блогера')

@section('content')
<section class="auth">
    <div class="auth__container _container">
        <div class="auth__body auth__steps">
            <div class="auth__title title">
                Заполните поля
            </div>
            <form class="form auth__form" enctype="multipart/form-data" method="POST" action="{{ route('create-blogger') }}">
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
                        @foreach ($countries as $country)
                        <option value="{{ $country->id }}" {{ old('country') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                        @endforeach
                    </select>
                    @error('country')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="sex">Ваш пол</label>
                    <select name="sex" id="sex" name="sex" class="input input--sex select">
                        <option value="male" {{ old('sex') == 'male' ? 'selected' : '' }}>Мужской</option>
                        <option value="female" {{ old('sex') == 'female' ? 'selected' : '' }}>Женский</option>
                    </select>
                    @error('sex')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="desc">Описание канала</label>
                    <textarea name="desc" id="desc" cols="30" rows="10" class="textarea" placeholder="Введите текст">{{ old('desc') }}</textarea>
                    @error('description')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group" style="flex-direction: column; margin-bottom:25px">
                    <label for="">Выберите тематику</label>
                    <div class="form-formats">
                        @foreach ($themes as $theme)
                            @php($selected = '')
                            @if (old('themes'))
                                @foreach(old('themes') as $old_theme)
                                        @if ($theme->id == $old_theme)
                                            @php($selected = 'checked')
                                            @break
                                        @endif
                                @endforeach
                            @endif
                            <div class="form__row form-format">
                                <input type="checkbox" id="theme-{{ $theme->id }}" name="themes[]" class="form-format__check" {{ $selected }} value="{{ $theme->id }}">
                                <label for="theme-{{ $theme->id }}">{{ $theme->theme }}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('themes')
                    <span class="error">{{ $message }}</span>
                    @enderror
                    <script>
                        $(window).on('load', function(){
                            $('.form-format .form-format__check').on('change', function(e){
                                var list = $('.form-format .form-format__check:checked');

                                if(list.length > 3){
                                    $(e.target).prop('checked', false);
                                    notify('info', {title: 'Внимание', message: 'Нельзя выбрать больше 3-х тематик'});
                                }
                            })
                        })
                    </script>
                </div>
                <div class="form-group">
                    <label for="" class="form-group__title">Социальные сети</label>
                    <label for="" class="form-group__subtitle">Ниже предоставьте ссылки на соц. сети вашего канала</label>
                </div>
                <div class="popup__form-row popup__form-stat form-stat active">
                    <div class="form-stat__title">
                        Telegram
                    </div>
                    <div class="form-stat__content">
                        <div class="form-stat__row">
                            <div class="form-group" style="width:100%; max-width:100%">
                                <label for="tg_link">Ссылка</label>
                                <input id="tg_link" type="text" class="input" name="tg-link" style="width:100%; max-width:100%" value="{{ old('tg-link') }}">
                            </div>
                        </div>
                        @error('tg-link')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="popup__form-row popup__form-stat form-stat ">
                    <div class="form-stat__title">
                        Ins
                    </div>
                    <div class="form-stat__content">
                        <div class="form-stat__row">
                            <div class="form-group" style="width:100%; max-width:100%">
                                <label for="inst_link">Ссылка</label>
                                <input id="inst_link" type="text" class="input" name="inst-link" style="width:100%; max-width:100%" value="{{ old('inst-link') }}">
                            </div>
                        </div>
                        @error('inst-link')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="popup__form-row popup__form-stat form-stat ">
                    <div class="form-stat__title">
                        YTube
                    </div>
                    <div class="form-stat__content">
                        <div class="form-stat__row">
                            <div class="form-group" style="width:100%; max-width:100%">
                                <label for="yt_link">Ссылка</label>
                                <input id="yt_link" type="text" class="input" name="yt-link" style="width:100%; max-width:100%" value="{{ old('yt-link') }}">
                            </div>
                        </div>
                        @error('yt-link')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="popup__form-row popup__form-stat form-stat " style="margin-bottom:25px">
                    <div class="form-stat__title">
                        Вконтакте
                    </div>
                    <div class="form-stat__content">
                        <div class="form-stat__row">
                            <div class="form-group" style="width:100%; max-width:100%">
                                <label for="vk_link">Ссылка</label>
                                <input id="vk_link" type="text" class="input" name="vk-link" style="width:100%; max-width:100%" value="{{ old('vk-link') }}">
                            </div>
                        </div>
                        @error('vk-link')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group form-group--file">
                    <label class="tab-content__profile-img-upload input-file" for="profile-img">
                        <div class="input-file__col">
                            <span class = "input-file__notify">Загрузите изображение профиля</span>
                            <span class = "input-file__file-name"></span>
                        </div>
                        <input type="file" name="image" class="" id="profile-img">
                        <span>Загрузите изображение профиля</span>
                        <input type="file" name="image" class="" id="profile-img" value="{{ old('image') }}">
                    </label>
                    @error('image')
                    <span class="error">{{ $message }}</span>
                    @enderror
                    <script>
                        $(window).on('load', function(){
                           $('#profile-img').on('change', function(e){
                                var file = e.target.files[0];

                               $(e.target).closest('.tab-content__profile-img-upload').addClass('uploaded');
                               $(e.target).closest('.tab-content__profile-img-upload').find('span.input-file__notify').text('Аватарка профиля загружена');
                               $(e.target).closest('.tab-content__profile-img-upload').find('span.input-file__file-name').text(file.name);
                           })
                       })
                   </script>
                </div>
                <div class="form-btns auth__form-btns" style="margin-top:32px">
                    <button class="btn btn-primary next" type="submit">
                        Отправить на модерацию
                    </button>
                </div>
                <p class="form-addit">
                    Заполняя поля, вы даёте на это согласие и принимаете условия <a href="https://adswap.ru/privacy">Политики конфиденциальности.</a>
                </p>
            </form>
        </div>
    </div>
</section>
@endsection
