<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@200..900&display=swap" rel="stylesheet"> -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Unbounded:wght@200..900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('img/adswap_1_2.svg') }}" type="image/x-icon">

    <script src="{{ asset('libs/jquery/jquery-3.7.1.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('libs/jquery/jquery.maskedinput.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('libs/owl/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/owl/owl.theme.default.css') }}">

    <link rel="stylesheet" href="{{ asset('libs/meter/style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loader.css') }}">

    <script src="{{ asset('libs/chart/chart.js') }}"></script>
    <script src="{{ asset('libs/funnel/funnel-chart.js') }}"></script>

    <script async src="https://script.click-chat.ru/chat.js?wid=f12436e7-a36d-437d-8783-ec27bf222c55"></script>

    <title>@yield('title')</title>
</head>
<body>
    <div class="wrapper" style="background-color: #fff;">
        @auth
        <div class="burger-menu">
            <div class="burger-menu__body">
                <div class="header__col header__profile-items">
                    <div class="header__row">
                        <div href="#" class="header__profile-w header__profile-header header__profile-item--js">
                            <a href="/">
                                <img src="{{ auth()->user()->getImageURL() }}" alt="" class="header__profile">
                            </a>
                            <div class="header__profile-col">
                                <span class="header__profile-name">
                                    {{ auth()->user()->name }}
                                </span>
                                <span class="header__profile-org">
                                    @if ( auth()->user()->role == 'seller')
                                        @if (isset(auth()->user()->seller->organization_name) && !empty(auth()->user()->seller->organization_name))
                                            {{ auth()->user()->seller->organization_type }} "{{ auth()->user()->seller->organization_name }}"
                                        @endif
                                    @elseif (auth()->user()->blogger)
                                    {{ auth()->user()->blogger->name }}
                                    @endif
                                </span>
                            </div>
                            <div class="header__profile-settings">
                                <a href="{{ route('edit-profile') }}" class="row">
                                    Личные данные
                                </a>
                                @if ( auth()->user()->role == 'seller')
                                    <a href="{{ route('tariff') }}" class="row">
                                        Тарифы
                                    </a>
                                @endif
                                <form action="{{ route('logout') }}" method="POST" class="row">
                                    @csrf
                                    <button type="submit" style="width:100%; text-align:left">Выход</button>
                                </form>
                            </div>
                        </div>
                        <a href="#" class="header__col header__notif header__profile-item--js" title="Уведомления">
                            <div class="header__profile-notif header-notif-count" style="display: none">
                                0
                            </div>
                            <img src="{{ asset('img/notif-icon.svg') }}" alt="" class="">
                            <div class="header__notif-items notif-header">
                                <div class="notif-header__items header-notif-container">
                                    @include('shared.notifications')
                                </div>
                            </div>
                        </a>
                        {{-- <a href="#" class="header__col header__notif header__profile-item--js" title="Уведомления">
                            <div class="header__profile-notif">
                                0
                            </div>
                            <img src="{{ asset('img/notif-icon.svg') }}" alt="" class="">
                            <div class="header__notif-items notif-header">
                                <div class="notif-header__items">
                                    <div class="notif-header__row ">
                                        <div class="notif-header__col notif-header__img">
                                            <img src="{{ asset('img/profile-icon.svg') }}" alt="">
                                        </div>
                                        <div class="notif-header__col">
                                            <div class="notif-header__title">
                                                Заявка №1233 подтверждена
                                            </div>
                                            <div class="notif-header__text">
                                                Блогер "Чертовски мило" подтвердил заявку, начните переписку с ним, чтобы обсудить подробности.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a> --}}
                    </div>
                    @if ( auth()->user()->role == 'seller')
                        <div href="#" class="header__col header__tarrif tarrif-header header__profile-item--js">
                            @php($seller_tariffs = Auth()->user()->getActiveTariffs())
                            Мои тарифы
                            <div class="tarrif-header__items">
                                @forelse ($seller_tariffs as $seller_tariff)
                                    <div class="tarrif-header__item tarrif-header__adv">
                                        {{ $seller_tariff->tariff->tariffGroup->title }} - <b><span class="counter">{{ $seller_tariff->quantity }}</span> шт.</b>
                                        <div class="tarrif-header__date">
                                            Действует до {{ date('d.m.Y', strtotime($seller_tariff->finish_date)) }}
                                        </div>
                                        <a href="{{ route('tariff') }}" class="tarrif-header__buy">Продлить</a>
                                    </div>
                                @empty
                                    <div class="tarrif-header__item tarrif-header__adv">
                                        Нет оплаченых тарифов
                                        <a href="{{ route('tariff') }}" class="tarrif-header__buy">Выбрать тариф</a>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @endif
                </div>
                <div class="burger-menu__nav nav-burger">
                    <a href="{{ route('profile') }}" class="nav-burger__link nav__link">
                        @if ( auth()->user()->role == 'seller')
                            Дашборд
                        @elseif (auth()->user()->blogger)
                            Главная
                        @endif
                    </a>
                    <a href="https://adswap.ru/instructions" class="nav-burger__link nav__link">Инструкции</a>
                    <a href="https://adswap.ru/files" class="nav-burger__link nav__link">Файлы</a>
                    <a href="https://adswap.ru/news" class="nav-burger__link nav__link">Новости</a>
                </div>
                <a href="#" class="burger-menu__close">
                    <img src="{{ asset('img/close-icon.svg') }}" alt="">
                </a>

                <div class="burger-contacts">
                    <div class="footer__contacts-contacts">
                        <div class="footer__contacts-item">
                            adswap.ru@ya.ru
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endauth
        <header class="header">
            <div class="header__container _container">
                <div class="header__body">
                    <a href="/" class="logo header__logo-w">
                        <img src="{{ asset('img/logo.svg') }}" alt="" class="logo__logo header__logo">
                    </a>
                    @auth
                    <nav class="nav header__nav">
                        <div class="nav__items">
                            <a href="{{ route('profile') }}" class="nav__link">
                                @if ( auth()->user()->role == 'seller')
                                Дашборд
                                @elseif (auth()->user()->blogger)
                                Главная
                                @endif
                            </a>
                            <a href="https://adswap.ru/instructions" class="nav__link">Инструкции</a>
                            <a href="https://adswap.ru/files" class="nav__link">Файлы</a>
                            <a href="https://adswap.ru/news" class="nav__link">Новости</a>
                        </div>
                    </nav>


                    <div class=" header__profile-items header__profile-items--desktop header__row">
                        @if ( auth()->user()->role == 'seller')
                            <div href="#" class="header__col header__tarrif tarrif-header header__profile-item--js">
                                @php($seller_tariffs = Auth()->user()->getActiveTariffs())
                                 Мои тарифы
                                <div class="tarrif-header__items">
                                    @forelse ($seller_tariffs as $seller_tariff)
                                        <div class="tarrif-header__item tarrif-header__adv">
                                            {{ $seller_tariff->tariff->tariffGroup->title }} - <b><span class="counter">{{ $seller_tariff->quantity }}</span> шт.</b>
                                            <div class="tarrif-header__date">
                                                Действует до {{ date('d.m.Y', strtotime($seller_tariff->finish_date)) }}
                                            </div>
                                            <a href="{{ route('tariff') }}" class="tarrif-header__buy">Продлить</a>
                                        </div>
                                    @empty
                                        <div class="tarrif-header__item tarrif-header__adv">
                                            Нет оплаченых тарифов
                                            <a href="{{ route('tariff') }}" class="tarrif-header__buy">Выбрать тариф</a>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        @endif
                        <a href="#" class="header__col header__notif header__profile-item--js" title="Уведомления">
                            <div class="header__profile-notif header-notif-count" style="display: none">

                            </div>
                            <img src="{{ asset('img/notif-icon.svg') }}" alt="" class="">
                            <div class="header__notif-items notif-header">
                                <div class="notif-header__items header-notif-container" >
                                    @include('shared.notifications')
                                </div>
                            </div>
                        </a>
                        <div href="#" class="header__profile-w header__profile-header header__profile-item--js">
                            <img src="{{ auth()->user()->getImageURL() }}" alt="" class="header__profile">
                            <div class="header__profile-col">
                                <span class="header__profile-name" data-user-id="{{ auth()->user()->id }}">
                                    {{ auth()->user()->name }}
                                </span>
                                <span class="header__profile-org">
                                    @if ( auth()->user()->role == 'seller')
                                        @if (isset(auth()->user()->seller->organization_name) && !empty(auth()->user()->seller->organization_name))
                                            {{ auth()->user()->seller->organization_type }} "{{ auth()->user()->seller->organization_name }}"
                                        @endif
                                    @elseif (auth()->user()->blogger)
                                        {{ auth()->user()->blogger->name }}
                                    @endif
                                </span>
                            </div>
                            <div class="header__profile-settings">
                                <a href="{{ route('edit-profile') }}" class="row">
                                    Личные данные
                                </a>
                                @if ( auth()->user()->role == 'seller')
                                    <a href="{{ route('tariff') }}" class="row">
                                        Тарифы
                                    </a>
                                @endif
                                <form action="{{ route('logout') }}" method="POST" class="row">
                                    @csrf
                                    <button type="submit" style="width:100%; text-align:left">Выход</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="header__menu burger">
                        <img src="{{ asset('img/menu-icon.svg') }}" alt="">
                    </a>
                    @endauth
                </div>
            </div>
        </header>
        @yield('content')

        <footer class="footer">
            <div class="footer__container _container">
                <div class="footer__body">
                    <a href="https://adswap.ru/privacy" target="_blank" class="footer__policy">
                        Политика конфиденциальности
                    </a>
                    <a href="https://adswap.ru/agreement" target="_blank" class="footer__policy">
                        Пользовательское соглашение
                    </a>
                    <a href="mailto:adswap.ru@ya.ru" class="footer__policy">
                        adswap.ru@ya.ru
                    </a>
                </div>
            </div>
        </footer>

        <div class="popup" id="contact-form">
            <div class="popup__container _container">
                <div class="popup__body">
                    <div class="popup__header">
                        <div class="popup__title title">
                            Оставьте свой номер
                        </div>
                        <div class="popup__subtitle">
                            Укажите свои контактные данные и наш менеджер свяжется с вами в течении 15 минут
                        </div>
                    </div>
                    <div class="popup__form">
                        <div class="form-group">
                            <label for="">Ваше имя</label>
                            <input id="name" name="name" type="text" class="input">
                        </div>
                        <div class="form-group">
                            <label for="phone">Ваш номер</label>
                            <input id="phone" name="phone" type="phone" class="input" placeholder = "+7(900)800-00-00">
                        </div>
                        <script>
                            $(function() {
                                $.mask.definitions['h'] = "[0|1|3|4|5|6|7|9]"
                                $("#contact-form #phone").mask('+7 (h99) 999-99-99');
                                console.log($("#auth #phone"));
                            });
                        </script>
                        <div class="form-group">
                            <label for="comment">Комментарий</label>
                            <textarea name="comment" id="comment" cols="30" rows="10" class="textarea" placeholder="Введите сообщение"></textarea>
                        </div>
                        <p class="form-addit">
                            Оставляя свои данные, вы даёте на это согласие <br>
                            и принимаете условия <a href="https://adswap.ru/privacy">Политики конфиденциальности.</a>
                        </p>
                        <button class="btn btn-primary send-data">
                            Отправить
                        </button>
                    </div>
                    <div class="close-popup">
                        <img src="{{ asset('img/close-icon.svg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="popup" id="change-password">
            <div class="popup__container _container">
                <div class="popup__body">
                    <div class="popup__header">
                        <div class="popup__title title">
                            Введите номер
                        </div>
                        <div class="popup__subtitle">
                            Отправьте нам свой номер и наш телеграм-бот пришлёт вам новый пароль, который потом можно поменять в настройках профиля
                        </div>
                    </div>
                    <div class="popup__form">
                        <div class="form-group">
                            <label for="phone">Ваш номер</label>
                            <input id="phone" name="phone" type="phone" class="input">
                        </div>
                        <script>
                            $(function() {
                                $.mask.definitions['h'] = "[0|1|3|4|5|6|7|9]"
                                $("#change-password #phone").mask('+7 (h99) 999-99-99');
                            });

                        </script>
                        <p class="form-addit">
                            Оставляя свои данные, вы даёте на это согласие <br>
                            и принимаете условия <a href="https://adswap.ru/privacy">Политики конфиденциальности.</a>
                        </p>
                        <button class="btn btn-primary send-data">
                            Отправить
                        </button>
                    </div>
                    <div class="close-popup">
                        <img src="{{ asset('img/close-icon.svg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="popup" id="confirm-completion" style="">
            <div class="popup__container _container">
                <div class="popup__body">
                    <div class="popup__header">
                        <div class="popup__title title">
                            Заполните данные
                        </div>
                        <div class="popup__subtitle">
                            Выберите оценку, не забудьте добавить комментарий, это очень важно для развития площадки и улучшения сообщества
                        </div>
                    </div>
                    <div class="popup__form">
                        <div class="form-group">
                            <label for="mark">Ваша оценка</label>
                            <div class="mark-items">
                                <div class="mark-items__star">
                                    <img src="{{ asset('/img/star-icon.svg') }}" alt="">
                                </div>
                                <div class="mark-items__star">
                                    <img src="{{ asset('/img/star-icon.svg') }}" alt="">
                                </div>
                                <div class="mark-items__star">
                                    <img src="{{ asset('/img/star-icon.svg') }}" alt="">
                                </div>
                                <div class="mark-items__star">
                                    <img src="{{ asset('/img/star-icon.svg') }}" alt="">
                                </div>
                                <div class="mark-items__star">
                                    <img src="{{ asset('/img/star-icon.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comment">Комментарий</label>
                            <textarea name="comment" id="comment" cols="30" rows="10" class="textarea" placeholder="Введите сообщение"></textarea>
                        </div>
                        <button class="btn btn-primary send-data">
                            Отправить
                        </button>
                    </div>
                    <div class="close-popup">
                        <img src="{{ asset('img/close-icon.svg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="popup" id="blogger-send-offer" style="">
            <div class="popup__container _container">
                <div class="popup__body">
                    <div class="popup__header">
                        <div class="popup__title title">
                            Заполните данные
                        </div>
                        <div class="popup__subtitle">

                        </div>
                    </div>
                    <div class="popup__form">
                        <div class="form-group">
                            <label for="message">Комментарий</label>
                            <textarea name="message" id="message" cols="30" rows="10" class="textarea" placeholder="Введите сообщение"></textarea>
                        </div>
                        <button class="btn btn-primary send-data">
                            Отправить
                        </button>
                    </div>
                    <div class="close-popup">
                        <img src="{{ asset('img/close-icon.svg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="popup" id="confirm-completion-blogger" style="">
            <div class="popup__container _container">
                <div class="popup__body">
                    <div class="popup__header">
                        <div class="popup__title title">
                            Заполните комментарий
                        </div>
                    </div>
                    <div class="popup__form">
                        <div class="form-group">
                            <label for="comment">Комментарий</label>
                            <textarea name="comment" id="comment" cols="30" rows="10" class="textarea" placeholder="Введите сообщение"></textarea>
                        </div>
                        <button class="btn btn-primary send-data">
                            Отправить
                        </button>
                    </div>
                    <div class="close-popup">
                        <img src="{{ asset('img/close-icon.svg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="popup" id="choose-projects-adv-format" style="">
            <div class="popup__container _container">
                <div class="popup__body">
                    <div class="popup__header">
                        <div class="popup__title title">
                            Выберите формат рекламы
                        </div>
                        <div class="popup__subtitle">
                            Выберите из списка нужный формат рекламы, который вы хотите предложить блогеру, после выбора формата вы вернетесь к выбору блогера
                        </div>
                    </div>
                    <div class="popup__form">
                        <div class="popup__formats">

                        </div>
                        <button class="btn btn-primary btn-confirm">
                            Выбрать
                        </button>
                    </div>
                    <div class="close-popup">
                        <img src="{{ asset('img/close-icon.svg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="popup" id="chat-img" style="">
            <div class="popup__container _container">
                <div class="popup__body" style="max-width:790px">
                    <div class="chat-img__w">
                        <img src="" alt="" class="chat-img" style="width:100%">
                    </div>
                    <div class="close-popup">
                        <img src="{{ asset('img/close-icon.svg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="popup" id="confirm-publication" style="">
            <div class="popup__container _container">
                <div class="popup__body">
                    <div class="popup__header">
                        <div class="popup__title title">
                            Подтвердите действие
                        </div>
                        <div class="popup__subtitle subtitle">
                            После публикации проект нельзя будет отредактировать
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
        <div class="popup" id="confirm-deleting" style="">
            <div class="popup__container _container">
                <div class="popup__body">
                    <div class="popup__header">
                        <div class="popup__title title">
                            Подтвердите действие
                        </div>
                        <div class="popup__subtitle subtitle">
                            После подтверждения действия проект восстановить нельзя
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
        <div class="popup" id="choose-projects-adv-format-blogger" style="">
            <div class="popup__container _container">
                <div class="popup__body">
                    <div class="popup__header">
                        <div class="popup__title title">
                            Выберите формат рекламы
                        </div>
                        <div class="popup__subtitle">
                            Выберите из списка нужный формат рекламы, который вы хотите предложить блогеру, после выбора формата вы вернетесь к выбору блогера
                        </div>
                    </div>
                    <div class="popup__form">
                        <div class="popup__formats">

                        </div>
                        <button class="btn btn-primary btn-confirm">
                            Выбрать
                        </button>
                    </div>
                    <div class="close-popup">
                        <img src="{{ asset('img/close-icon.svg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="popup popup-tariffs" id="tariff-popup" style="">
            <div class="popup__container _container">
                <div class="popup__body">
                    <div class="popup__header">
                        <div class="popup__title title">
                            Тарифы
                        </div>
                        <div class="popup__subtitle">
                            Получайте отзывы на карточки и повышайте их рейтинг. Размещайте рекламу в обмен на товары  и анализируйте результаты интеграций у блогеров — все в одном сервисе.
                        </div>
                    </div>
                    <div class="tariff__items">
                        <div class="tariff__col tariff-card">
                            <div class="tariff-card__header">
                                <div class="tariff-card__title">
                                    Индивидуальные условия
                                </div>
                                <div class="tariff-card__subtitle">
                                    Действует по договоренности
                                </div>
                            </div>
                            <div class="tariff-card__text">
                                Индивидуальный тариф позволяет клиентам свободно выбирать количество интеграций и отзывов в своем плане.
                            </div>
                            <div class="tariff-card__btns">
                                <button class="btn btn-primary btn-tariffs-callus">Подробности</button>
                            </div>
                            <div class="tariff-card__star">
                                <img src="{{ asset('img/star-icon.svg') }}" alt="">
                            </div>
                        </div>
                        <div class="tariff__col tariff-card">
                            <div class="tariff-card__header">
                                <div class="tariff-card__title">
                                    Селлер
                                </div>
                                <div class="tariff-card__subtitle">
                                    Действует 30 дней
                                </div>
                            </div>
                            <div class="tariff-card__prices">
                                <div class="tariff-card__total">
                                    4900 руб
                                </div>
                                <div class="tariff-card__single">
                                    / 490 шт
                                </div>
                            </div>
                            <div class="tariff-card__select form-group">
                                <select name="" id="" class = "select">
                                    <option value="2">Отзывы на WB, OZON - 10</option>
                                    <option value="5">Интеграции Ins - 10</option>
                                    <option value="11">Интеграции VK - 10</option>
                                    <option value="14">Интеграции Telegram - 10</option>
                                    <option value="8">Интеграции YTube - 10</option>
                                </select>
                            </div>
                            <div class="tariff-card__btns">
                                <button class="btn btn-primary btn-tariffs-payment">Оплатить</button>
                            </div>
                            <div class="tariff-card__count">
                                01
                            </div>
                        </div>
                        <div class="tariff__col tariff-card">
                            <div class="tariff-card__header">
                                <div class="tariff-card__title">
                                    Бизнес
                                </div>
                                <div class="tariff-card__subtitle">
                                    Действует 30 дней
                                </div>
                            </div>
                            <div class="tariff-card__prices">
                                <div class="tariff-card__total">
                                    13500 руб
                                </div>
                                <div class="tariff-card__single">
                                    / 490 шт
                                </div>
                            </div>
                            <div class="tariff-card__select form-group">
                                <select name="" id="" class = "select">
                                    <option value="3">Отзывы на WB, OZON - 30</option>
                                    <option value="6">Интеграции Ins - 30</option>
                                    <option value="12">Интеграции VK - 30</option>
                                    <option value="15">Интеграции Telegram - 30</option>
                                    <option value="9">Интеграции YTube - 30</option>
                                </select>
                            </div>
                            <div class="tariff-card__btns">
                                <button class="btn btn-primary btn-tariffs-payment">Оплатить</button>
                            </div>
                            <div class="tariff-card__count">
                                02
                            </div>
                        </div>
                        <div class="tariff__col tariff-card">
                            <div class="tariff-card__header">
                                <div class="tariff-card__title">
                                    Компания
                                </div>
                                <div class="tariff-card__subtitle">
                                    Действует 30 дней
                                </div>
                            </div>
                            <div class="tariff-card__prices">
                                <div class="tariff-card__total">
                                    20000 руб
                                </div>
                                <div class="tariff-card__single">
                                    / 490 шт
                                </div>
                            </div>
                            <div class="tariff-card__select form-group">
                                <select name="" id="" class = "select">
                                    <option value="4">Отзывы на WB, OZON - 50</option>
                                    <option value="7">Интеграции Ins - 50</option>
                                    <option value="13">Интеграции VK - 50</option>
                                    <option value="16">Интеграции Telegram - 50</option>
                                    <option value="10">Интеграции YTube - 50</option>
                                </select>
                            </div>
                            <div class="tariff-card__btns">
                                <button class="btn btn-primary btn-tariffs-payment">Оплатить</button>
                            </div>
                            <div class="tariff-card__count">
                                03
                            </div>
                        </div>
                    </div>
                    <div class="close-popup">
                        <img src="{{ asset('img/close-icon.svg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        @include('shared.success-message')
    </div>
</body>
<script src="{{ asset("libs/owl/owl.carousel.min.js") }}"></script>
<script src="{{ asset("js/script.js") }}"></script>
@yield('scripts')

@if(session()->has('success'))
<script>
    notify('info', {
        title: 'Внимание!'
        , message: "{{ session('success') }}"
    });

</script>
@endif
@if(session()->has('switch-tab') || request()->get('switch-tab'))
    @php($tab = request()->get('switch-tab') ?? session('switch-tab'))
    <script>
        $(window).on('load', function() {
            $(document).find('.nav-menu__link[data-content="{{ $tab }}"]').click();
            window.history.replaceState("", 'Дашборд', '{{ url()->current() }}');
        })
    </script>
@endif
@if(session()->has('show_tariffs') || (bool)request()->get('show_tariffs'))
    <script>
        var tariffsPopup = new Popup('#tariff-popup')
        tariffsPopup.openPopup();

        $('.btn-tariffs-callus').on('click', () => { tariffsPopup.closePopup() })
    </script>
@endif
</html>
