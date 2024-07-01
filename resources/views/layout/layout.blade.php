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

    <script src="{{ asset('libs/jquery/jquery-3.7.1.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('libs/jquery/jquery.maskedinput.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('libs/owl/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/owl/owl.theme.default.css') }}">

    <link rel="stylesheet" href="{{ asset('libs/meter/style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loader.css') }}">

    <script src="{{ asset('libs/chart/chart.js') }}"></script>
    <script src="{{ asset('libs/funnel/funnel-chart.js') }}"></script>

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
                        </a>
                    </div>
                    @if ( auth()->user()->role == 'seller')
                    <div href="#" class="header__col header__tarrif tarrif-header header__profile-item--js">
                        {{-- Ваш тариф — {{ auth()->user()->seller->tariff }} --}}
                        Ваш тариф — Тестовый
                        <div class="tarrif-header__items">
                            <div class="tarrif-header__item tarrif-header__adv">
                                Отзыв - <b><span class="counter">{{ auth()->user()->seller->remaining_tariff }}</span> шт.</b>
                                <div class="tarrif-header__date">
                                    Действует до {{ date("d.m.Y", strtotime(auth()->user()->created_at . "+7 days",)) }}
                                </div>
                                <a href="{{ route('tariff') }}" class="tarrif-header__buy">Продлить</a>
                            </div>
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
                    <a href="#" class="nav-burger__link nav__link">Инструкции</a>
                </div>
                <a href="#" class="burger-menu__close">
                    <img src="{{ asset('img/close-icon.svg') }}" alt="">
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
                            <a href="" class="nav__link disabled">
                                Инструкции
                            </a>
                        </div>
                    </nav>


                    <div class=" header__profile-items header__profile-items--desktop header__row">
                        @if ( auth()->user()->role == 'seller')
                        <div href="#" class="header__col header__tarrif tarrif-header header__profile-item--js">
                            Ваш тариф — Тестовый
                            <div class="tarrif-header__items">
                                <div class="tarrif-header__item tarrif-header__adv">
                                    Отзыв - <b><span class="counter">{{ auth()->user()->seller->remaining_tariff }}</span> шт.</b>
                                    <div class="tarrif-header__date">
                                        Действует до {{ date("d.m.Y", strtotime(auth()->user()->created_at . "+7 days",)) }}
                                    </div>
                                    <a href="{{ route('tariff') }}" class="tarrif-header__buy">Продлить</a>
                                </div>
                            </div>
                        </div>
                        @endif
                        <a href="#" class="header__col header__notif header__profile-item--js" title="Уведомления">
                            <div class="header__profile-notif" id="header-notif-count" style="display: none">

                            </div>
                            <img src="{{ asset('img/notif-icon.svg') }}" alt="" class="">
                            <div class="header__notif-items notif-header">
                                <div class="notif-header__items" id="header-notif-container">
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
                    <a href="{{ route('policy') }}" class="footer__policy">
                        Политика конфиденциальности  {{ auth()->user()->status }}
                    </a>
                    <a href="#" class="footer__policy">
                        Публичная оферта
                    </a>
                    <a href="#" class="footer__policy">
                        hello@tla-agency.ru
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
                            <input id="phone" name="phone" type="phone" class="input">
                        </div>
                        <script>
                            $(function() {
                                $.mask.definitions['h'] = "[0|1|3|4|5|6|7|9]"
                                $("#contact-form #phone").mask('+7 (h99) 999-99-99');
                            });

                        </script>
                        <p class="form-addit">
                            Оставляя свои данные, вы даёте на это согласие <br>
                            и принимаете условия <a href="policy">Политики конфиденциальности.</a>
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
                            и принимаете условия <a href="policy">Политики конфиденциальности.</a>
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
        <div class="popup" id="send-statistics-blogger" style="">
            <div class="popup__container _container">
                <div class="popup__body">
                    <div class="popup__header">
                        <div class="popup__title title">
                            Заполните статистику
                        </div>
                        <div class="popup__subtitle">
                            После того, как вы прикрепите статистику по интеграции, проект будет завершен
                        </div>
                    </div>
                    <div class="popup__form">
                        <div class="form-group">
                            <label for="views">Просмотры</label>
                            <input id="views" name="views" type="views" class="input">
                        </div>
                        <div class="form-group">
                            <label for="likes">Лайки</label>
                            <input id="likes" name="likes" type="likes" class="input">
                        </div>
                        <div class="form-group">
                            <label for="reposts">Репосты</label>
                            <input id="reposts" name="reposts" type="reposts" class="input">
                        </div>
                        <div class="form-group">
                            <label for="platform">Площадки</label>
                            <select id="platform" name="platform" class="input">
                                <option value="">Не выбрано</option>
                                <option value="Youtube">Youtube</option>
                                <option value="Instagram">Instagram</option>
                                <option value="Telegram">Telegram</option>
                                <option value="VK">Vkontakte</option>
                            </select>
                        </div>
                        <div class="input-file input-file--stat tab-content__profile-img-upload" style="padding-left:0; margin-bottom:20px;">
                            <label for="statistics-file">Прикрепить отчет по статитстике</label>
                            <input id="statistics-file" type="file" multiple hidden>
                            <script>
                                $(window).on('load', function(){
                                    $('#send-statistics-blogger #statistics-file').on('change', function(e){
                                        $(e.target).closest('.tab-content__profile-img-upload').addClass('uploaded');
                                        $(e.target).closest('.tab-content__profile-img-upload').find('label').text('Изображение загружено');
                                    })
                                })
                            </script>
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
</html>
