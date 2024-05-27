    @extends('layout.layout')

    @section('content')
    <section class="profile">
        <div class="profile__container _container">
            <div class="profile__body">
                <div class="profile__navigation nav-menu">
                    <div class="nav-menu__body">
                        <div class="nav-menu__items">
                            <a href="#" class="nav-menu__item nav-menu__link tab project-link" data-content="create-project">
                                Создать проект
                            </a>
                            <a href="#" class="nav-menu__item nav-menu__link tab projects-list-link" data-content="profile-projects">
                                Мои проекты
                            </a>
                            <a href="#" class="nav-menu__item nav-menu__link tab active dashboard-link" data-content="dashboard">
                                Статистика
                            </a>
                            <a href="#" class="nav-menu__item nav-menu__link tab blogers-list-link" data-content="profile-blogers-list">
                                Каталог блогеров
                            </a>
                            <a href="#" class="nav-menu__item nav-menu__link tab chat-link" data-content="chat">
                                Чат с блогерами
                            </a>
                        </div>
                    </div>
                </div>
                <div class="profile__content">
                    <div class="profile__content-inner">
                        <div class="profile-create-project tab-content" id="create-project">
                            <div class="create-project__body">
                                <div class="create-project__title title">
                                    Создать проект
                                </div>
                                <form class="create-project__quest quest" enctype="multipart/form-data" method="POST" action="{{ route('projects.store') }}">
                                    <div class="quest__steps">
                                        <div id="step_1" class="quest__step step current">
                                            <div class="quest__step-title">
                                                Шаг <span class="current-step">1</span>
                                                <!-- <span class="quest__step-arrow next"></span> -->
                                            </div>
                                            <div class="form-group">
                                                <label for="project-name">Название проекта</label>
                                                <input type="text" id="project-name" name="project_name" placeholder="Введите наименование проекта" class="input input--project_name">
                                                @error('project_name')
                                                <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="product-name">Название товара</label>
                                                <input type="text" id="product-name" name="product_name" placeholder="Введите наименование товара" class="input input--product_name">
                                                @error('product_name')
                                                <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="quest__step-row">
                                                <div class="form-group">
                                                    <label for="project-price">Артикул товара</label>
                                                    <input type="text" id="product-articul" placeholder="Введите артикул" class="input input--product_price">
                                                    @error('product-articul')
                                                    <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="project-price">Цена товара</label>
                                                    <input type="number" id="project-price" name="product_price" placeholder="Введите цену" class="input input--product_price">
                                                    @error('product_price')
                                                    <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="project-link">Ссылка на товар</label>
                                                    <input type="text" id="project-link" name="product_link" placeholder="Ссылка" class="input input--product_link">
                                                    @error('product_link')
                                                    <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group form-group--file create-project__files upload-files">
                                                <div class="upload-files__title">
                                                    Загрузите изображения товара
                                                </div>
                                                <div class="upload-files__body">
                                                    <div class="upload-files__plus">

                                                    </div>
                                                </div>
                                                @error('images')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="quest__btns">
                                                <button class="btn btn-primary next" type="button">
                                                    Далее
                                                </button>
                                            </div>
                                        </div>
                                        <div id="step_2" class="quest__step step">
                                            <div class="quest__step-title">
                                                Шаг <span class="current-step">2</span>
                                                <!-- <span class="quest__step-arrow send"></span> -->
                                            </div>
                                            <div class="form-group marketing-format">
                                                <label for="format">Выберите формат рекламы</label>
                                                @error('project_type')
                                                <span class="error">{{ $message }}</span>
                                                @enderror
                                                <div class="input-checkbox-w">
                                                    <input type="checkbox" class="checkbox" name="project_type" value="feedback" id="product-feedback">
                                                    <label for="product-feedback">Отзыв на товар - Бартер</label>
                                                    <div class="format-tooltip" data-hint="feedback">
                                                        ?
                                                        <div class="format-hint format-hint--text" id="feedback">
                                                            <div class="format-hint__title">
                                                                Рекламный пост
                                                            </div>
                                                            <div class="format-hint__body">
                                                                Приятно, граждане, наблюдать, как акционеры крупнейших компаний формируют глобальную экономическую сеть и при этом — объявлены нарушающими общечеловеческие нормы этики и морали
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="input-checkbox-w disabled">
                                                    <input type="checkbox" class="checkbox" id="product-inst">
                                                    <label for="product-inst">Рекламная интеграция (Inst) - Бартер</label>
                                                    <div class="format-tooltip" data-hint="inst">
                                                        ?
                                                        <div class="format-hint format-hint--text" id="inst">
                                                            <div class="format-hint__title">
                                                                Рекламная интеграция (Inst) - Бартер
                                                            </div>
                                                            <div class="format-hint__body">
                                                                ...
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="input-checkbox-w disabled">
                                                    <input type="checkbox" class="checkbox" id="product-youtube">
                                                    <label for="product-youtube">Рекламная интеграция (YouTube) - Бартер</label>
                                                    <div class="format-tooltip" data-hint="youtube">
                                                        ?
                                                        <div class="format-hint format-hint--text" id="youtube">
                                                            <div class="format-hint__title">
                                                                Рекламная интеграция (YouTube) - Бартер
                                                            </div>
                                                            <div class="format-hint__body">
                                                                ...
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="input-checkbox-w disabled">
                                                    <input type="checkbox" class="checkbox" id="product-other">
                                                    <label for="product-other">Другие площадки для интеграций - Бартер</label>
                                                    <div class="format-tooltip" data-hint="other">
                                                        ?
                                                        <div class="format-hint format-hint--text" id="other">
                                                            <div class="format-hint__title">
                                                                Другие площадки для интеграций - Бартер
                                                            </div>
                                                            <div class="format-hint__body">
                                                                ...
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="input-checkbox-w disabled">
                                                    <input type="checkbox" class="checkbox" id="product-payment">
                                                    <label for="product-payment">Платные интеграции</label>
                                                    <div class="format-tooltip" data-hint="payment">
                                                        ?
                                                        <div class="format-hint format-hint--text" id="payment">
                                                            <div class="format-hint__title">
                                                                Платные интеграции
                                                            </div>
                                                            <div class="format-hint__body">
                                                                ...
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <span class="error error-format">

                                                </span>
                                            </div>
                                            <div class="quest__btns">
                                                <button class="btn btn-secondary back" type="button">
                                                    Назад
                                                </button>
                                                <button class="btn btn-primary send" type="submit">
                                                    Сохранить
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="dashboard tab-content active" id="dashboard">
                            <div class="dashboard__body">
                                <div class="dashboard__title title">
                                    Статистика
                                </div>
                                <div class="dashboard__tabs">
                                    <div class="dashboard__tab active" data-content="wb">
                                        Wildberries
                                    </div>
                                    <div class="dashboard__tab disabled" data-content="ozon">
                                        OZON
                                    </div>
                                </div>
                                <div class="dashboard__items">
                                    <div class="dashboard__content active" id="wb">
                                        <div class="dashboard__row dashboard__item--feedback feedback-dashboard">
                                            <div class="dashboard__col dashboard__item--sm dashboard-sm">
                                                <div class="dashboard-sm__title">
                                                    Общая оценка магазина
                                                </div>
                                                <div class="dashboard-sm__sm" id=wrapper>
                                                    <svg id="meter">
                                                        <circle id="outline_curves" class="circle outline" cx="50%" cy="50%">
                                                        </circle>
                                                        <circle id="low" class="circle range" cx="50%" cy="50%" stroke="#FD6567">
                                                        </circle>
                                                        <circle id="avg" class="circle range" cx="50%" cy="50%" stroke="#F0C457">
                                                        </circle>
                                                        <circle id="high" class="circle range" cx="50%" cy="50%" stroke="#5CAD9A">
                                                        </circle>
                                                        <circle id="outline_ends" class="circle outline" cx="50%" cy="50%">
                                                        </circle>
                                                    </svg>
                                                    <div class="dashboard-sm__digits">
                                                        <div class="dashboard-sm__low">
                                                            0
                                                        </div>
                                                        <div class="dashboard-sm__high">
                                                            5
                                                        </div>
                                                    </div>
                                                    <img id="meter_needle" src="libs/meter/svg-meter-gauge-needle.svg" alt="" data-percents='95'>
                                                </div>
                                                <div class="dashboard-sm__desc">
                                                    У вас отличные показатели, <br>
                                                    ваш средний балл по отзывам 4,9
                                                    <div class="dashboard-sm__quest">
                                                        ?
                                                        <div class="dashboard-sm__desc-inner">
                                                            <p>4,2 - 4,7 — У вас отличные показатели, но можно улучшить</p>
                                                            <p>3,5 - 4,2 — У вас показатели ниже среднего, требуется улучшить отзывы</p>
                                                            <p>0 - 3,5 — У вас ужасные показатели, срочно требуется работа по отзывам </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dashboard__col feedback-dashboard__fb">
                                                <div class="feedback-dashboard__fb-title">
                                                    У вас 56 отзывов без ответа, для улучшения оценки, требуется исправить
                                                </div>
                                                <div class="feedback-dashboard__fb-items">
                                                    <div class="feedback-dashboard__fb-row feedback-item">
                                                        <div class="feedback-item__title">
                                                            Статистика оценок по товарам
                                                            <div class="feedback-item__quest">
                                                                ?
                                                                <div class="feedback-item__quest-desc">
                                                                    <p>Ваша оценка зависит от качества ваших отзывов, от количества плохих и хороших оценок, важно следить, чтобы количество плохих отзывов не становилось больше</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="feedback-item__stats">
                                                            <div class="feedback-item__stat">
                                                                <div class="feedback-item__stat-quest danger">
                                                                    !
                                                                </div>
                                                                У вас 10 товаров с очень низкой оценкой
                                                            </div>
                                                            <div class="feedback-item__stat">
                                                                <div class="feedback-item__stat-quest warning">
                                                                    !
                                                                </div>
                                                                У вас 20 товаров с удовлетворительной оценкой, требуется улучшение
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="feedback-dashboard__fb-row">
                                                        <div class="feedback-dashboard__fb-row feedback-item">
                                                            <div class="feedback-item__title">
                                                                Статистика количества отзывов на товарах
                                                                <div class="feedback-item__quest">
                                                                    ?
                                                                    <div class="feedback-item__quest-desc">
                                                                        <p>Для улучшения вашей оценки необходимо работать надо отзывами на маркетплейсах, очень важно следить за количеством отзывов и их обработкой</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="feedback-item__stats">
                                                                <div class="feedback-item__stat">
                                                                    <div class="feedback-item__stat-quest danger">
                                                                        !
                                                                    </div>
                                                                    На 20 товарах очень мало отзывов, требуется исправить
                                                                </div>
                                                                <div class="feedback-item__stat">
                                                                    <div class="feedback-item__stat-quest warning">
                                                                        !
                                                                    </div>
                                                                    У вас 15 товаров со среднем количеством отзывов, требуется улучшение
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dashboard__row">
                                            <div class="dashboard__col dashboard__item dashboard__item--cover">
                                                <div class="dashboard__item-cover">
                                                    <div class="dashboard__item-title">
                                                        Охват
                                                    </div>
                                                    <canvas class="graph" id="coverage-graph">

                                                    </canvas>
                                                </div>
                                            </div>
                                            <div class="dashboard__col dashboard__item acc-statistics">
                                                <div class="dashboard__col">
                                                    <div class="dashboard__row acc-statistics__item er-statistics">
                                                        <div class="er-statistics__body">
                                                            <div class="er-statistics__col">
                                                                <div class="acc-statistics__title">
                                                                    Engagement Rate
                                                                </div>
                                                                <div class="acc-statistics__val">
                                                                    5.41
                                                                </div>
                                                            </div>
                                                            <div class="er-statistics__col er-statistics__graph">
                                                                <canvas id="er"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="dashboard__row acc-statistics__item cpm-statistics">
                                                        <div class="cpm-statistics__body">
                                                            <div class="cpm-statistics__col">
                                                                <div class="acc-statistics__title">
                                                                    CPM
                                                                </div>
                                                                <div class="acc-statistics__val">
                                                                    ~213 ₽
                                                                </div>
                                                            </div>
                                                            <div class="cpm-statistics__col cpm-statistics__graph">
                                                                <canvas id="cpm"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dashboard__placeholder">
                                                <div class="dashboard__placeholder-text">
                                                    Раздел находится в разработке
                                                </div>
                                                <div class="dashboard__placeholder-overflow">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="dashboard__row">
                                            <div class="dashboard__col dashboard__item">
                                                <img src="img/statistics-ph.png" alt="" class="">
                                                <div class="dashboard__placeholder">
                                                    <div class="dashboard__placeholder-text">
                                                        Раздел находится в разработке
                                                    </div>
                                                    <div class="dashboard__placeholder-overflow">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dashboard__col dashboard__item">
                                                <img src="img/1_GZq1SvhxjrbQbqkag4XH3w.jpg" alt="" class="">
                                                <div class="dashboard__placeholder">
                                                    <div class="dashboard__placeholder-text">
                                                        Раздел находится в разработке
                                                    </div>
                                                    <div class="dashboard__placeholder-overflow">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dashboard__content" id="ozon">
                                        <div class="dashboard__row">
                                            <div class="dashboard__col dashboard__item dashboard__item--cover">
                                                <div class="dashboard__item-cover">
                                                    <div class="dashboard__item-title">
                                                        Охват
                                                    </div>
                                                    <canvas class="graph" id="coverage-graph">

                                                    </canvas>
                                                </div>
                                            </div>
                                            <div class="dashboard__col dashboard__item acc-statistics">
                                                <div class="dashboard__col">
                                                    <div class="dashboard__row acc-statistics__item er-statistics">
                                                        <div class="er-statistics__body">
                                                            <div class="er-statistics__col">
                                                                <div class="acc-statistics__title">
                                                                    Engagement Rate
                                                                </div>
                                                                <div class="acc-statistics__val">
                                                                    5.41
                                                                </div>
                                                            </div>
                                                            <div class="er-statistics__col er-statistics__graph">
                                                                <canvas id="er"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="dashboard__row acc-statistics__item cpm-statistics">
                                                        <div class="cpm-statistics__body">
                                                            <div class="cpm-statistics__col">
                                                                <div class="acc-statistics__title">
                                                                    CPM
                                                                </div>
                                                                <div class="acc-statistics__val">
                                                                    ~213 ₽
                                                                </div>
                                                            </div>
                                                            <div class="cpm-statistics__col cpm-statistics__graph">
                                                                <canvas id="cpm"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="dashboard__row">
                                            <div class="dashboard__col dashboard__item">
                                                <img src="img/statistics-ph.png" alt="" class="">
                                                <div class="dashboard__placeholder">
                                                    <div class="dashboard__placeholder-text">
                                                        Введите свой API ключ для получения статистики
                                                    </div>
                                                    <button class="btn btn-primary btn-input-wb-api">Ввести ключ</button>
                                                    <div class="dashboard__placeholder-overflow">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dashboard__col dashboard__item acc-statistics">
                                                <div class="dashboard__col projects-statistics">
                                                    <div class="projects-statistics__body">
                                                        <div class="projects-statistics__col">
                                                            <div class="acc-statistics__title">
                                                                Интеграции выполнено
                                                            </div>
                                                        </div>
                                                        <div class="projects-statistics__col">
                                                            <div class="projects-statistics__graph">
                                                                <canvas id="projects"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dashboard__row">
                                            <div class="dashboard__col dashboard__item">
                                                <img src="img/no-image.png" alt="" class="">
                                                <div class="dashboard__placeholder">
                                                    <div class="dashboard__placeholder-text">
                                                        Раздел находится в разработке
                                                    </div>
                                                    <div class="dashboard__placeholder-overflow">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dashboard__col dashboard__item">
                                                <img src="img/no-image.png" alt="" class="">
                                                <div class="dashboard__placeholder">
                                                    <div class="dashboard__placeholder-text">
                                                        Раздел находится в разработке
                                                    </div>
                                                    <div class="dashboard__placeholder-overflow">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-projects tab-content" id="profile-projects">
                            <div class="profile-projects__body">
                                <div class="projects-list__header">
                                    <div class="list-projects__title title">
                                        Список моих проектов
                                    </div>
                                    <div class="" style="display: flex; gap: 10px; flex-wrap: wrap;">
                                        <button class="btn btn-primary projects-list__filter-btn">Фильтры</button>
                                    </div>
                                </div>
                                @include('project.index')
                            </div>
                            <div class="profile-projects__filters">
                                <div class="projects-list__filter filter">
                                    <div class="filter__body">
                                        <div class="filter__top">
                                            <p class="filter__title">
                                                Фильтр
                                            </p>
                                            <a href="#" class="filter__reset">
                                                Сбросить
                                            </a>
                                        </div>
                                        <div class="filter__items">
                                            <div class="form-group filter__item">
                                                <input type="text" class="input" name="filter-name" id="filter-name" placeholder="Поиск по названию">
                                            </div>
                                            <div class="form-group filter__item">
                                                <label for="">Формат рекламы</label>
                                                <select name="project_type" id="filter-format" class="input">
                                                    <option value="feedback" class="">Отзыв на товар</option>
                                                    <option value="2" class="">Рекламная интеграция(Instagram)</option>
                                                    <option value="3" class="">Рекламная интеграция(Youtube)</option>
                                                    <option value="4" class="">Другие площадки для интеграций</option>
                                                    <option value="5" class="">Платные интеграции</option>
                                                </select>
                                            </div>
                                            <div class="form-group filter__item">
                                                <label for="">Страна</label>
                                                <select name="filter-country" id="filter-country" class="input">
                                                    <option value="1" class="">Россия</option>
                                                    <option value="2" class="">Казахстан</option>
                                                    <option value="3" class="">Грузия</option>
                                                </select>
                                            </div>

                                            <div class="filter__btns">
                                                <button class="btn btn-primary btn-filter-send">Применить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-blogers tab-content" id="profile-blogers-list">
                            <div class="profile-blogers__body">
                                <div class="projects-list__header">
                                    <div class="list-projects__title title">
                                        Список блогеров
                                    </div>
                                    <div class="" style="display: flex; gap: 10px; flex-wrap: wrap;">
                                        <button class="btn btn-primary projects-list__filter-btn">Фильтры</button>
                                    </div>
                                </div>
                                @include('blogger.list')
                            </div>
                            <div class="blogers-list__filter filter">
                                <div class="filter__body">
                                    <div class="filter__top">
                                        <p class="filter__title">
                                            Фильтр
                                        </p>
                                        <a href="#" class="filter__reset">
                                            Сбросить
                                        </a>
                                    </div>
                                    <div class="filter__items">
                                        <div class="form-group filter__item">
                                            <input type="text" class="input" name="filter-name" id="filter-name" placeholder="Поиск по названию">
                                        </div>
                                        {{-- <div class="form-group filter__item">
                                            <label for="">Категория</label>
                                            <select name="filter-cat" id="filter-cat" class="input">
                                                <option value="1" class="">IT Сфера</option>
                                                <option value="2" class="">Образование</option>
                                                <option value="3" class="">Отдых</option>
                                                <option value="3" class="">Полезное</option>
                                            </select>
                                        </div> --}}
                                        <div class="form-group filter__item">
                                            <label for="">Платформа</label>
                                            <select name="filter-platform" id="filter-platform" class="input">
                                                <option value="Youtube" class="">Youtube</option>
                                                <option value="Telegram" class="">Telegram</option>
                                                <option value="Instagram" class="">Instagram</option>
                                            </select>
                                        </div>
                                        {{-- <div class="form-group filter__item">
                                            <label for="">Пол блогера</label>
                                            <div class="filter__item--sex">
                                                <div class="input-checkbox-w">
                                                    <input type="checkbox" class="checkbox" id="male">
                                                    <label for="male">Мужской</label>
                                                </div>
                                                <div class="input-checkbox-w">
                                                    <input type="checkbox" class="checkbox" id="female">
                                                    <label for="femail">Женский</label>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="form-group filter__item">
                                            <label for="">Количество подписчиков</label>
                                            <div class="input-range-w">
                                                <input id="subs-range" name="" type="range" class="input input-range" min="5" max="1200000">
                                                <div class="input-range-content">
                                                    <input id="subs-min" type="number" class="input input-number" value="5">
                                                    <input id="subs-max" type="number" class="input input-number" value="1200000">
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="form-group filter__item">
                                            <label for="">Страна блогера</label>
                                            <select name="filter-country" id="filter-country" class="input">
                                                <option value="1" class="">Россия</option>
                                                <option value="2" class="">Казахстан</option>
                                                <option value="3" class="">Грузия</option>
                                            </select>
                                        </div> --}}

                                        <div class="filter__btns">
                                            <button class="btn btn-primary btn-filter-send">Применить</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-chat tab-content" id="chat">
                            <div class="profile-chat__body">
                                <div class="profile-projects__title title">
                                    Переписка с блогерами
                                </div>
                                <div class="profile-tabs__content-item">
                                    <div class="tab-content__chat chat">
                                        @include('shared.chat.index')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection


    @section('scripts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    <script src="{{ asset("libs/meter/script.js") }}"></script>
    <script>
        var mediaQuery = window.matchMedia('(max-width: 911px)');

        var coverageGraph;

        if (mediaQuery.matches) {
            coverageGraph = document.getElementById('coverage-graph');
            erGraph = document.getElementById('er');
            cpmGraph = document.getElementById('cpm');
            pGraph = document.getElementById('projects');
        } else {
            coverageGraph = document.getElementById('coverage-graph');
            erGraph = document.getElementById('er');
            cpmGraph = document.getElementById('cpm');
            pGraph = document.getElementById('projects');
        }

        var data = {
            "orders": 2637
            , "earnings": 4750732.0
            , "sale_percent": 0.0
            , "fromDate": "2021-04-03"
            , "prices_history": [{
                    "dt": "2024-04-18"
                    , "price": 1684.0
                }
                , {
                    "dt": "2024-04-19"
                    , "price": 1725.0
                }
                , {
                    "dt": "2024-04-20"
                    , "price": 1725.0
                }
                , {
                    "dt": "2024-04-21"
                    , "price": 1725.0
                }
                , {
                    "dt": "2024-04-22"
                    , "price": 1704.0
                }
                , {
                    "dt": "2024-04-23"
                    , "price": 1776.0
                }
                , {
                    "dt": "2024-04-24"
                    , "price": 1848.0
                }
                , {
                    "dt": "2024-04-25"
                    , "price": 1725.0
                }
                , {
                    "dt": "2024-04-26"
                    , "price": 1949.0
                }
                , {
                    "dt": "2024-04-27"
                    , "price": 1949.0
                }
                , {
                    "dt": "2024-04-28"
                    , "price": 1949.0
                }
                , {
                    "dt": "2024-04-29"
                    , "price": 1949.0
                }
                , {
                    "dt": "2024-04-30"
                    , "price": 1949.0
                }
                , {
                    "dt": "2024-05-01"
                    , "price": 1949.0
                }
            , ]
        , }


        new Chart(coverageGraph, {
            type: 'bar'
            , data: {
                labels: data.prices_history.map(item => item.dt.split('-')[2])
                , datasets: [{
                    label: 'Охваты'
                    , data: data.prices_history.map(item => item.price)
                , }]
            }
            , options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        var labels = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        var data = {
            labels: labels
            , datasets: [{
                label: 'ER'
                , data: [10, 32, 45, 9, 55, 89, 123, 15, 102, 11, 15, 245]
                , borderColor: '#FE5E00'
                , backgroundColor: '#FAF5EF'
            , }, ]
        };

        new Chart(erGraph, {
            type: 'line'
            , data: data
            , options: {
                responsive: true
                , plugins: {
                    legend: {
                        position: 'top'
                    , }
                , }
            }
        , });


        var labels = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        var data = {
            labels: labels
            , datasets: [{
                label: 'CPM'
                , data: [144, 12, 555, 9, 55, 123, 123, 15, 102, 11, 51, 245]
                , borderColor: '#FE5E00'
                , backgroundColor: '#FAF5EF'
            , }, ]
        };

        new Chart(cpmGraph, {
            type: 'line'
            , data: data
            , options: {
                responsive: true
                , plugins: {
                    legend: {
                        position: 'top'
                    , }
                , }
            }
        , });

        var data = {
            labels: ['Всего', 'Выполнено']
            , datasets: [{
                label: 'Интеграции'
                , data: [126, 120]
                , backgroundColor: ['#98CBED', '#FE5E00']
            , }]
        };

        new Chart(pGraph, {
            type: 'pie'
            , data: data
            , options: {
                responsive: true
                , plugins: {
                    legend: {
                        position: 'top'
                    , }
                , }
            }
        , });

    </script>
    <script>
        var mediaQuery = window.matchMedia('(max-width: 911px)');

        var prices_ctx, orders_ctx;

        if (mediaQuery.matches) {
            prices_ctx = document.getElementById('prices-graph-mobile');
            orders_ctx = document.getElementById('orders-graph-mobile');
        } else {
            prices_ctx = document.getElementById('prices-graph-desktop');
            orders_ctx = document.getElementById('orders-graph-desktop');
        }


        // $.ajax({
        //     url: 'https://anabar.ai/api/chrome/v1/product/wb/25633521',
        //     data:{},
        //     method: 'GET',
        //     success: (data)=>{
        //         console.log(data);
        //     }
        // })
        var data = {
            "orders": 2637
            , "earnings": 4750732.0
            , "sale_percent": 0.0
            , "fromDate": "2021-04-03"
            , "prices_history": [{
                    "dt": "2024-04-10"
                    , "price": 1603.0
                }
                , {
                    "dt": "2024-04-11"
                    , "price": 1603.0
                }
                , {
                    "dt": "2024-04-12"
                    , "price": 1603.0
                }
                , {
                    "dt": "2024-04-13"
                    , "price": 1603.0
                }
                , {
                    "dt": "2024-04-14"
                    , "price": 1603.0
                }
                , {
                    "dt": "2024-04-15"
                    , "price": 1603.0
                }
                , {
                    "dt": "2024-04-16"
                    , "price": 1684.0
                }
                , {
                    "dt": "2024-04-17"
                    , "price": 1684.0
                }
                , {
                    "dt": "2024-04-18"
                    , "price": 1684.0
                }
                , {
                    "dt": "2024-04-19"
                    , "price": 1725.0
                }
                , {
                    "dt": "2024-04-20"
                    , "price": 1725.0
                }
                , {
                    "dt": "2024-04-21"
                    , "price": 1725.0
                }
                , {
                    "dt": "2024-04-22"
                    , "price": 1704.0
                }
                , {
                    "dt": "2024-04-23"
                    , "price": 1776.0
                }
                , {
                    "dt": "2024-04-24"
                    , "price": 1848.0
                }
                , {
                    "dt": "2024-04-25"
                    , "price": 1725.0
                }
                , {
                    "dt": "2024-04-26"
                    , "price": 1949.0
                }
                , {
                    "dt": "2024-04-27"
                    , "price": 1949.0
                }
                , {
                    "dt": "2024-04-28"
                    , "price": 1949.0
                }
                , {
                    "dt": "2024-04-29"
                    , "price": 1949.0
                }
                , {
                    "dt": "2024-04-30"
                    , "price": 1949.0
                }
                , {
                    "dt": "2024-05-01"
                    , "price": 1949.0
                }
                , {
                    "dt": "2024-05-02"
                    , "price": 1949.0
                }
                , {
                    "dt": "2024-05-03"
                    , "price": 1949.0
                }
                , {
                    "dt": "2024-05-04"
                    , "price": 1925.0
                }
                , {
                    "dt": "2024-05-05"
                    , "price": 1925.0
                }
                , {
                    "dt": "2024-05-06"
                    , "price": 1925.0
                }
                , {
                    "dt": "2024-05-07"
                    , "price": 1925.0
                }
                , {
                    "dt": "2024-05-08"
                    , "price": 1925.0
                }
                , {
                    "dt": "2024-05-09"
                    , "price": 1925.0
                }
            ]
            , "orders_history": [{
                    "dt": "2024-04-10"
                    , "orders": 64.0
                }
                , {
                    "dt": "2024-04-11"
                    , "orders": 70.0
                }
                , {
                    "dt": "2024-04-12"
                    , "orders": 61.0
                }
                , {
                    "dt": "2024-04-13"
                    , "orders": 62.0
                }
                , {
                    "dt": "2024-04-14"
                    , "orders": 69.0
                }
                , {
                    "dt": "2024-04-15"
                    , "orders": 66.0
                }
                , {
                    "dt": "2024-04-16"
                    , "orders": 105.0
                }
                , {
                    "dt": "2024-04-17"
                    , "orders": 105.0
                }
                , {
                    "dt": "2024-04-18"
                    , "orders": 106.0
                }
                , {
                    "dt": "2024-04-19"
                    , "orders": 105.0
                }
                , {
                    "dt": "2024-04-20"
                    , "orders": 101.0
                }
                , {
                    "dt": "2024-04-21"
                    , "orders": 133.0
                }
                , {
                    "dt": "2024-04-22"
                    , "orders": 118.0
                }
                , {
                    "dt": "2024-04-23"
                    , "orders": 129.0
                }
                , {
                    "dt": "2024-04-24"
                    , "orders": 118.0
                }
                , {
                    "dt": "2024-04-25"
                    , "orders": 83.0
                }
                , {
                    "dt": "2024-04-26"
                    , "orders": 74.0
                }
                , {
                    "dt": "2024-04-27"
                    , "orders": 78.0
                }
                , {
                    "dt": "2024-04-28"
                    , "orders": 68.0
                }
                , {
                    "dt": "2024-04-29"
                    , "orders": 111.0
                }
                , {
                    "dt": "2024-04-30"
                    , "orders": 102.0
                }
                , {
                    "dt": "2024-05-01"
                    , "orders": 100.0
                }
                , {
                    "dt": "2024-05-02"
                    , "orders": 58.0
                }
                , {
                    "dt": "2024-05-03"
                    , "orders": 62.0
                }
                , {
                    "dt": "2024-05-04"
                    , "orders": 74.0
                }
                , {
                    "dt": "2024-05-05"
                    , "orders": 89.0
                }
                , {
                    "dt": "2024-05-06"
                    , "orders": 99.0
                }
                , {
                    "dt": "2024-05-07"
                    , "orders": 109.0
                }
                , {
                    "dt": "2024-05-08"
                    , "orders": 64.0
                }
                , {
                    "dt": "2024-05-09"
                    , "orders": 54.0
                }
            ]
        }

        var orders = data.orders_history.map(item => item.orders);
        var prices = data.prices_history.map(item => item.price);
        var date = data.prices_history.map(item => item.dt.split('-')[2]);

        console.log(orders, prices, date);

        new Chart(orders_ctx, {
            type: 'bar'
            , data: {
                labels: data.prices_history.map(item => item.dt.split('-')[2])
                , datasets: [{
                    label: 'Заказы'
                    , data: data.orders_history.map(item => item.orders)
                , }]
            }
            , options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        new Chart(prices_ctx, {
            type: 'bar'
            , data: {
                labels: data.prices_history.map(item => item.dt.split('-')[2])
                , datasets: [{
                    label: 'Выручка'
                    , data: data.prices_history.map(item => item.price)
                , }]
            }
            , options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    </script>
    @endsection
