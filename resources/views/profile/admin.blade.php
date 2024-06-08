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
    <div class="wrapper">
        <div class="burger-menu">
            <div class="admin-menu__body">
                <div class="admin-menu__title">
                    Выберите раздел
                </div>
                <nav class="nav admin-menu__nav">
                    <div class="nav__items">
                        <a href="" class="nav__link">
                            Модерация блогеров
                        </a>
                    </div>
                </nav>
                <a href="#" class="admin-menu__leave">Выйти</a>
            </div>
        </div>

        <header class="header">
            <div class="header__container _container">
                <div class="header__body">
                    <div class="header__col">
                        <div class="header__title">
                            Панель управления
                        </div>
                    </div>
                    <div class="header__col">
                        <div class="header__leave">
                            <form action="{{ route('logout') }}" method="POST" class="">
                                @csrf
                                <button type="header__leave">Выход</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <section class="admin-view">
            <div class="admin-view__container _container">
                <div class="admin-view__body">
                    <aside class="admin-menu">
                        <div class="admin-menu__container">
                            <div class="admin-menu__body">
                                <nav class="nav admin-menu__nav">
                                    <div class="nav__items">
                                        <a href="" class="nav__link tab active" data-content="moderation" title="Модерация блогеров">
                                            <img src="{{ asset('admin/img/list-icon.svg') }}" alt="" class="nav__link-img">
                                        </a>
                                        <a href="" class="nav__link tab" data-content="blogers-list" title="Список блогеров">
                                            <img src="{{ asset('admin/img/blog-icon.svg') }}" alt="" class="nav__link-img">
                                        </a>
                                        <a href="" class="nav__link tab" data-content="sellers-list" title="Список селлеров">
                                            <img src="{{ asset('admin/img/money-icon.svg') }}" alt="" class="nav__link-img">
                                        </a>
                                    </div>
                                </nav>

                            </div>
                        </div>
                    </aside>
                    <div class="admin-view__blogers admin-blogers tab-content active" id="moderation">
                        <div class="admin-blogers__body">
                            <div class="admin-blogers__header">
                                <div class="admin-blogers__title title">
                                    Модерация блогеров
                                </div>
                                <div class="admin-blogers__search form-group">
                                    <input type="name" id="moderation-search" class="input" placeholder="Введите название">
                                    <button class="btn btn-primary moderation-search-btn">Найти</button>
                                </div>
                            </div>
                            @include('shared.admin.unverified-users-list')
                        </div>
                    </div>
                    <div class="admin-view__blogers blogers-list tab-content" id="blogers-list">
                        <div class="admin-blogers__body">
                            <div class="admin-blogers__header">
                                <div class="admin-blogers__title title">
                                    Список блогеров
                                </div>
                                <div class="admin-blogers__search form-group">
                                    <input type="name" id="blogers-search" class="input" placeholder="Введите название">
                                    <button class="btn btn-primary blogers-search-btn">Найти</button>
                                </div>
                            </div>
                            @include('shared.admin.bloggers-list')
                        </div>
                    </div>
                    <div class="admin-view__blogers blogers-list tab-content" id="sellers-list">
                        <div class="admin-blogers__body">
                            <div class="admin-blogers__header">
                                <div class="admin-blogers__title title">
                                    Список селлеров
                                </div>
                                <div class="admin-blogers__search form-group">
                                    <input type="name" id="sellers-search" class="input" placeholder="Введите название">
                                    <button class="btn btn-primary sellers-search-btn">Найти</button>
                                </div>
                            </div>
                            @include('shared.admin.sellers-list')
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="notification" style="display: none;">
            <div class="notification__body">
                <div class="notification__title">Внимание!</div>
                <div class="notification__text">
                    Проект успешно создан
                </div>
            </div>
        </div>

    </div>
    <div class="popup" id="accept-form">
        <div class="popup__container _container">
            <div class="popup__body">
                <div class="popup__title title">
                    Заполните данные
                </div>
                <div class="popup__form">
                    <label for="">Статистика по блогеру</label>
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
                    <div class="form-group">
                        <label for="desc">Описание канала</label>
                        <textarea name="desc" id="desc" cols="30" rows="10" class="textarea" placeholder="Введите текст"></textarea>
                    </div>
                    <div class="form-row filter__item" style="display: flex; gap:10px;">
                        <div class="form-group">
                            <label for="gender_ratio">Мужчины, %</label>
                            <input id="gender_ratio" name="gender_ratio" type="number" class="input">
                        </div>
                        <div class="form-group">
                            <label for="gender_ratio_f">Женщины, %</label>
                            <input id="gender_ratio_f" name="gender_ratio_f" type="number" class="input">
                        </div>
                    </div>
                    <script>
                        $("#gender_ratio").on('change', function(e){
                            $('#gender_ratio_f').val(100 - Number($(e.target).val()))
                        })
                        $("#gender_ratio_f").on('change', function(e){
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
                                <option value="1" class="">Россия</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="city">Город блогера</label>
                            <select name="city" id="city" class="input">
                                <option value="1" class="">Димитровград</option>
                                <option value="2" class="">Самара</option>
                            </select>
                        </div>
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
    </div>
    <div class="popup" id="achivments-form">
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
    </div>
</body>
<script src="{{ asset('admin/js/script.js') }}"></script>
</html>
