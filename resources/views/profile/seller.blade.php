@extends('layout.layout')

@section('content')
<section class="profile" id="seller">
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
                            Дашборд
                        </a>
                        <a href="#" class="nav-menu__item nav-menu__link tab blogers-list-link" data-content="profile-blogers-list">
                            Каталог блогеров
                        </a>
                        <a href="#" class="nav-menu__item nav-menu__link tab chat-link" data-content="chat">
                            Чат с блогерами
                            <div class="nav-menu__item-notifs notifs notifs-chat" style="display: none">
                                1
                            </div>
                        </a>
                    </div>
                </div>
                <div class="nav-menu__close">
                    <img src="{{asset('img/arrow-alt.svg')}}" alt="">
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
                                            <label for="product-name">Название товара</label>
                                            <input type="text" id="product-name" name="product_name" placeholder="Введите наименование товара" class="input input--product_name">
                                            @error('product_name')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="quest__step-row">
                                            <div class="form-group">
                                                <label for="project-price">Артикул товара</label>
                                                <input type="text" id="product-articul" name="product_nm" placeholder="Введите артикул" class="input input--product_price">
                                                @error('product_nm')
                                                <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group" style="flex:1 1">
                                                <label for="" style="display:unset">Цена товара</label>
                                                <div class="quantity-input">
                                                    <input type="number" class="input" value="0" name="product_price">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="quest__step-row">
                                            <div class="form-group" style="flex:1 1 auto">
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
                                                <input type="checkbox" class="checkbox" name="feedback" value="feedback" id="product-feedback">
                                                <label for="product-feedback">Отзыв на товар - Бартер</label>
                                                <div class="quantity-w" data-max="100">
                                                    <div class="quantity-minus">
                                                        <img src="{{ asset('img/minus-icon.svg') }}" alt="">
                                                    </div>
                                                    <div class="quantity-input">
                                                        <input type="number" class="input" value="0" name="feedback-quantity" id="feedback-quantity">
                                                    </div>
                                                    <div class="quantity-plus">
                                                        <img src="{{ asset('img/plus-icon.svg') }}" alt="">
                                                    </div>
                                                </div>
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
                                            <div class="input-checkbox-w">
                                                <input type="checkbox" class="checkbox" name="inst" value="inst-barter" id="product-inst">
                                                <label for="product-inst">Рекламная интеграция (Inst) - Бартер</label>
                                                <div class="quantity-w" data-max="100">
                                                    <div class="quantity-minus">
                                                        <img src="{{ asset('img/minus-icon.svg') }}" alt="">
                                                    </div>
                                                    <div class="quantity-input">
                                                        <input type="number" class="input" value="0" name="inst-quantity" id="inst-quantity">
                                                    </div>
                                                    <div class="quantity-plus">
                                                        <img src="{{ asset('img/plus-icon.svg') }}" alt="">
                                                    </div>
                                                </div>
                                                <div class="format-tooltip" data-hint="inst-barter">
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
                                                <div class="quantity-w" data-max="100">
                                                    <div class="quantity-minus">
                                                        <img src="{{ asset('img/minus-icon.svg') }}" alt="">
                                                    </div>
                                                    <div class="quantity-input">
                                                        <input type="number" class="input" value="0" name="quantity">
                                                    </div>
                                                    <div class="quantity-plus">
                                                        <img src="{{ asset('img/plus-icon.svg') }}" alt="">
                                                    </div>
                                                </div>
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
                                                <div class="quantity-w" data-max="100">
                                                    <div class="quantity-minus">
                                                        <img src="{{ asset('img/minus-icon.svg') }}" alt="">
                                                    </div>
                                                    <div class="quantity-input">
                                                        <input type="number" class="input" value="0" name="quantity">
                                                    </div>
                                                    <div class="quantity-plus">
                                                        <img src="{{ asset('img/plus-icon.svg') }}" alt="">
                                                    </div>
                                                </div>
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
                                                <div class="quantity-w" data-max="100">
                                                    <div class="quantity-minus">
                                                        <img src="{{ asset('img/minus-icon.svg') }}" alt="">
                                                    </div>
                                                    <div class="quantity-input">
                                                        <input type="number" class="input" value="0" name="quantity">
                                                    </div>
                                                    <div class="quantity-plus">
                                                        <img src="{{ asset('img/plus-icon.svg') }}" alt="">
                                                    </div>
                                                </div>
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
                                    <div class="dashboard__row dashboard__item--feedback feedback-dashboard" style="{{ !empty(auth()->user()->seller->wb_api_key) ?: 'padding: 0;' }}">
                                        @if (empty(auth()->user()->seller->wb_api_key))
                                        <div class="dashboard__placeholder" style="z-index: 9999">
                                            <div class="dashboard__placeholder-text">
                                                Введите API ключ в настройках профиля
                                            </div>
                                            <div class="dashboard__placeholder-overflow">

                                            </div>
                                        </div>
                                        @endif

                                        <div class="dashboard__col dashboard__item--sm dashboard-sm">
                                            <div class="dashboard-sm__title">
                                                Рейтинг на основе отзывов
                                            </div>

                                            @php( $wb_stats = auth()->user()->seller->getTotalFeedbacksWB() )
                                            <div class="dashboard-sm__sm" id=wrapper>
                                                <input id="wb_total" value="{{ $wb_stats['total'] }}" hidden>
                                                <input id="wb_low" value="{{ $wb_stats['low'] }}" hidden>
                                                <input id="wb_med" value="{{ $wb_stats['med'] }}" hidden>
                                                <input id="wb_hig" value="{{ $wb_stats['hig'] }}" hidden>
                                                <input id="wb_avg" value="{{ $wb_stats['avg'] }}" hidden>
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
                                                <img id="meter_needle" src="libs/meter/svg-meter-gauge-needle.svg" alt="" data-percents='{{ round($wb_stats['avg'], 2) * 20 }}'>
                                            </div>
                                            <div class="dashboard-sm__desc">
                                                {{-- У вас отличные показатели, <br> --}}
                                                Ваш средний балл по отзывам {{ round($wb_stats['avg'], 2) }}
                                                <div class="dashboard-sm__quest">
                                                    ?
                                                    <div class="dashboard-sm__desc-inner">
                                                        <p>4,2 - 4,7 — У вас отличные показатели, но можно улучшить</p>
                                                        <p>3,5 - 4,2 — У вас показатели ниже среднего, требуется улучшить отзывы</p>
                                                        <p>0 - 3,5 — Cрочно требуется работа по отзывам </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dashboard__col feedback-dashboard__fb">
                                            <div class="feedback-dashboard__fb-title">
                                                У вас {{ auth()->user()->seller->getCountUnansweredWB() }} отзывов без ответа, для улучшения оценки, требуется исправить
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
                                                        @if($wb_stats['low'] > 0)
                                                        <div class="feedback-item__stat">
                                                            <div class="feedback-item__stat-quest danger">
                                                                !
                                                            </div>
                                                            У вас {{ $wb_stats['low'] }} товар(ов) с очень низкой оценкой
                                                            <div class="feedback-item__stat-products">
                                                                <div class="" style="background-color: #fff">
                                                                    <a href="#" class="profile-projects__status">
                                                                        122333444
                                                                    </a>
                                                                    <a href="#" class="profile-projects__status">
                                                                        122333444
                                                                    </a>
                                                                    <a href="#" class="profile-projects__status">
                                                                        122333444
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        @endif
                                                        @if($wb_stats['med'] > 0)
                                                        <div class="feedback-item__stat">
                                                            <div class="feedback-item__stat-quest warning">
                                                                !
                                                            </div>
                                                            У вас {{ $wb_stats['med'] }} товаров с удовлетворительной оценкой, требуется улучшение
                                                        </div>
                                                        @endif
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
                                                            @if($wb_stats['pr_low'] > 0)
                                                            <div class="feedback-item__stat">
                                                                <div class="feedback-item__stat-quest danger">
                                                                    !
                                                                </div>
                                                                На {{ $wb_stats['pr_low'] }} товарах очень мало отзывов, требуется исправить
                                                            </div>
                                                            @endif
                                                            @if($wb_stats['pr_mid'] > 0)
                                                            <div class="feedback-item__stat">
                                                                <div class="feedback-item__stat-quest warning">
                                                                    !
                                                                </div>
                                                                У вас {{ $wb_stats['pr_mid'] }} товаров со среднем количеством отзывов, требуется улучшение
                                                            </div>
                                                            @endif
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
                                                    Переходы по интеграциям
                                                </div>
                                                <canvas class="graph" id="coverage-graph">

                                                </canvas>
                                            </div>
                                        </div>
                                        <div class="dashboard__col dashboard__item funnel-statistics">
                                            <div class="dashboard__col">
                                                <div class="dashboard__item-title">
                                                    Воронка показателей эффективности за 14 дней
                                                </div>
                                                <div class="dashboard__row">
                                                    <canvas id="funnel-graph"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="dashboard__col dashboard__item acc-statistics">
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
                                        </div> --}}
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
                                        {{-- <div class="form-group filter__item">
                                                <label for="">Страна</label>
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
                    </div>
                    <div class="profile-blogers tab-content" id="profile-blogers-list">
                        <div class="profile-blogers__body">
                            <div class="projects-list__header">
                                <div class="list-projects__title title">
                                    Список блогеров
                                </div>
                                {{-- <div class="" style="display: flex; align-items: center; gap: 15px">
                                    <p style="text-wrap:nowrap">Выберите проект:</p>
                                    <div class="form-group filter__item" style="margin-bottom: 0;">
                                        @if ($projects->isNotEmpty())
                                        <select name="send-project" id="send-project-el" class="input" style="padding: 3px 10px; margin-bottom: 0; background-color: #fff; width:100%" data-send-project-element="true">
                                            @foreach ($projects as $project)
                                            <option value="{{ $project->id }}" class="">{{ $project->product_name }}</option>
                                            @endforeach
                                        </select>
                                        @else
                                        <p style="font-size: 14px; color: rgba(0, 0, 0, 0.4)">У вас нет активных проектов, <button onclick="selectTab('create-project')" class="btn-link">создать проект</button></p>
                                        @endif
                                    </div>
                                </div> --}}
                                <div class="" style="display: flex; gap: 10px; flex-wrap: wrap;">
                                    <button class="btn btn-primary projects-list__filter-btn">Фильтры</button>
                                    <button class="btn btn-primary projects-list__choose-btn">Выберите проект</button>
                                </div>
                            </div>
                            <div class="projects-list__row projects-list__current-project current-project" style="di">
                                <div class="current-project__col">
                                    <div class="current-project__row">
                                        <div class="current-project__img">
                                            <img src="{{ asset('img/profile-icon.svg') }}" alt="">
                                        </div>
                                        <div class="current-project__title">
                                            <p class="name"><b>Тестовый проект</b></p>
                                            <p class="articul">Артикул товара: <span class="">12233312</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="current-project__format">
                                    <select name="" id="">
                                        <option value="0">Выберите формат</option>
                                        <option value="1">Отзыв на товар</option>
                                        <option value="1">Рекламная интеграция(Inst)</option>
                                    </select>
                                </div>
                                <div class="current-project__btn">
                                    <a href="" class="btn btn-secondary projects-list__choose-btn">Выбрать другой проект</a>
                                </div>
                            </div>
                            @include('blogger.list')
                        </div>
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
                                            @foreach ($platforms as $platform)
                                            <option value="{{ $platform }}">{{ $platform }}</option>
                                            @endforeach
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
                                            <input id="subs-range" name="" type="range" class="input input-range" min="{{ $blogger_platforms->min('subscriber_quantity') ?? 0 }}" max="{{ $blogger_platforms->max('subscriber_quantity') ?? 0 }}">
                                            <div class="input-range-content">
                                                <input id="subs-min" type="number" class="input input-number" value="{{ $blogger_platforms->min('subscriber_quantity') ?? 0 }}">
                                                <input id="subs-max" type="number" class="input input-number" value="{{ $blogger_platforms->max('subscriber_quantity') ?? 0 }}">
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
                                    <div class="form-group filter__item">
                                        <label for="">Город блогера</label>
                                        <select name="filter-city" id="filter-city" class="input">
                                            <option value="1" class="">Москва</option>
                                            <option value="2" class="">Ульяновск</option>
                                            <option value="3" class="">Самара</option>
                                        </select>
                                    </div>
                                    <div class="filter__btns">
                                        <button class="btn btn-primary btn-filter-send">Применить</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-chat tab-content" id="chat">
                        @include('shared.chat.index')
                    </div>
                    <div class="profile-projects tab-content" id="profile-projects-choose">
                        <div class="profile-projects__body">
                            <div class="projects-list__header">
                                <div class="list-projects__title title">
                                    Список моих проектов
                                </div>
                                <div class="" style="display: flex; gap: 10px; flex-wrap: wrap;">
                                    <button class="btn btn-primary projects-list__filter-btn">Фильтры</button>
                                </div>
                            </div>
                            @include('project.seller-list')
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
                                        {{-- <div class="form-group filter__item">
                                                <label for="">Страна</label>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@section('scripts')
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
            labels: data.prices_history.map(item => `${item.dt.split('-')[2]} Мая`)
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

    var config = {
        type: 'funnel'
        , data: {
            datasets: [{
                data: [30, 60, 90]
                , backgroundColor: [
                    "#FF6384"
                    , "#36A2EB"
                    , "#FFCE56"
                ]
                , hoverBackgroundColor: [
                    "#FF6384"
                    , "#36A2EB"
                    , "#FFCE56"
                ]
            }]
            , labels: [
                "Red"
                , "Blue"
                , "Yellow"
            ]
        }
    }
    // var funnel = document.getElementById('funnel-graph').getContext('2d');
    // console.log(funnel);
    FunnelChart('funnel-graph', {
        values: [3512, 891, 652]
        , sectionColor: ['#98CBED', '#F0C457', '#FD6567']
        , displayPercentageChange: false
        , pSectionHeightPercent: 100
        , font: '"Inter", sans-serif'
        , labelWidthPercent: 28
        , labelFontColor: '#000'
        , labels: [
            'Переходы'
            , 'ER, %'
            , 'CPM, Руб.'
        , ]
        , maxFontSize: 20
    , });

</script>
<script src="{{ asset('js/wb.js') }}"></script>
@endsection
