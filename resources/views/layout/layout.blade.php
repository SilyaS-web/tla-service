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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>

    <link rel="stylesheet" href="{{ asset('libs/owl/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/owl/owl.theme.default.css') }}">

    <link rel="stylesheet" href="{{ asset('libs/meter/style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>Профиль</title>
</head>
<body>
    <div class="wrapper" style="background-color: #fff;">
        @auth
        <div class="burger-menu">
            <div class="burger-menu__body">
                <div class="header__col header__profile-items">
                    <div class="header__row">
                        <div href="#" class="header__profile-w header__profile-header header__profile-item--js">
                            <img src="img/profile-icon.svg" alt="" class="header__profile">
                            <div class="header__profile-col">
                                <span class="header__profile-name">
                                    {{ auth()->user()->name }}
                                </span>
                                <span class="header__profile-org">
                                    @if ( auth()->user()->role == 'seller')
                                        {{ auth()->user()->seller->organization_type }}
                                    @elseif (auth()->user()->blogger)
                                        {{ auth()->user()->blogger->name }}
                                    @endif
                                </span>
                            </div>
                            <div class="header__profile-settings">
                                <a href="#" class="row">
                                    Личные данные
                                </a>
                                <a href="#" class="row">
                                    Тарифы
                                </a>
                                <a href="#" class="row">
                                    Выход
                                </a>
                            </div>
                        </div>
                        <a href="#" class="header__col header__notif header__profile-item--js" title="Уведомления">
                            <div class="header__profile-notif">
                                1
                            </div>
                            <img src="img/notif-icon.svg" alt="" class="">
                            <div class="header__notif-items notif-header">
                                <div class="notif-header__items">
                                    <div class="notif-header__row ">
                                        <div class="notif-header__col notif-header__img">
                                            <img src="img/profile-icon.svg" alt="">
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
                        </a>
                    </div>
                    @if ( auth()->user()->role == 'seller')
                        <div href="#" class="header__col header__tarrif tarrif-header header__profile-item--js" >
                            Ваш тариф — {{ auth()->user()->seller->tariff }}
                            <div class="tarrif-header__items">
                                <div class="tarrif-header__item tarrif-header__adv">
                                    Рекламные посты <b><span class = "counter">{{ auth()->user()->seller->remaining_tariff }}</span> шт.</b>
                                    <div class="tarrif-header__date">
                                        До 2 Июня
                                    </div>
                                    <a href="{{ route('tariff') }}" class="tarrif-header__buy">Продлить</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="burger-menu__nav nav-burger">
                    <a href="{{ route('profile') }}" class="nav-burger__link nav__link">Дашборд</a>
                    <a href="#" class="nav-burger__link nav__link">База знаний</a>
                    <a href="#" class="nav-burger__link nav__link">Инструкции</a>
                    <a href="#" class="nav-burger__link nav__link">Кейсы</a>
                </div>
                <a href="#" class="burger-menu__close">
                    <img src="img/close-icon.svg" alt="">
                </a>

                <div class="burger-contacts">
                    <div class="footer__contacts-contacts">
                        <div class="footer__contacts-phone">
                            hello@tla-agency.ru
                        </div>
                        <div class="footer__contacts-phone">
                            +7(999)194-44-47
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endauth
        <header class="header">
            <div class="header__container _container">
                <div class="header__body">
                    <div class="logo header__logo-w">
                        <img src="{{ asset('img/logo.svg') }}" alt="" class="logo__logo header__logo">
                    </div>
                    @auth
                    <nav class="nav header__nav">
                        <div class="nav__items">
                            <a href="{{ route('profile') }}" class="nav__link">
                                Дашборд
                            </a>
                            <a href="" class="nav__link disabled">
                                База знаний
                            </a>
                            <a href="" class="nav__link disabled">
                                Инструкции
                            </a>
                            <a href="" class="nav__link disabled">
                                Кейсы
                            </a>
                        </div>
                    </nav>


                    <div class=" header__profile-items header__profile-items--desktop header__row">
                        @if ( auth()->user()->role == 'seller')
                        <div href="#" class="header__col header__tarrif tarrif-header header__profile-item--js">
                            Ваш тариф — {{ auth()->user()->seller->tariff }}
                            <div class="tarrif-header__items">
                                <div class="tarrif-header__item tarrif-header__adv">
                                    Рекламные посты <b><span class="counter">{{ auth()->user()->seller->remaining_tariff }}</span> шт.</b>
                                    <div class="tarrif-header__date">
                                        {{-- 02 Мая — 02 Июня --}}
                                    </div>
                                    <a href="{{ route('tariff') }}" class="tarrif-header__buy">Продлить</a>
                                </div>
                            </div>
                        </div>
                        @endif
                        <a href="#" class="header__col header__notif header__profile-item--js" title="Уведомления">
                            <div class="header__profile-notif">
                                1
                            </div>
                            <img src="img/notif-icon.svg" alt="" class="">
                            <div class="header__notif-items notif-header">
                                <div class="notif-header__items">
                                    <div class="notif-header__row ">
                                        <div class="notif-header__col notif-header__img">
                                            <img src="img/profile-icon.svg" alt="">
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
                        </a>
                        <div href="#" class="header__profile-w header__profile-header header__profile-item--js">
                            <img src="img/profile-icon.svg" alt="" class="header__profile">
                            <div class="header__profile-col">
                                <span class="header__profile-name">
                                    {{ auth()->user()->name }}
                                </span>
                                <span class="header__profile-org">
                                    @if ( auth()->user()->role == 'seller')
                                        {{ auth()->user()->seller->organization_type }}
                                    @elseif (auth()->user()->blogger)
                                        {{ auth()->user()->blogger->name }}
                                    @endif
                                </span>
                            </div>
                            <div class="header__profile-settings">
                                <a href="#" class="row">
                                    Личные данные
                                </a>
                                @if ( auth()->user()->role == 'seller')
                                    <a href="#" class="row">
                                        Тарифы
                                    </a>
                                @endif
                                <form action="{{ route('logout') }}" method="POST" class="row">
                                    @csrf
                                    <button type="submit">Выход</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="header__menu burger">
                        <img src="img/menu-icon.svg" alt="">
                    </a>
                    @endauth
                </div>
            </div>
        </header>
        @yield('content')

        <footer class="footer">
            <div class="footer__container _container">
                <div class="footer__body">
                    <div class="footer__top">
                        <div class="logo footer__logo-w">
                            <img src="img/logo.svg" alt="" class="logo__logo footer__logo">
                        </div>
                        <nav class="nav footer__nav">
                            <div class="nav__items">

                            </div>
                        </nav>
                        <a href="#" class="btn btn-primary footer__contact-us">
                            Свяжитесь с нами
                        </a>
                    </div>
                    <div class="footer__bottom">
                        <div class="footer__addits">
                            <a href="{{ route('policy') }}" class="footer__policy">
                                Политика конфиденциальности
                            </a>
                            <p class="footer__copyright">
                                ©️ Все права защищены
                            </p>
                        </div>
                        <div class="footer__contacts">
                            <div class="footer__contacts-contacts">
                                <div class="footer__contacts-phone">
                                    +7(999)194-44-47
                                </div>
                                <div class="footer__contacts-phone">
                                    hello@tla-agency.ru
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        @include('shared.success-message')
    </div>
</body>
<script src="{{ asset("libs/owl/owl.carousel.min.js") }}"></script>
<script src="{{ asset("js/script.js") }}"></script>
@yield('scripts')

</html>
