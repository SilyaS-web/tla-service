<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Unbounded:wght@200..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

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
                                    <button class="btn btn-primary moderation-search-btn" >Найти</button>
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
                    <div class="form-group">
                        <label for="subs">Количество подписчиков</label>
                        <input id="subs" name="subs" type="text" class="input">
                    </div>
                    <div class="form-group">
                        <label for="views">Количество просмотров</label>
                        <input id="views" name="views" type="text" class="input">
                    </div>
                    <div class="form-group">
                        <label for="quality">Engagement rate</label>
                        <input id="quality" name="quality" type="text" class="input">
                    </div>
                    <div class="form-group">
                        <label for="cpv">CPM</label>
                        <input id="cpv" name="cpv" type="text" class="input">
                    </div>
                    <div class="form-row" style="display: flex; gap:10px;">
                        <div class="form-group">
                            <label for="male">Мужчины, %</label>
                            <input id="male" name="male" type="text" class="input">
                        </div>
                        <div class="form-group">
                            <label for="female">Женщины, %</label>
                            <input id="female" name="female" type="text" class="input">
                        </div>
                    </div>
                    <div class="form-group filter__item">
                        <label for="">Пол блогера</label>
                        <div class="filter__item--sex">
                            <div class="input-checkbox-w">
                                <input type="checkbox" class = "checkbox" id = "male">
                                <label for="male">Мужской</label>
                            </div>
                            <div class="input-checkbox-w">
                                <input type="checkbox" class = "checkbox" id = "female">
                                <label for="femail">Женский</label>
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
