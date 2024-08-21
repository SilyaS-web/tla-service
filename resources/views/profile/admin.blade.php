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
                    <div class="header__row">
                        <div class="header__title">
                            Панель управления
                        </div>
                        <div class="header__menu-btn">
                            <img src="{{asset('admin/img/menu-icon.svg')}}" alt="">
                        </div>
                    </div>
                    <div class="header__leave">
                        <form action="{{ route('logout') }}" method="POST" class="">
                            @csrf
                            <button type="header__leave">Выход</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <section class="admin-view">
            <div class="admin-view__container _container active-menu">
                <div class="admin-view__body">
                    <aside class="admin-menu">
                        <div class="admin-menu__container">
                            <div class="admin-menu__body">
                                <nav class="nav admin-menu__nav">
                                    <div class="nav__items">

                                        <a href="" class="nav__link tab active" data-content="moderation" title="Модерация блогеров">
                                            <img src="{{ asset('admin/img/blogers-list-icon.svg') }}" alt="" class="nav__link-img">
                                            Модерация блогеров
                                        </a>
                                        <a href="" class="nav__link tab" data-content="blogers-list" title="Список блогеров">
                                            <img src="{{ asset('admin/img/blog-icon.svg') }}" alt="" class="nav__link-img">
                                            Список блогеров
                                        </a>
                                        <a href="" class="nav__link tab" data-content="sellers-list" title="Список селлеров">
                                            <img src="{{ asset('admin/img/money-icon.svg') }}" alt="" class="nav__link-img">
                                            Список селлеров
                                        </a>
                                        <a href="" class="nav__link tab" data-content="projects-list" title="Модерация проектов">
                                            <img src="{{ asset('admin/img/list-icon.svg') }}" alt="" class="nav__link-img">
                                            Модерация проектов
                                        </a>
                                        <a href="" class="nav__link tab" data-content="payment-history" title="История заказов">
                                            <img src="{{ asset('admin/img/history-icon.svg') }}" alt="" class="nav__link-img">
                                            История заказов

                                        </a>
                                    </div>
                                </nav>

                            </div>
                        </div>
                    </aside>
                    <div class="admin-view__content admin-blogers tab-content active" id="moderation">
                        <div class="admin-blogers__body">
                            <div class="admin-blogers__header">
                                <div class="admin-blogers__title title">
                                    Модерация блогеров • {{ $unverified_users->count() }}
                                </div>
                                {{-- <div class="admin-blogers__search form-group">
                                    <input type="name" id="moderation-search" class="input" placeholder="Введите название">
                                    <button class="btn btn-primary moderation-search-btn">Найти</button>
                                </div> --}}
                            </div>
                            @include('shared.admin.unverified-users-list')
                        </div>
                    </div>
                    <div class="admin-view__content blogers-list tab-content" id="blogers-list">
                        <div class="admin-blogers__body">
                            <div class="admin-blogers__header">
                                <div class="admin-blogers__title title">
                                    Список блогеров • {{ $bloggers->count() }}
                                </div>
                                {{-- <div class="admin-blogers__search form-group">
                                    <input type="name" id="blogers-search" class="input" placeholder="Введите название">
                                    <button class="btn btn-primary blogers-search-btn">Найти</button>
                                </div> --}}
                            </div>
                            @include('shared.admin.bloggers-list')
                        </div>
                    </div>
                    <div class="admin-view__content blogers-list tab-content" id="sellers-list">
                        <div class="admin-blogers__body">
                            <div class="admin-blogers__header">
                                <div class="admin-blogers__title title">
                                    Список селлеров • {{ $sellers->count() }}
                                </div>
                                {{-- <div class="admin-blogers__search form-group">
                                    <input type="name" id="sellers-search" class="input" placeholder="Введите название">
                                    <button class="btn btn-primary sellers-search-btn">Найти</button>
                                </div> --}}
                            </div>
                            @include('shared.admin.sellers-list')
                        </div>
                    </div>
                    <div class="admin-view__content projects-list tab-content" id="projects-list">
                        <div class="admin-blogers__body">
                            <div class="admin-blogers__header">
                                <div class="admin-blogers__title title">
                                    Список проектов • {{ $all_projects->count() }}
                                </div>
                                {{-- <div class="admin-blogers__search form-group">
                                    <input type="name" id="sellers-search" class="input" placeholder="Введите название">
                                    <button class="btn btn-primary sellers-search-btn">Найти</button>
                                </div> --}}
                            </div>
                            @include('project.admin-list')
                        </div>
                    </div>
                    <div class="admin-view__content payment-history tab-content" id="payment-history">
                        <div class="admin-blogers__body">
                            <div class="admin-blogers__header">
                                <div class="admin-blogers__title title">
                                    История заказов • {{ $payments->count() }}
                                </div>
                                {{-- <div class="admin-blogers__search form-group">
                                    <input type="name" id="sellers-search" class="input" placeholder="Поиск">
                                    <button class="btn btn-primary sellers-search-btn">Найти</button>
                                </div> --}}
                            </div>
                            <div class="payment-history__body admin-view__content-wrap">
                                <div class="payment-history__items">
                                    @forelse ($payments as $payment)
                                        <div class="payment-history__row">
                                            <div href="" class="payment-history__row-title">
                                                <span>Заказ № {{ $payment->id }}</span>
                                                от {{ date_format($payment->created_at,'d-m-Y H:i') }}
                                            </div>
                                            <div class="payment-history__row-status">
                                                <span>Статус</span>
                                                <strong>{{ $payment->status }}</strong>
                                            </div>
                                            <div class="payment-history__row-summary">
                                                <span>Сумма</span>
                                                <strong>{{ $payment->price / 100 }} <b class="rub">₽</b></strong>
                                            </div>
                                            <div class="payment-history__row-user">
                                                <span>Пользователь</span>
                                                @php($payment_user = $payment->user)
                                                <strong><a href="{{ route('seller-page', ['seller' => $payment_user->seller->id]) }}">{{ $payment_user->name }} ID {{ $payment_user->id }}</a></strong>
                                            </div>
                                            <div class="payment-history__row-tariff">
                                                <span>Тариф</span>
                                                <strong>{{ $payment->tariff->tariffGroup->title }} — {{ $payment->tariff->title }}</strong>
                                            </div>
                                            <div class="payment-history__row-bank_id">
                                                <span>ID оплаты</span>
                                                <strong>{{ $payment->payment_id }}</strong>
                                            </div>
                                        </div>
                                    @empty
                                        Нет оплат
                                    @endforelse
                                </div>
                            </div>
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
    <div class="popup" id="confirm-deletion" style="">
        <div class="popup__container _container">
            <div class="popup__body">
                <div class="popup__header">
                    <div class="popup__title title">
                        Подтвердите действие
                    </div>
                    <div class="popup__subtitle subtitle">
                        После подтверждения пользователя нельзя будет восстановить
                    </div>
                </div>
                <div class="popup__form">
                    <div class="popup__form-btns">
                        <button class="btn btn-primary send-data">
                            Подтвердить
                        </button>
                        <button class="btn btn-secondary close-popup-btn">
                            Отмена
                        </button>
                    </div>
                </div>
                <div class="close-popup">
                    <img src="{{ asset('img/close-icon.svg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('admin/js/script.js') }}"></script>
<script src = "./js/app.js"></script>
</html>
