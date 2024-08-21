<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Unbounded:wght@200..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">

    <script src="{{ asset('libs/jquery/jquery-3.7.1.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('libs/jquery/jquery.maskedinput.min.js') }}"></script>

    <title>Панель управления</title>
</head>
<body>
    <div class="wrapper" id = "admin-app">
        <admin-index></admin-index>
    </div>
    {{-- <div class="popup" id="accept-form">
        <div class="popup__container _container">
            <div class="popup__body">
                <div class="popup__title title">
                    Заполните данные
                </div>
                <div class="popup__form">
                    <div class="form-group">
                        <label for="desc">Описание канала</label>
                        <textarea name="desc" id="desc" cols="30" rows="10" class="textarea" placeholder="Введите текст"></textarea>
                    </div>
                    <div class="form-row filter__item" style="display: flex; gap:10px;">
                        <div class="form-group">
                            <label for="gender_ratio">Мужчины, %</label>
                            <input id="gender_ratio" name="gender_ratio" type="number" class="input" max="100" value = "50">
                        </div>
                        <div class="form-group">
                            <label for="gender_ratio_f">Женщины, %</label>
                            <input id="gender_ratio_f" name="gender_ratio_f" type="number" class="input" max="100" value = "50">
                        </div>
                    </div>
                    <script>
                        $("#gender_ratio").on('change', function(e) {
                            $('#gender_ratio_f').val(100 - Number($(e.target).val()))
                        })
                        $("#gender_ratio_f").on('change', function(e) {
                            $('#gender_ratio').val(100 - Number($(e.target).val()))
                        })

                    </script>
                    <div class="form-row filter__item">
                        <div class="form-group">
                            <label for="sex">Пол блогера</label>
                            <select name="sex" id="sex" class="input">
                                <option value="male" class="">Мужской</option>
                                <option value="female" class="">Женский</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="country">Страна блогера</label>
                            <select name="country" id="country" class="input">
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="city">Город блогера</label>
                            <input id="city" name="city" type="text" class="input">
                        </div>
                        <label for="">Статистика по блогеру</label>
                        @php(
                            $platforms_main_cover_titles = [
                                'Telegram' => 'Просмотры',
                                'VK' => 'Просмотры постов',
                                'Youtube' => 'Просмотры выпуска',
                                'Instagram' => 'Просмотры reels',
                            ]
                        )
                        @php(
                            $platforms_additional_cover_titles = [
                                'VK' => 'Просмотры клипов',
                                'Youtube' => 'Просмотры shorts',
                            ]
                        )
                        @foreach($platforms as $platform)
                        <div class="popup__form-row popup__form-stat form-stat">
                            <div class="form-stat__title">
                                {{ $platform }}
                            </div>
                            <div class="form-stat__content">
                                <div class="form-stat__row">
                                    <div class="form-group" style="width:100%; max-width:100%">
                                        <label for="{{ strtolower($platform) }}_link">Ссылка</label>
                                        <input id="{{ strtolower($platform) }}_link" type="text" class="input" name="" style="width:100%; max-width:100%">
                                    </div>
                                </div>
                                <div class="form-stat__row">
                                    <div class="form-group">
                                        <label for="{{ strtolower($platform) }}_subs">Подписчики</label>
                                        <input id="{{ strtolower($platform) }}_subs" type="text" class="input" name="">
                                    </div>
                                    <div class="form-group">
                                        <label for="{{ strtolower($platform) }}_cpm">CPM</label>
                                        <input id="{{ strtolower($platform) }}_cpm" type="text" class="input" name="">
                                    </div>
                                </div>

                                @if(isset($platforms_main_cover_titles[$platform]))
                                    <div class="form-stat__row">
                                        <div class="form-group">
                                            <label for="{{ strtolower($platform) }}_cover">{{ $platforms_main_cover_titles[$platform] }}</label>
                                            <input id="{{ strtolower($platform) }}_cover" type="text" class="input" name="">
                                        </div>
                                        <div class="form-group">
                                            <label for="{{ strtolower($platform) }}_er">ER %</label>
                                            <input id="{{ strtolower($platform) }}_er" type="text" class="input" name="">
                                        </div>
                                    </div>
                                @endif

                                @if(isset($platforms_additional_cover_titles[$platform]))
                                    <div class="form-stat__row">
                                        <div class="form-group">
                                            <label for="{{ strtolower($platform) }}_additional_cover">{{ $platforms_additional_cover_titles[$platform] }}</label>
                                            <input id="{{ strtolower($platform) }}_additional_cover" type="text" class="input" name="">
                                        </div>
                                        <div class="form-group">
                                            <label for="{{ strtolower($platform) }}_additional_er">ER %</label>
                                            <input id="{{ strtolower($platform) }}_additional_er" type="text" class="input" name="">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                        <div class="form-group">
                            <div class="input-checkbox-w">
                                <input name="is_achievement" type="checkbox" class="checkbox whois" id="is_achievement">
                                <label for="">Проверенный блогер</label>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary send-data">
                        Отправить
                    </button>
                </div>
                <div class="close-popup">
                    <img src="{{ asset('admin/img/close-icon.svg') }}" alt="">
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <div class="popup" id="achivments-form">
        <div class="popup__container _container">
            <div class="popup__body">
                <div class="popup__title title">
                    Выберите достижения
                </div>
                <div class="popup__form">
                    <div class="achivments-form">
                        <div class="achivments-form__items achivments-form__row">
                            <div class="achivments-form__item">
                                Проверенный блогер
                            </div>
                        </div>
                    </div>
                </div>
                <div class="close-popup">
                    <img src="{{ asset('admin/img/close-icon.svg') }}" alt="">
                </div>
            </div>
        </div>
    </div> --}}
</body>
<script src="{{ asset('admin/js/script.js') }}"></script>
<script src = "./js/app.js"></script>
</html>
