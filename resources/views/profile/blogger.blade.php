@extends('layout.layout')

@section('content')
<section class="profile" id="blogger">
    <div class="profile__container _container">
        <div class="profile__body">
            <div class="profile__navigation nav-menu">
                <div class="nav-menu__body">
                    <div class="nav-menu__items">
                        <a href="#" class="nav-menu__item nav-menu__link tab projects-work-link active" data-content = "my-projects">
                            Проекты в работе
                        </a>
                        <a href="#" class="nav-menu__item nav-menu__link tab projects-list-link" data-content = "profile-projects">
                            Все проекты
                        </a>
                        <a href="#" class="nav-menu__item nav-menu__link tab projects-avail-link" data-content = "avail-projects">
                            Заявки от селлеров
                        </a>
                        <a href="#" class="nav-menu__item nav-menu__link tab chat-link" data-content = "chat">
                            Чат с селлерами
                        </a>
                    </div>
                </div>
                <div class="nav-menu__close">
                    <img src="{{asset('img/arrow-alt.svg')}}" alt="">
                </div>
            </div>
            <div class="profile__content">
                <div class="profile__content-inner">
                    <div class="profile-projects tab-content active" id = "my-projects">
                        <div class="profile-projects__body">
                            <div class="projects-list__header">
                                <div class="list-projects__title title">
                                    Принятые проекты
                                </div>
                                <div class="" style="display: flex; gap: 10px; flex-wrap: wrap;">
                                    <button class="btn btn-primary projects-list__filter-btn">Фильтры</button>
                                </div>
                            </div>
                            <div class="list-projects__items">
                                @include('project.blogger-list', ['project_works' => $active_project_works, 'type' => 'active'])
                            </div>
                        </div>
                        <div class="profile-projects__filters">
                            <div class="projects-list__filter filter">
                                <div class="filter__body">
                                    <div class="filter__top">
                                        <p class = "filter__title">
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
                                            <label for="filter-category">Категория</label>
                                            <input type="text" class="input" name="filter-category" id="filter-category" placeholder="Введите категорию">
                                            <input type="text" id = "filter-category-id" hidden>
                                            <div class="filter-tooltip" style="display: none">
                                                <div class="filter-tooltip__items">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group filter__item">
                                            <label for="">Формат рекламы</label>
                                            <select name="filter-format" id="filter-format" class = "input">
                                                <option value="" class="">Не выбран</option>
                                                <option value="feedback" class="">Отзыв на товар</option>
                                                <option value="inst" class="">Рекламная интеграция(Instagram)</option>
                                                <option value="3" class="">Рекламная интеграция(Youtube)</option>
                                                <option value="4" class="">Другие площадки для интеграций</option>
                                                <option value="5" class="">Платные интеграции</option>
                                            </select>
                                        </div>
                                        {{-- <div class="form-group filter__item">
                                            <label for="">Страна</label>
                                            <select name="filter-country" id="filter-country" class = "input">
                                                <option value="" class="">Не выбрана</option>
                                                <option value="1" class="">Россия</option>
                                                <option value="2" class="">Казахстан</option>
                                                <option value="3" class="">Грузия</option>
                                            </select>
                                        </div> --}}
                                        {{-- <div class="form-group filter__item">
                                            <label for="">Статус</label>
                                            <select name="filter-status" id="filter-status" class = "input">
                                                <option value="" class="">Не выбран</option>
                                                <option value="0" class="">Не начат</option>
                                                <option value="1" class="">В работе</option>
                                                <option value="2" class="">Выполнен</option>
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
                    <div class="profile-projects tab-content" id = "profile-projects">
                        <div class="profile-projects__body">
                            <div class="projects-list__header">
                                <div class="list-projects__title title">
                                    Все проекты
                                </div>
                                <div class="" style="display: flex; gap: 10px; flex-wrap: wrap;">
                                    <button class="btn btn-primary projects-list__filter-btn">Фильтры</button>
                                </div>
                            </div>
                            <div class="profile-projects__items list-projects__items">
                                @include('project.all-blogger-list', ['all_projects' => $all_projects, 'type' => 'all'])
                            </div>
                        </div>
                        <div class="profile-projects__filters">
                            <div class="projects-list__filter filter">
                                <div class="filter__body">
                                    <div class="filter__top">
                                        <p class = "filter__title">
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
                                            <label for="filter-category">Категория</label>
                                            <input type="text" class="input" name="filter-category" id="filter-category" placeholder="Введите категорию">
                                            <input type="text" id = "filter-category-id" hidden>
                                            <div class="filter-tooltip" style="display: none">
                                                <div class="filter-tooltip__items">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group filter__item">
                                            <label for="">Формат рекламы</label>
                                            <select name="filter-format" id="filter-format" class = "input">
                                                <option value="" class="">Не выбран</option>
                                                <option value="feedback" class="">Отзыв на товар</option>
                                                <option value="inst" class="">Рекламная интеграция(Instagram)</option>
                                                <option value="3" class="">Рекламная интеграция(Youtube)</option>
                                                <option value="4" class="">Другие площадки для интеграций</option>
                                                <option value="5" class="">Платные интеграции</option>
                                            </select>
                                        </div>
                                        {{-- <div class="form-group filter__item">
                                            <label for="">Страна</label>
                                            <select name="filter-country" id="filter-country" class = "input">
                                                <option value="" class="">Не выбрана</option>
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
                    <div class="profile-projects tab-content" id = "avail-projects">
                        <div class="profile-projects__body">
                            <div class="projects-list__header">
                                <div class="list-projects__title title">
                                    Заявки от селлеров
                                </div>
                                <div class="" style="display: flex; gap: 10px; flex-wrap: wrap;">
                                    <button class="btn btn-primary projects-list__filter-btn">Фильтры</button>
                                </div>
                            </div>
                            <div class="list-projects__items">
                                @include('project.blogger-list', ['project_works' => $application_works, 'type' => 'applications'])
                            </div>
                        </div>
                        <div class="profile-projects__filters">
                            <div class="projects-list__filter filter">
                                <div class="filter__body">
                                    <div class="filter__top">
                                        <p class = "filter__title">
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
                                            <label for="filter-category">Категория</label>
                                            <input type="text" class="input" name="filter-category" id="filter-category" placeholder="Введите категорию">
                                            <input type="text" id = "filter-category-id" hidden>
                                            <div class="filter-tooltip" style="display: none">
                                                <div class="filter-tooltip__items">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group filter__item">
                                            <label for="">Формат рекламы</label>
                                            <select name="filter-format" id="filter-format" class = "input">
                                                <option value="" class="">Не выбран</option>
                                                <option value="feedback" class="">Отзыв на товар</option>
                                                <option value="inst" class="">Рекламная интеграция(Instagram)</option>
                                                <option value="3" class="">Рекламная интеграция(Youtube)</option>
                                                <option value="4" class="">Другие площадки для интеграций</option>
                                                <option value="5" class="">Платные интеграции</option>
                                            </select>
                                        </div>
                                        {{-- <div class="form-group filter__item">
                                            <label for="">Страна</label>
                                            <select name="filter-country" id="filter-country" class = "input">
                                                <option value="" class="">Не выбрана</option>
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
                    <div class="profile-chat tab-content" id = "chat">
                        @include('shared.chat.index')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="popup" id="project-item-info" style="">
    <div class="popup__container _container">
        <div class="popup__body">
            <div class="popup__inner popup-project">
                <div class="popup-project__left">
                    <div class="popup-project__carousel owl-carousel">
                        <div class="popup-project__img" style="background-image:url(http://tla/storage/projects/MLFUVyW0CcBdOeEfk7lBJwVoPravrIr19oDOEuhY.webp)"></div>
                        <div class="popup-project__img" style="background-image:url(http://tla/storage/projects/MLFUVyW0CcBdOeEfk7lBJwVoPravrIr19oDOEuhY.webp)"></div>
                    </div>
                </div>
                <div class="popup-project__right">
                    <div class="popup-project__info">
                        <div class="popup-project__title">
                            Титул
                        </div>
                        <div class="popup-project__row" style="line-height:1">
                            <div class="popup-project__mark">
                                <div class="popup-project__mark-star">
                                    <img src="{{ asset('img/star-icon.svg') }}" alt="" srcset="">
                                </div>
                                <div class="popup-project__mark-text">
                                    4.2
                                </div>
                            </div>
                            <div class="popup-project__articul">
                                <p>Арт: 123123123</p>
                            </div>
                        </div>
                        <div class="popup-project__row popup-project__cost">
                            1240₽
                        </div>
                        <div class="popup-project__addit characteristics">
                            <p class="popup-project__addit-title">Дополнительная информация</p>
                            <div class="characteristics__category">
                                Категория: Тестовая
                            </div>
                            <div class="characteristics-items">
                            </div>
                        </div>
                        <div class="project-item__left" style="margin-bottom: 18px;">
                            <div class="line">
                                <div class="line__val" style="width:60%"></div>
                            </div>
                            Осталось мест на интеграцию <span style="font-weight: 700;">5/3</span>
                        </div>
                        {{-- <div class="project-item__format-tags card__row card__tags">
                            <div class="card__tags-item">
                                Отзыв на товар
                            </div>
                        </div> --}}
                        <div class="project-item__btns">
                            <button class="btn btn-primary btn-blogger-send-offer" style="" data-project-work="">Откликнуться</button>
                            <a href="" class="btn btn-secondary btn-go-to-shop" style="" target="_blank">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="close-popup">
                <img src="{{ asset('img/close-icon.svg') }}" alt="">
            </div>
        </div>
    </div>
</div>
@endsection
